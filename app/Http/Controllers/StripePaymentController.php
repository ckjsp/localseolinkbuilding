<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\lslbOrder;
use App\Models\lslbUser;
use App\Models\lslbPayment;
use Laravel\Cashier\Billable;

class StripePaymentController extends Controller
{
    use Billable;
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        //return view('stripe');
    }
    public function charge(Request $request)
    {
        $orders = lslbOrder::find($request->post('id'));
        $user = lslbUser::find($request->post('u_id'));
        Stripe::setApiKey(config('services.stripe.secret'));
        try {
            $amount_in_usd = $request->post('price');
            $amount_in_cents = intval($amount_in_usd * 100); // Convert dollars to cents

            $charge = Charge::create([
                'amount' => $amount_in_cents, // Amount in cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment By '.$user->name,
                'receipt_email' => $user->email, // Assuming you have an email field
                // 'name' => $user->business_name,
                // 'address' => [
                //     'line1' => $user->billing_address,
                //     'city' => $user->billing_city,
                //     'postal_code' => $user->postal_code,
                //     'country' => $user->billing_country,
                // ],
            ]);
            if($charge->status == 'succeeded'){
                $arr = array();
                $arr['user_id'] = $user->id;
                $arr['order_id'] = $orders->id;
                $arr['payment_amount'] = ($charge->amount/100);
                $arr['payment_id'] = $charge->source->id;
                $arr['payment_method'] = 'stripe';
                $arr['payment_type'] = $charge->payment_method_details->type;
                $arr['payment_responce'] = serialize(json_encode($charge));
                lslbPayment::create($arr);
                $orders->update(['payment_status' => 'success', 'payment_method' => 'stripe']);
                return redirect()->route('advertiser.cart')->with(['success' => 'Order placed successfully order id is:- ' . $orders->order_id,'website_id' => $orders->website_id]);
            }else{
                return redirect()->route('advertiser.cart')->with(['error' => 'Payment was failed.']);
            }
            // Handle successful payment
        } catch (Exception $e) {
            // Handle payment failure
            return redirect('/')->with('error', $e->getMessage());
        }
    }





    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        /* $stripe = Stripe\Stripe::setApiKey('sk_test_RqEkHC4txd8hDY5U4Xyumm0S');
        header('Content-Type: application/json');
        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => 10,
                'currency' => 'usd',
                // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
            exit;
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
            exit;
        } */


        /* Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Stripe\Customer::create(array(
            "address" => [
                "line1" => "Virani Chowk",
                "postal_code" => "360001",
                "city" => "Rajkot",
                "state" => "GJ",
                "country" => "IN",
            ],
            "email" => "demo@gmail.com",
            "name" => "Hardik Savani",
            "source" => $request->stripeToken
        ));

        Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Test payment from itsolutionstuff.com.",
            "shipping" => [
                "name" => "Jenny Rosen",
                "address" => [
                    "line1" => "510 Townsend St",
                    "postal_code" => "98140",
                    "city" => "San Francisco",
                    "state" => "CA",
                    "country" => "US",
                ],
            ]
        ]);
        
        Session::flash('success', 'Payment successful!');

        return back(); */
    }
}
