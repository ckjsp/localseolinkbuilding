<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Models\lslbOrder;
use App\Models\lslbPayment;
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


                // Add email functionality here
                $customData['from_name'] = "Links Farmer";
                $customData['mailaddress'] = "no-reply@linksfarmer.com";
                $customData['subject'] = 'Order Payment Successful';
                $customData['msg'] = "<p>Your payment for Order ID: <strong>{$customOrderId}</strong> has been successfully processed.</p>
                                  <p><strong>Order Details:</strong></p>
                                  <ul>
                                      <li>Order ID: {$customOrderId}</li>
                                      <li>Amount Paid: {$order->price}</li>
                                      <li>Payment Method: Razorpay</li>
                                  </ul>
                                  <p>Thank you for your payment. You can view your orders in your dashboard.</p>";

                Mail::to($order->email)->send(new MyMail($customData));


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
