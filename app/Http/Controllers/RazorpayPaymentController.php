<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Models\lslbOrder;
use App\Models\lslbPayment;

class RazorpayPaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        $price = $request->input('price');
        $orderId = $request->input('orderId');

        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        try {
            $order = $api->order->create([
                'receipt' => $orderId,
                'amount' => $price * 100,
                'currency' => 'USD',
            ]);

            return view('razorpay', [
                'order_id' => $order['id'],
                'custom_order_id' => $orderId,
                'amount' => $price * 100,
                'currency' => 'USD',
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
