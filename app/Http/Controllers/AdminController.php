<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MyMail;
use App\Models\lslbPublisher;
use App\Models\lslbWebsite;
use App\Models\lslbOrder;
use App\Models\lslbUser;

class AdminController extends Controller
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
    public function index()
    {
        if (Auth::user()) {
            $data = array();
            $data['slug'] = 'dashboard';
            $data['websiteCount'] = lslbWebsite::all()->count();
            // $data['orderCount'] = $this->countOrder(lslbOrder::with('website')->get());
            $lslbOrder = new lslbOrder;
            $data['orderCount'] = $lslbOrder->orderList()->count();
            $data['userCount'] = lslbUser::all()->count();
            return view('lslbadmin.home')->with($data);
        } else {
            return redirect('lslb-admin/login');
        }
    }

    public function getWebsites(Request $request)
    {
        $this->chekRole($request);
        $data = array();
        $data['slug'] = 'websites-list';
        $data['websites'] = lslbWebsite::with('user')->get();
        return view('lslbadmin.website')->with($data);
    }

    public function getUsers(Request $request)
    {
        $this->chekRole($request);
        $data = array();
        $data['slug'] = 'users-list';
        $data['users'] = lslbUser::where('id', '!=', Auth::user()->id)->get();
        return view('lslbadmin.users')->with($data);
    }

    public function getUserDetail(Request $request, $id)
    {
        $this->chekRole($request);
        $data = array();
        $data['slug'] = 'user-detail';
        $data['userDetail'] = lslbUser::find($id)->with('websites')->get();
        return view('lslbadmin.website')->with($data);
    }

    public function getOrders(Request $request)
    {
        $this->chekRole($request);
        $data = array();
        $data['slug'] = 'orders-list';
        $data['userDetail'] = Auth::user();
        $lslbOrder = new lslbOrder;
        $data['orders'] = $lslbOrder->orderList();
        return view('lslbadmin.orders')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */

    public function updateStatus(Request $request, string $id)
    {
        if (!empty($request->post('status'))) {
            $order = lslbWebsite::find($id);
            $user = lslbUser::find($order->user_id);

            if (!$order) {
                abort(404);
            }

            $validatedData = $request->validate([
                'status' => 'required',
                'rejectionReason' => 'nullable|string',
                'linkedinSession' => 'nullable|string',
                'guestPostPrice' => 'nullable|string'
            ]);

            $order->update(['status' => $validatedData['status']]);

            if (!empty($validatedData['linkedinSession'])) {
                $order->linkedinSession_adminprice = $validatedData['linkedinSession'];
            }

            if (!empty($validatedData['guestPostPrice'])) {
                $order->guestPostPrice_adminprice = $validatedData['guestPostPrice'];
            }

            if (!empty($validatedData['rejectionReason'])) {
                $order->rejectionReason = $validatedData['rejectionReason'];
            }

            $order->save();

            $data = ['success' => 'Status updated successfully', 'error' => ''];
            $status = ucwords($validatedData['status']);

            $customData['from_name'] = env('MAIL_FROM_NAME');
            $customData['mailaddress'] = env('MAIL_FROM_ADDRESS');
            $customData['subject'] = 'Notification: Links Farmer - Website Status Update';

            $rejectionMessage = '';
            if ($validatedData['status'] == 'rejected' && !empty($validatedData['rejectionReason'])) {
                $rejectionMessage = "<li><strong>Reason for Rejection:</strong> " . $validatedData['rejectionReason'] . "</li>";
            }

            $customData['msg'] = "<p>Your website status has been updated:</p>
                <ul>
                    <li><strong>Website:</strong> " . $order->website_url . "</li>
                    <li><strong>New Status:</strong> " . $status . "</li>
                    $rejectionMessage

                </ul>
                <p>If you have any questions or concerns, please contact our customer support.</p>
                <p>Thank you for choosing our platform!</p>";

            Mail::to($user->email)->send(new MyMail($customData));
        } else {
            $data = ['error' => 'Oops! Status update failed', 'success' => ''];
        }

        echo json_encode($data, true);
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function webEdit(Request $request, string $id)
    {
        $url = $this->chekRole($request);
        if (!empty($url)) {
            return redirect($url);
        }
        $data = array();
        $data['slug'] = 'websites-list';
        $data['website'] = lslbWebsite::find($id);
        if (!$data['website']) {
            abort(404);
        }
        return view('lslbadmin.website_create')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function webUpdate(Request $request, string $id)
    {
        $url = $this->chekRole($request);
        if (!empty($url)) {
            return redirect($url);
        }
        $website = lslbWebsite::find($id);

        if (!$website) {
            abort(404);
        }
        $rulesArr = [
            'website_url' => 'required|url|unique:lslb_websites',
            'domain_authority' => 'required',
            'page_authority' => 'required',
            'spam_score' => 'required',
            'publishing_time' => 'required',
            'minimum_word_count_required' => 'required|max:1000',
            'backlink_type' => 'required',
            'status' => 'required',
            'maximum_no_of_backlinks_allowed' => 'required',
            'domain_life_validity' => 'required',
            'sample_post_url' => 'required|url',
            'guidelines' => 'required|string|max:1000',
            'categories' => 'required',
            'forbidden_categories' => 'required',
            'guest_post_price' => 'required',
            'link_insertion_price' => 'required',
            // 'fc_guest_post_price' => 'required',
            // 'fc_link_insertion_price' => 'required',
        ];
        if ($request->post('old_url') == $request->post('website_url')) {
            $rulesArr['website_url'] = 'required|url';
        }
        $validatedData = $request->validate($rulesArr);

        if (!empty($request->file('site_verification_file'))) {
            $request->validate([
                'site_verification_file' => 'required|file|mimes:pdf,png,jpg|max:5120',
            ]);
            if ($request->file('site_verification_file')->isValid()) {
                $path = $request->file('site_verification_file')->store('verification');
            } else {
                $arr = array();
                $arr['success'] = false;
                $arr['error'] = 'File upload failed.';
                return redirect()->back()->with($arr);
            }
        } else {
            $path = $request->post('old_site_verification_file');
        }
        $validatedData['site_verification_file'] = $path;
        $website->update($validatedData);

        return redirect()->route('lslbadmin.websites')->with('success', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function WebDestroy(Request $request, string $id)
    {
        $url = $this->chekRole($request);
        if (!empty($url)) {
            return redirect($url);
        }
        $website = lslbWebsite::find($id); // Assuming 'Website' is the model for your data

        if (!$website) {
            abort(404); // Handle not found gracefully
        }
        $website->update([
            'website_url' => 'delete-' . $website->website_url,
        ]);
        $website->delete();
        return redirect()->route('publisher.website')->with('success', 'Record deleted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function userEdit(Request $request, string $id)
    {
        $url = $this->chekRole($request);
        if (!empty($url)) {
            return redirect($url);
        }
        $data = array();
        $data['slug'] = 'users-list';
        $data['user'] = lslbUser::find($id);

        if (!$data['user']) {
            abort(404);
        }
        return view('lslbadmin.users_edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function userUpdate(Request $request, string $id)
    {
        $url = $this->chekRole($request);
        if (!empty($url)) {
            return redirect($url);
        }
        $user = lslbUser::find($id); // Assuming 'user' is the model for your data
        if (!$user) {
            abort(404); // Handle not found gracefully
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            // 'phone_number' => 'required',
            // 'dial_code' => 'required',
            'identity' => 'required',
            // 'company_website_url' => 'required|url',
            'country' => 'required',
            'preferred_method' => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['payment_email'] = $request->post('payment_email');
        $validatedData['status'] = $request->post('status');
        $validatedData['email_verified_at'] = !empty($request->post('email_verified_at')) ? $request->post('email_verified_at') : NULL;
        $validatedData['business_name'] = $request->post('business_name');
        $validatedData['registration_number'] = $request->post('registration_number');
        $validatedData['billing_address'] = $request->post('billing_address');
        $validatedData['billing_city'] = $request->post('billing_city');
        $validatedData['billing_country'] = $request->post('billing_country');
        $validatedData['postal_code'] = $request->post('postal_code');

        $user->update($validatedData);

        return redirect()->route('lslbadmin.users')->with('success', 'User detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function userDestroy(Request $request, string $id)
    {
        $url = $this->chekRole($request);
        if (!empty($url)) {
            return redirect($url);
        }
        $user = lslbUser::find($id); // Assuming 'Website' is the model for your data

        if (!$user) {
            abort(404); // Handle not found gracefully
        }
        $user->update([
            'email' => 'delete-' . $user->email,
        ]);
        $user->delete();
        return redirect()->route('lslbadmin.users')->with('success', 'Record deleted successfully');
    }
}
