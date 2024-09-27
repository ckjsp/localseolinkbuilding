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
            $fileValidation = Validator::make($request->all(), [
                'site_verification_file' => 'file|mimes:pdf,png,jpg,jpeg|max:5120',
            ]);
        }


        if ($validatedData->fails()) {
            $errors = $validatedData->errors()->all();
            return redirect()->back()->withInput()->withErrors($errors);
        } else {

            if ($request->hasFile('site_verification_file')) {
                $path = $request->file('site_verification_file')->store('verification');
            } else {
                $path = null;
            }

            $data = $request->only(['user_id', 'website_url', 'domain_authority', 'domain_rating', 'page_authority', 'spam_score', 'publishing_time', 'minimum_word_count_required', 'backlink_type', 'maximum_no_of_backlinks_allowed', 'domain_life_validity', 'traffic_by_country', 'sample_post_url', 'guidelines', 'categories', 'forbidden_categories', 'guest_post_price', 'link_insertion_price',]);

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
            'domain_rating' => 'required',
            'page_authority' => 'required',
            'spam_score' => 'required',
            'publishing_time' => 'required',
            'minimum_word_count_required' => 'required|max:1000',
            'backlink_type' => 'required',
            'maximum_no_of_backlinks_allowed' => 'required',
            'domain_life_validity' => 'required',
            'traffic_by_country' => 'required',
            'sample_post_url' => 'required|url',
            'guidelines' => 'required|string|max:1000',
            'categories' => 'required',
            'forbidden_categories' => 'required',
            'guest_post_price' => 'required',
            'link_insertion_price' => 'required',

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

            // Handle categories filter
            if (!empty($request->post('selectcategory'))) {
                // Get the selected categories array directly from the request
                $categoryArr = $request->post('selectcategory'); // This should already be an array if multiple is enabled

                $query->where(function ($query) use ($categoryArr) {
                    foreach ($categoryArr as $category) {
                        $query->orWhere('categories', 'LIKE', "%$category%");
                    }
                });
            }

            // Handle categories filter
            if (!empty($request->post('selectcontry'))) {
                // Get the selected categories array directly from the request
                $ContryArr = $request->post('selectcontry'); // This should already be an array if multiple is enabled

                $query->where(function ($query) use ($ContryArr) {
                    foreach ($ContryArr as $Contry) {
                        $query->orWhere('traffic_by_country', 'LIKE', "%$Contry%");
                    }
                });
            }


            // Check if price_filters exists
            if ($request->has('price_filters')) {
                $priceFilters = $request->post('price_filters');

                // Check if price_filters is an array
                if (is_array($priceFilters)) {
                    // If it's an array, loop through each value
                    $query->where(function ($query) use ($priceFilters) {
                        foreach ($priceFilters as $range) {
                            // Ensure the range is valid
                            if (strpos($range, '-') !== false) {
                                list($min, $max) = explode('-', $range);
                                // Use float values to ensure type safety
                                $query->orWhereBetween('guest_post_price', [(float)$min, (float)$max]);
                            }
                        }
                    });
                } else {
                    // If it's a single value, directly apply the filter
                    if (strpos($priceFilters, '-') !== false) {
                        list($min, $max) = explode('-', $priceFilters);
                        $query->whereBetween('guest_post_price', [(float)$min, (float)$max]);
                    }
                }
            }

            if ($request->has('priceMin') && $request->has('priceMax')) {

                $priceMin = $request->input('priceMin');
                $priceMax = $request->input('priceMax');
                if ($priceMin !== null && $priceMax !== null) {
                    $query->whereBetween('guest_post_price', [(float)$priceMin, (float)$priceMax]);
                }
            }


            // Handle backlink type filter
            if (!empty($request->post('backlink_type'))) {
                $query->where('backlink_type', $request->post('backlink_type'));
            }

            // Handle DA filters
            if (!empty($request->post('da_filter'))) {
                $daFilters = $request->post('da_filter');

                // Check if da_filters is an array
                if (is_array($daFilters)) {
                    // If it's an array, loop through each range
                    $query->where(function ($query) use ($daFilters) {
                        foreach ($daFilters as $daRange) {
                            list($min, $max) = explode('-', $daRange);
                            $query->orWhereBetween('domain_authority', [(int)$min, (int)$max]);
                        }
                    });
                } else {
                    // If it's a single value, apply the filter directly
                    list($min, $max) = explode('-', $daFilters);
                    $query->whereBetween('domain_authority', [(int)$min, (int)$max]);
                }
            }


            // Handle Ahrefs traffic filters
            if (!empty($request->post('ahrefs_traffic'))) {
                $trafficFilters = $request->post('ahrefs_traffic');

                // Check if ahrefs_traffics is an array
                if (is_array($trafficFilters)) {
                    // If it's an array, loop through each range
                    $query->where(function ($query) use ($trafficFilters) {
                        foreach ($trafficFilters as $trafficRange) {
                            list($min, $max) = explode('-', $trafficRange);
                            $query->orWhereBetween('ahrefs_traffic', [(int)$min, (int)$max]);
                        }
                    });
                } else {
                    // If it's a single value, apply the filter directly
                    list($min, $max) = explode('-', $trafficFilters);
                    $query->whereBetween('ahrefs_traffic', [(int)$min, (int)$max]);
                }
            }


            // Handle Semrush traffic filters
            if (!empty($request->post('semrush_traffic'))) {
                $trafficFilters = $request->post('semrush_traffic');

                // Check if semrush_traffics is an array
                if (is_array($trafficFilters)) {
                    // If it's an array, loop through each range
                    $query->where(function ($query) use ($trafficFilters) {
                        foreach ($trafficFilters as $trafficRange) {
                            list($min, $max) = explode('-', $trafficRange);
                            // Check if min and max are numeric before adding to query
                            if (is_numeric($min) && is_numeric($max)) {
                                $query->orWhereBetween('samrush_traffic', [(int)$min, (int)$max]);
                            }
                        }
                    });
                } else {
                    // If it's a single value, apply the filter directly
                    list($min, $max) = explode('-', $trafficFilters);
                    // Check if min and max are numeric before adding to query
                    if (is_numeric($min) && is_numeric($max)) {
                        $query->whereBetween('samrush_traffic', [(int)$min, (int)$max]);
                    }
                }
            }

            // Handle Domain Ratings filters
            if (!empty($request->post('domain_rating'))) {
                $ratingsFilters = $request->post('domain_rating');

                // Check if domain_ratings is an array
                if (is_array($ratingsFilters)) {
                    // If it's an array, loop through each range
                    $query->where(function ($query) use ($ratingsFilters) {
                        foreach ($ratingsFilters as $ratingRange) {
                            list($min, $max) = explode('-', $ratingRange);
                            // Check if min and max are numeric before adding to query
                            if (is_numeric($min) && is_numeric($max)) {
                                $query->orWhereBetween('domain_rating', [(int)$min, (int)$max]);
                            }
                        }
                    });
                } else {
                    // If it's a single value, apply the filter directly
                    list($min, $max) = explode('-', $ratingsFilters);
                    // Check if min and max are numeric before adding to query
                    if (is_numeric($min) && is_numeric($max)) {
                        $query->whereBetween('domain_rating', [(int)$min, (int)$max]);
                    }
                }
            }

            // Handle selected days filter
            if (!empty($request->post('selectday'))) {
                $days = $request->post('selectday');
                $dateLimit = now()->subDays(max($days)); // Get the date limit based on selected days
                $query->where('created_at', '>=', $dateLimit); // Adjust this to your relevant date field
            }


            $query->where('status', 'approve');
            $query->where('deleted_at', null);
        });

        $website = $lslbWebsite->get();
        return response()->json($website);
    }
}
