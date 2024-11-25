<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;

class RazorpayPaymentController extends Controller
{


    public function makePayment($price)

    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt'         => uniqid(),
            'amount'          => $price * 100,
            'currency'        => 'INR',
        ]);

        Session::put('razorpay_order_id', $order['id']);

        return view('payment', [
            'order_id' => $order['id'],
            'amount' => $price->amount,
            'key' => env('RAZORPAY_KEY')
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
                'razorpay_payment_id' => $paymentId
            ];

            $api->utility->verifyPaymentSignature($attributes);

            return response()->json(['success' => true, 'message' => 'Payment successful']);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Payment verification failed']);
        }
    }
}
