<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lslbOrder;
use App\Models\lslbUser;
use App\Models\lslbPayment;
use App\Models\lslbTransaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function chekRole(Request $request)
    {
        $url = $request->url();
        if (!Auth::user()) {
            return 'lslb-admin/login';
        }
        if (Str::contains($url, 'publisher') && Auth::user()->role->name == 'Advertiser') {
            $newUrl = str_replace('publisher', 'advertiser', $url);
            return $newUrl;
        }
        if (Str::contains($url, 'advertiser') && Auth::user()->role->name == 'Publisher') {
            $newUrl = str_replace('advertiser', 'publisher', $url);
            return $newUrl;
        }
    }

    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $url = $this->chekRole($request);
        if (!empty($url)) {
            return redirect($url);
        }
        $data = array();
        $data['slug'] = 'payment';
        $data['userDetail'] = Auth::user();
        $lslbPayment = new lslbPayment;
        $data['payments'] = $lslbPayment->paymentList($data['userDetail']->id, Auth::user()->role->name);
        return view('payment')->with($data);
    }

    public function wallet(Request $request)
    {
        $publisherId = Auth::user()->id;

        $payments = lslbTransaction::where('publisher_id', $publisherId)
            ->orderBy('created_at', 'desc')
            ->get();

        $data = [
            'slug' => 'wallet',
            'payments' => $payments
        ];

        return view('publisher.wallet')->with($data);
    }


    public function withdraw(Request $request)

    {
        $request->validate([
            'upi_id' => 'required|string|max:255',
            'wallet_balance' => 'required|numeric|min:1',
        ]);

        $publisherId = Auth::user()->id;
        $publisheremail = Auth::user()->email;
        $publishername = Auth::user()->name;

        $walletBalance = $request->wallet_balance;

        if ($walletBalance <= 30) {
            return redirect()->back()->with('error', 'Your balance is insufficient to withdraw. You need more than $30 to proceed with the withdrawal.');
        }

        $transaction = new lslbTransaction();
        $transaction->publisher_id = $publisherId;
        $transaction->transaction_date = now();
        $transaction->transaction_type = 'debit';
        $transaction->amount = $walletBalance;
        $transaction->currency = 'USD';
        $transaction->payment_email = $request->upi_id;
        $transaction->status = 'pending';
        $transaction->description = 'Withdrawal request';
        $transaction->created_at = now();
        $transaction->updated_at = now();

        if ($transaction->save()) {

            $publisherData = [
                'publishername' => $publishername,
                'walletBalance' => $walletBalance,
            ];

            Mail::send('email.withdrawal_notification', $publisherData, function ($message) use ($publisheremail) {
                $message->from('no-reply@linksfarmer.com', 'Links Farmer');
                $message->to($publisheremail);
                $message->subject('Notification: Payment Withdrawal Request Undertaken - Link Publishers!');
            });

            return redirect()->back()->with('success', 'Withdrawal successful. Your funds have been debited.');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Unable to process the withdrawal.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()

    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)

    {
        //
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)

    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)

    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)

    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id) {}
}
