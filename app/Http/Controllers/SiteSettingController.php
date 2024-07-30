<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\lslbSiteSetiing;

class SiteSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('AdminAuth');
    }

    public function chekRole(){
        if(!Auth::user()){
            return redirect('lslb-admin/login');
        }else if(Auth::user()->role->name == 'Advertiser') {
            return redirect('/advertiser');
        }else if (Auth::user()->role->name == 'Publisher') {
            return redirect('/publisher');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->chekRole();
        $data = array();
        $data['slug'] = 'site-settings';
        $data['setiing'] = lslbSiteSetiing::all();
        return view('lslbadmin.site_settings')->with($data);
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
