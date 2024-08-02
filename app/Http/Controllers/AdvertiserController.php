<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\lslbWebsite;
use App\Models\lslbOrder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\lslbProject;

// Validator::extend('url', function ($attribute, $value, $parameters, $validator) {
//     return preg_match('/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/', $value);
// });

class AdvertiserController extends Controller
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
    public function index($page = 'home')
    {
        $data = array();
        if (Auth::user()) {
            $data['orderCount'] = lslbOrder::where('u_id', Auth::user()->id)->count();
            $data['successOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'success')->count();
            $data['pendingOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'pending')->count();
            $data['progressingOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'progressing')->count();
            $data['failedOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'failed')->count();
            if ($page === 'projects') {
                return view('advertiser.projects')->with($data);
            }
            return view('advertiser/home')->with($data);
        } else {
            return redirect('/login');
        }
    }
    public function projects()
    {
        $data = array();
        $data['slug'] = 'projects';
        $data['userDetail'] = Auth::user();
        $data['websites'] = lslbWebsite::where('status', 'approve')->get();
        session(['slug' => $data['slug']]);
        return view('advertiser/projects')->with($data);
    }

    public function marketplace()
    {
        $data = array();
        $data['slug'] = 'marketplace';
        $data['userDetail'] = Auth::user();
        $data['websites'] = lslbWebsite::where('status', 'approve')->get();
        return view('advertiser/marketplace')->with($data);
    }

    public function cart()
    {
        $data = array();
        $arrCookie = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart']) : array();
        $ids = array_column($arrCookie, 'web_id');
        $data['slug'] = 'cart';
        $data['userDetail'] = Auth::user();
        $data['websites'] = lslbWebsite::findMany($ids);
        return view('advertiser/cart')->with($data);
    }
    public function projectStore(Request $request)
    {

        $request->validate([
            'project_name' => 'required',
            'project_url' => 'required',
            'categories' => 'required',
            'forbidden_category' => 'required',
        ]);

        lslbProject::create([

            'project_name' => $request->input('project_name'),
            'project_url' => $request->input('project_url'),
            'categories' => $request->input('categories'),
            'forbidden_category' => $request->input('forbidden_category'),
            'additional_note' => $request->input('additional_note'),
        ]);

        return redirect()->route('advertiser.projects')->with('success', 'Project created successfully!');
    }
}
