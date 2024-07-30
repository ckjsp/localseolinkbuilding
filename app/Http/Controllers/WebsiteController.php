<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\MyMail;
use App\Models\lslbWebsite;
use App\Models\lslbUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

Validator::extend('url', function ($attribute, $value, $parameters, $validator) {
    return preg_match('/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/', $value);
});

class WebsiteController extends Controller
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

    public function chekRole()
    {
        if (Auth::user()->role->name == 'Advertiser') {
            return redirect('/advertiser');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->chekRole();
        $data = array();
        $data['slug'] = 'websites';
        $data['websites'] = lslbWebsite::where('user_id', Auth::user()->id)->get();
        return view('publisher/website')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->chekRole();
        $data = array();
        $data['slug'] = 'websites';
        return view('publisher/website_create')->with($data);
    }

    /* protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:lslb_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    } */


    protected function rules()
    {
        $this->chekRole();
        return [
            'website_url' => 'required|url|unique:lslb_websites',
            'domain_authority' => 'required',
            'page_authority' => 'required',
            'spam_score' => 'required',
            'publishing_time' => 'required',
            'minimum_word_count_required' => 'required|max:1000',
            'backlink_type' => 'required',
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
            //'site_verification_file' => 'required',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->chekRole();

        $validatedData = Validator::make($request->all(), $this->rules());

        if ($request->hasFile('site_verification_file')) {
            $validatedData->merge($request->validate([
                'site_verification_file' => 'file|mimes:pdf,png,jpg,jpeg|max:5120',
            ]));
        }

        // $request->validate([
        //     'site_verification_file' => 'required|file|mimes:pdf,png,jpg,jpeg|max:5120',
        // ]);

        // if ($request->file('site_verification_file')->isValid()) {
        //     $path = $request->file('site_verification_file')->store('verification');
        //     $validatedData = Validator::make($request->all(), $this->rules());
        if ($validatedData->fails()) {
            $errors = $validatedData->errors()->all();
            return redirect()->back()->withInput()->withErrors($errors);
        } else {

            if ($request->hasFile('site_verification_file')) {
                $path = $request->file('site_verification_file')->store('verification');
            } else {
                $path = null;
            }

            $data = $request->only(['user_id', 'website_url', 'domain_authority', 'page_authority', 'spam_score', 'publishing_time', 'minimum_word_count_required', 'backlink_type', 'maximum_no_of_backlinks_allowed', 'domain_life_validity', 'sample_post_url', 'guidelines', 'categories', 'forbidden_categories', 'guest_post_price', 'link_insertion_price',]);
            $data['user_id'] = Auth::user()->id;
            $data['status'] = 'pending';
            $data['site_verification_file'] = $path;
            $data['fc_guest_post_price'] = 0;
            $data['fc_link_insertion_price'] = 0;
            $data['ahrefs_traffic'] = 0;
            $data['samrush_traffic'] = 0;
            $data['google_analytics'] = 0;

            lslbWebsite::create($data);

            $customData['from_name'] = "Local SEO Link Builder";
            $customData['mailaddress'] = "no-reply@localseolinkbuilding.com";
            $customData['subject'] = 'Notification: Local SEO Link Builder - Website added Successfully';
            $customData['msg'] = "<p>Your website added successfully.</p>
                <p>Wait for admin approval; after admin approval, your website will be ready to be visible in the marketplace.</p>
                <p>Thank you</p>";
            Mail::to(Auth::user()->email)->send(new MyMail($customData));
            $customData['subject'] = 'Notification: Local SEO Link Builder - New website added';
            $customData['msg'] = "<p>New website added and awaiting approval:</p>
                <ul>
                    <li><strong>Website Name:</strong> " . $request->post('website_url') . "</li>
                    <li><strong>Submitted by:</strong> " . Auth::user()->name . " (" . Auth::user()->email . ")</li>
                </ul>
                <p>Please review and approve the website in the admin panel.</p>
                <p>Thank you</p>";
            $user = lslbUser::where('role_id', '1')->get();
            Mail::to($user[0]->email)->send(new MyMail($customData));
            return redirect()->route('publisher.website')->with('success', 'Record added successfully');
        }
        // } else {
        //     $arr = array();
        //     $arr['success'] = false;
        //     $arr['error'] = 'File upload failed.';
        //     echo json_encode($arr);
        //     exit;
        //     // return redirect()->back()->withInput()->withErrors('File upload failed.');
        // }
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
        $this->chekRole();
        $data = array();
        // Request $request
        // $id = $request->route('id');
        $data['slug'] = 'websites';
        $data['website'] = lslbWebsite::find($id);

        if (!$data['website']) {
            abort(404); // Handle not found gracefully
        }

        return view('publisher/website_create')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->chekRole();
        $website = lslbWebsite::find($id); // Assuming 'Website' is the model for your data

        if (!$website) {
            abort(404); // Handle not found gracefully
        }

        // Validate and update the record
        $validatedData = $request->validate([
            'domain_authority' => 'required',
            'page_authority' => 'required',
            'spam_score' => 'required',
            'publishing_time' => 'required',
            'minimum_word_count_required' => 'required|max:1000',
            'backlink_type' => 'required',
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
        ]);

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

        return redirect()->route('publisher.website')->with('success', 'Record updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->chekRole();
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
     * Filter a newly created resource in storage.
     */
    public function filterData(Request $request)
    {
        $lslbWebsite = new lslbWebsite;
        $lslbWebsite = $lslbWebsite->where(function ($query) use ($request) {

            if (!empty ($request->post('categories'))) {
                $categoryArr = explode(',', $request->post('categories'));
                $query->where(function ($query) use ($categoryArr) {
                    foreach ($categoryArr as $category) {
                        $query->orWhere('categories', 'LIKE', "%$category%");
                    }
                });
            }

            if (!empty ($request->post('price_filters'))) {
                $query->where(function ($query) use ($request) {
                    foreach ($request->post('price_filters') as $range) {
                        list ($min, $max) = explode('-', $range);
                        $query->orWhereBetween('guest_post_price', [$min, $max]);
                    }
                });
            }

            if (!empty ($request->post('backlink_type'))) {
                $query->where('backlink_type', $request->post('backlink_type'));
            }
            $query->where('status', 'approve');
            $query->where('deleted_at', null);
        });


        /* $lslbWebsite = new lslbWebsite;
        if(!empty($request->post('backlink_type'))){
            $lslbWebsite = $lslbWebsite->where('backlink_type', $request->post('backlink_type'));
        }
        if(!empty($request->post('categories'))){
            $categoryArr = explode(',', $request->post('categories'));
            $lslbWebsite = $lslbWebsite->where(function($query) use ($categoryArr) {
                foreach ($categoryArr as $category) {
                    $query->orWhere('categories', 'LIKE', "%$category%");
                }
            });
            
        }
        // $priceRanges = ['100-200', '500-100', '3001-99999'];
        // $results = [];
        if(!empty($request->post('price_filters'))){
            foreach ($request->post('price_filters') as $range) {
                list($min, $max) = explode('-', $range);
                // $lslbWebsite = $lslbWebsite->orWhere(function ($query) use ($min, $max) {
                //     $query->whereBetween('guest_post_price', [$min, $max]);
                // });
                $lslbWebsite = $lslbWebsite->orWhereBetween('guest_post_price', [$min, $max]);
                // $lslbWebsite = $lslbWebsite->whereBetween('guest_post_price', [$min, $max]);
                // $results = $results->merge($filteredRecords);
            }
        } */
        $website = $lslbWebsite->get();
        return response()->json($website);
        // $lslbWebsite->whereIn('categories', $categoryArr);
    }
}
