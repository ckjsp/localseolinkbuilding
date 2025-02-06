<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

use Illuminate\Http\Request;

use App\Models\lslbOrder;
use App\Models\lslbUser;
use App\Models\lslbWebsite;
use App\Models\lslbPayment;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;


class PaypalPaymentController extends Controller

{
    public function createPayment($price, $orderId)

    {

        $provider = new PayPalClient;

        // $provider = \PayPal::setProvider();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price,
                    ],
                    "custom_id" => $orderId,
                ],
            ],
            "application_context" => [
                "return_url" => route('payment.success'),
                "cancel_url" => route('payment.cancel', ['orderId' => $orderId]),
            ],
        ]);

        if (isset($response['id'])) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect($link['href']);
                }
            }
        } else {
            return response()->json(['error' => 'Payment creation failed.'], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $orderId = $request->query('token');
        $response = $provider->capturePaymentOrder($orderId);

        if (isset($response['status']) && $response['status'] === 'COMPLETED') {
            $captures = $response['purchase_units'][0]['payments']['captures'][0] ?? null;

            if ($captures) {
                $customId = $captures['custom_id'] ?? null;

                $order = lslbOrder::where('order_id', $customId)->first();

                if ($customId) {
                    $paymentdata = [
                        'user_id' => $order->u_id,
                        'order_id' => $order->id,
                        'payment_amount' => $captures['amount']['value'],
                        'payment_id' => $captures['id'],
                        'payment_method' => 'PayPal',
                        'payment_type' => 'capture',
                        'payment_responce' => serialize(json_encode($response)),
                    ];

                    $payment = lslbPayment::create($paymentdata);

                    $order->update([
                        'payment_status' => 'success',
                    ]);

                    $website = lslbWebsite::where('id', $order->website_id)->first();
                    $categories = explode(',', $website->categories);


                    $websitename = $website->website_url;

                    $user = lslbUser::where('id', $website->user_id)->first();

                    $customData = [
                        'from_name' => 'Links Farmer',
                        'mailaddress' => 'no-reply@linksfarmer.com',
                        'subject' => 'Order Payment Successful',
                        'order_id' => $order->order_id,
                        'attachment_type' => $order->attachment_type,
                        'websitename' => $websitename,
                        'amount_paid' => $captures['amount']['value'],
                        'payment_id' => $captures['id'],
                    ];

                    // Send the email using the Blade view

                    Mail::send('email.order_payment_successful_paypal', $customData, function ($message) use ($customData, $order) {
                        $message->from($customData['mailaddress'], $customData['from_name']);
                        $message->to($order->email);
                        $message->subject($customData['subject']);
                    });

                    Mail::send('email.order_payment_successful_paypal_publisher', $customData, function ($message) use ($customData, $user) {
                        $message->from($customData['mailaddress'], $customData['from_name']);
                        $message->to($user->email);
                        $message->subject('New orders have been successfully placed on your website');
                    });

                    // Remove ordered website from the cart
                    $cart = json_decode($_COOKIE['cart'] ?? '[]', true); // Get the current cart
                    $updatedCart = array_filter($cart, function ($item) use ($order) {
                        return $item['web_id'] != $order->website_id;
                    });
                    setcookie('cart', json_encode(array_values($updatedCart)), time() + (2 * 24 * 60 * 60), '/');

                    return redirect()->route('advertiser.orders')->with('success', 'Payment completed successfully!');
                }

                return redirect()->route('advertiser.orders')->with('error', 'Payment completed, but order ID is missing.');
            }

            return redirect()->route('advertiser.orders')->with('error', 'Payment capture failed.');
        }

        return redirect()->route('advertiser.orders')->with('error', 'Payment capture failed.');
    }


    public function paymentCancel($orderId)

    {

        $order = lslbOrder::where('order_id', $orderId)->first();

        $order->update([

            'payment_status' => 'canceled',

        ]);

        return redirect()->route('advertiser.orders')->with('success', 'Payment was canceled.');
    }
}
