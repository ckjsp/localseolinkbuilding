<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\lslbUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('firstLogin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role->name == 'Publisher') {
            return redirect('/publisher');
            // return view('publisher/home');
        } elseif (Auth::user()->role->name == 'Advertiser') {
            return redirect('/advertiser');
            // return view('advertiser/home');
        } else {
            return redirect('/lslb-admin');
            // return view('lslbadmin/home');
        }
    }

    public function userProfile()
    {
        $data = array();
        $data['slug'] = 'profile';
        $data['user'] = lslbUser::find(Auth::user()->id);
        return view('profile')->with($data);
    }

    public function publisherProfileEdit()
    {
        $data = array();
        $data['slug'] = 'profile';
        $data['user'] = lslbUser::find(Auth::user()->id);
        return view('profile')->with($data);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Password changed successfully.');
        } else {
            return back()->with('error', 'Old password is incorrect.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function userUpdate(Request $request, string $id)
    {
        $user = lslbUser::find($id); // Assuming 'user' is the model for your data
        if (!$user) {
            abort(404); // Handle not found gracefully
        }

        $commonRules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'dial_code' => 'required',
            'identity' => 'required',
            'company_website_url' => 'required|url',
            'country' => 'required',
            'preferred_method' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        ];
        if ($user->role->name === 'Advertiser') {
            $userRules = [
                'business_name' => 'required',
                'registration_number' => 'required',
                'billing_address' => 'required',
                'billing_city' => 'required',
                'billing_country' => 'required',
                'postal_code' => 'required',
            ];
            $rules = array_merge($commonRules, $userRules);
        }else{
            $rules = $commonRules;
        }
        // Validate and update the record
        $validated_data = Validator::make($request->all(), $rules);
        if ($validated_data->fails()) {
            return redirect()->back()->withInput()->withErrors($validated_data);
            // return back()->with('errorMsg', $validatedData1->errors());
        }else{
            if(!empty($request->file('image'))){
                $path = $request->file('image')->store('profile_image');
            }else{
                $path = $request->post('old_image');
            }
            $validatedData = $request->validate($rules);
            $validatedData['image'] = $path;
            $user->update($validatedData);
            Auth::user()->image = $path;
            return back()->with('success', 'User detail updated successfully');
        }
    }
}
