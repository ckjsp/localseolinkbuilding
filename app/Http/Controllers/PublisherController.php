<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\lslbPublisher;
use App\Models\lslbWebsite;
use App\Models\lslbOrder;

class PublisherController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()) {
            $data = array();
            $data['slug'] = 'dashboard';
            $data['websiteCount'] = lslbWebsite::where('user_id', Auth::user()->id)->count();
            // $data['orderCount'] = $this->countOrder(lslbOrder::with('website')->get());
            $lslbOrder = new lslbOrder;
            $data['orderCount'] = $lslbOrder->orderList(Auth::user()->id)->count();
            return view('publisher/home')->with($data);
        } else {
            return redirect('/login');
        }
    }
    public function countOrder($data)
    {
        $num = 0;
        foreach ($data as $k => $v) {
            ($v->website->user_id == Auth::user()->id) ? $num++ : '';
        }
        return $num;
    }
}
