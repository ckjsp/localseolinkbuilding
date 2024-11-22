<?php


namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentController extends Controller
{
    public function createPayment($price)
    {
        $clientId = config('services.paypal.client_id');
        $secret = config('services.paypal.secret');
        $mode = config('services.paypal.mode');

        $paypal = new PayPalClient();

        $paypal->setApiCredentials([
            'client_id' => $clientId,
            'secret' => $secret,
            'mode' => $mode,
        ]);

        $paypal->setAccessToken($paypal->getAccessToken());

        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price,
                    ],
                ],
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
}
