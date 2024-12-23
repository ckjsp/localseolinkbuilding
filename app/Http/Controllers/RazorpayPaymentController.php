<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Models\lslbOrder;
use App\Models\lslbPayment;
use App\Models\lslbUser;
use App\Models\lslbWebsite;

use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;


class RazorpayPaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        $price = $request->input('price');
        $currency = $request->input('currency', 'USD');
        $orderId = $request->input('orderId');

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        try {
            $conversionRate = $this->fetchConversionRate($currency, 'INR');
            if ($conversionRate === null) {
                throw new \Exception('Unable to fetch conversion rate.');
            }

            $amountInINR = $price * $conversionRate;

            $order = $api->order->create([
                'receipt' => $orderId,
                'amount' => round($amountInINR * 100),
                'currency' => 'INR',
            ]);

            return view('razorpay', [
                'order_id' => $order['id'],
                'custom_order_id' => $orderId,
                'amount' => round($amountInINR * 100),
                'currency' => 'INR',
                'key' => env('RAZORPAY_KEY_ID'),
                'userName' => $request->user()->name,
                'userEmail' => $request->user()->email,
                'userContact' => $request->user()->contact
            ]);
        } catch (\Exception $e) {
            Log::error("Error creating Razorpay order: " . $e->getMessage());
            return redirect()->route('advertiser.orders')->with('error', 'Error processing payment. Please try again.');
        }
    }


    private function fetchConversionRate($fromCurrency, $toCurrency)

    {
        $url = "https://api.exchangerate-api.com/v4/latest/$fromCurrency";

        try {
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            return $data['rates'][$toCurrency] ?? null;
        } catch (\Exception $e) {
            Log::error("Error fetching conversion rate: " . $e->getMessage());
            return null;
        }
    }

    public function callback(Request $request)
    {

        $signature = $request->razorpay_signature;
        $orderId = $request->razorpay_order_id;
        $paymentId = $request->razorpay_payment_id;

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $attributes = [
            'razorpay_signature' => $signature,
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);

            $customOrderId = $request->custom_order_id;

            $paymentDetails = $api->payment->fetch($paymentId);
            $paymentResponse = $paymentDetails->toArray();

            $order = lslbOrder::where('order_id', $customOrderId)->first();

            if ($order) {
                $paymentData = [
                    'user_id' => $order->u_id,
                    'order_id' => $order->id,
                    'payment_amount' => $order->price,
                    'payment_id' => $paymentId,
                    'payment_method' => 'Razorpay',
                    'payment_type' => 'capture',
                    'payment_responce' => serialize(json_encode($paymentResponse)),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                lslbPayment::create($paymentData);

                $order->update([
                    'payment_status' => 'success',
                ]);

                $website = lslbWebsite::where('id', $order->website_id)->first();

                $websitename = $website->website_url;

                $user = lslbUser::where('id', $website->user_id)->first();

                $arrCookie = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

                $updatedCookie = array_filter($arrCookie, function ($item) use ($order) {
                    return $item['web_id'] !== $order->website_id;
                });

                setcookie('cart', !empty($updatedCookie) ? json_encode(array_values($updatedCookie)) : '', time() + (86400 * 30), "/");


                $customData = [
                    'from_name' => 'Links Farmer',
                    'mailaddress' => 'no-reply@linksfarmer.com',
                    'subject' => 'Order Payment Successful',
                    'customOrderId' => $customOrderId,
                    'websitename' => $websitename,
                    'orderPrice' => $order->price,
                    'attachment_type' => $order->attachment_type,

                ];

                Mail::send('email.order_payment_successful_razorpay', $customData, function ($message) use ($customData, $order) {
                    $message->from($customData['mailaddress'], $customData['from_name']);
                    $message->to($order->email);
                    $message->subject($customData['subject']);
                });

                Mail::send('email.order_payment_successful_razorpay_publisher', $customData, function ($message) use ($customData, $user) {
                    $message->from($customData['mailaddress'], $customData['from_name']);
                    $message->to($user->email);
                    $message->subject('New orders have been successfully placed on your website');
                });

                return redirect()->route('advertiser.orders')->with('success', 'Payment completed successfully!');
            } else {
                return redirect()->route('advertiser.orders')->with('error', 'Order not found!');
            }
        } catch (\Exception $e) {
            Log::error('Error during Razorpay payment verification: ' . $e->getMessage());

            return redirect()->route('advertiser.orders')->with('error', 'Payment verification failed. Please try again!');
        }
    }

    public function cancel($orderId)

    {
        $order = lslbOrder::where('order_id', $orderId)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'canceled',
            ]);

            return redirect()->route('advertiser.orders')->with('success', 'Payment was canceled.');
        } else {
            return redirect()->route('advertiser.orders')->with('error', 'Order not found.');
        }
    }
}
