<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;
use App\Models\lslbOrder;
use App\Models\lslbPayment;

class RazorpayPaymentController extends Controller

{
    public function makePayment($price, $orderId)

    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt'         => $orderId,
            'amount'          => $price * 100,
            'currency'        => 'INR',
        ]);

        Session::put('razorpay_order_id', $order['id']);
        Session::put('custom_order_id', $orderId);

        return view('payment', [
            'order_id' => $order['id'],
            'custom_order_id' => $orderId,
            'amount' => $price * 100,
            'key' => env('RAZORPAY_KEY'),
        ]);
    }

    public function callback(Request $request)

    {
        $signature = $request->razorpay_signature;
        $orderId = $request->razorpay_order_id;
        $paymentId = $request->razorpay_payment_id;

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attributes = [
                'razorpay_signature' => $signature,
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $paymentId,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $customOrderId = Session::get('custom_order_id');

            $paymentDetails = $api->payment->fetch($paymentId);

            $paymentAmount = $paymentDetails['amount'] / 100;
            $paymentMethod = $paymentDetails['method'] ?? 'unknown';
            $paymentResponse = $paymentDetails->toArray();

            $order = lslbOrder::where('order_id', $customOrderId)->first();

            if ($order) {

                $paymentData = [
                    'user_id' => $order->user_id,
                    'order_id' => $order->id,
                    'payment_amount' => $paymentAmount,
                    'payment_id' => $paymentId,
                    'payment_method' => $paymentMethod,
                    'payment_type' => 'capture',
                    'payment_responce' => serialize($paymentResponse),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $payment = lslbPayment::create($paymentData);

                $order->update([
                    'payment_status' => 'success',
                ]);

                return redirect()->route('advertiser.orders')->with('success', 'Payment completed successfully!');
            } else {
                return redirect()->route('advertiser.orders')->with('error', 'Order not found!');
            }
        } catch (\Exception $e) {
            return redirect()->route('advertiser.orders')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }
}
