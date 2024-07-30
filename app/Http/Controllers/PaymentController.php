<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lslbOrder;
use App\Models\lslbUser;
use App\Models\lslbPayment;
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

    public function chekRole(Request $request){
        $url = $request->url();
        if(!Auth::user()){
            return 'lslb-admin/login';
        }
        if(Str::contains($url, 'publisher') && Auth::user()->role->name == 'Advertiser') {
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
        if(!empty($url)){ return redirect($url); }
        $data = array();
        $data['slug'] = 'payment';
        $data['userDetail'] = Auth::user();
        $lslbPayment = new lslbPayment;
        $data['payments'] = $lslbPayment->paymentList($data['userDetail']->id, Auth::user()->role->name);
        // echo '<pre>'; print_r( $data['payments'] ); echo '</pre>';exit;
        return view('payment')->with($data);
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
    public function destroy(string $id)
    {
        //
    }
}
