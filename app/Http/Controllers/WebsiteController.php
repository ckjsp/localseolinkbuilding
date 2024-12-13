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

    public function index()
    {
        $this->chekRole();
        $data = array();
        $data['slug'] = 'websites';
        $data['websites'] = lslbWebsite::where('user_id', Auth::user()->id)->get();
        return view('publisher/website')->with($data);
    }


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
            'minimum_word_count_required' => 'required',
            'backlink_type' => 'required',
            'maximum_no_of_backlinks_allowed' => 'required',
            'domain_life_validity' => 'required',
            'sample_post_url' => 'required|url',
            'guidelines' => 'nullable|string',
            'categories' => 'required',
            'forbidden_categories' => 'nullable',
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

        $path = $request->hasFile('site_verification_file')
            ? $request->file('site_verification_file')->store('verification')
            : null;

        $data = $request->only([
            'user_id',
            'website_url',
            'domain_authority',
            'page_authority',
            'spam_score',
            'publishing_time',
            'minimum_word_count_required',
            'backlink_type',
            'maximum_no_of_backlinks_allowed',
            'domain_life_validity',
            'sample_post_url',
            'guidelines',
            'forbidden_categories',
            'guest_post_price',
            'link_insertion_price',
        ]);

        $categories = $request->input('categories', []);
        $forbiddenCategories = $request->input('forbidden_categories', []);
        $data['forbidden_categories'] = !empty($forbiddenCategories)
            ? implode(',', $forbiddenCategories)
            : null;

        $data['categories'] = implode(',', $categories);

        $data['user_id'] = Auth::user()->id;
        $data['status'] = 'pending';
        $data['site_verification_file'] = $path;
        $data['fc_guest_post_price'] = 0;
        $data['fc_link_insertion_price'] = 0;
        $data['ahrefs_traffic'] = 0;
        $data['samrush_traffic'] = 0;
        $data['google_analytics'] = 0;

        lslbWebsite::create($data);

        $customData = [
            'userName' => Auth::user()->name,
            'websiteUrl' => $request->post('website_url'),
        ];

        Mail::send('email.website_added', $customData, function ($message) {
            $message->to('miteshdalsaniya@jspinfotech.com')
                ->subject('Notification: Links Farmer - New Website Added');
        });


        return redirect()->route('publisher.website')->with('success', 'Record added successfully');
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
            abort(404);
        }

        return view('publisher/website_create')->with($data);
    }


    public function update(Request $request, string $id)
    {
        $this->chekRole();
        $website = lslbWebsite::find($id);

        if (!$website) {
            abort(404);
        }

        $validatedData = $request->validate([
            'domain_authority' => 'required',
            'page_authority' => 'required',
            'spam_score' => 'required',
            'publishing_time' => 'required',
            'minimum_word_count_required' => 'required',
            'backlink_type' => 'required',
            'maximum_no_of_backlinks_allowed' => 'required',
            'domain_life_validity' => 'required',
            'sample_post_url' => 'required|url',
            'guidelines' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'string',
            'forbidden_categories' => 'nullable',
            'guest_post_price' => 'required',
            'link_insertion_price' => 'required',
        ]);

        if ($request->hasFile('site_verification_file')) {
            $request->validate([
                'site_verification_file' => 'required|file|mimes:pdf,png,jpg|max:5120',
            ]);

            if ($request->file('site_verification_file')->isValid()) {
                $path = $request->file('site_verification_file')->store('verification');
            } else {
                return redirect()->back()->with('error', 'File upload failed.');
            }
        } else {
            $path = $request->post('old_site_verification_file');
        }

        $categories = is_array($request->input('categories', [])) ? implode(',', $request->input('categories', [])) : '';

        $forbiddenCategories = is_array($request->input('forbidden_categories', []))
            ? implode(',', $request->input('forbidden_categories', []))
            : null;

        $validatedData['categories'] = $categories;
        $validatedData['forbidden_categories'] = $forbiddenCategories;
        $validatedData['site_verification_file'] = $path;

        $website->update($validatedData);

        return redirect()->route('publisher.website')->with('success', 'Record updated successfully');
    }


    public function destroy(string $id)

    {
        $this->chekRole();
        $website = lslbWebsite::find($id);

        if (!$website) {
            abort(404);
        }
        $website->update([
            'website_url' => 'delete-' . $website->website_url,
        ]);
        $website->delete();
        return redirect()->route('publisher.website')->with('success', 'Record deleted successfully');
    }


    public function filterData(Request $request)

    {


        $lslbWebsite = new lslbWebsite;
        $lslbWebsite = $lslbWebsite->where(function ($query) use ($request) {

            if (!empty($request->post('selectcategory'))) {
                $categoryArr = $request->post('selectcategory');

                $query->where(function ($query) use ($categoryArr) {
                    foreach ($categoryArr as $category) {
                        $query->orWhere('categories', 'LIKE', "%$category%");
                    }
                });
            }




            if ($request->has('price_filters')) {
                $priceFilters = $request->post('price_filters');

                if (is_array($priceFilters)) {
                    $query->where(function ($query) use ($priceFilters) {
                        foreach ($priceFilters as $range) {
                            if (strpos($range, '-') !== false) {
                                list($min, $max) = explode('-', $range);
                                $query->orWhereBetween('guest_post_price', [(float)$min, (float)$max]);
                            }
                        }
                    });
                } else {
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


            if (!empty($request->post('backlink_type'))) {
                $query->where('backlink_type', $request->post('backlink_type'));
            }

            if (!empty($request->post('da_filter'))) {
                $daFilters = $request->post('da_filter');

                if (is_array($daFilters)) {
                    $query->where(function ($query) use ($daFilters) {
                        foreach ($daFilters as $daRange) {
                            list($min, $max) = explode('-', $daRange);
                            $query->orWhereBetween('domain_authority', [(int)$min, (int)$max]);
                        }
                    });
                } else {
                    list($min, $max) = explode('-', $daFilters);
                    $query->whereBetween('domain_authority', [(int)$min, (int)$max]);
                }
            }


            if (!empty($request->post('ahrefs_traffic'))) {
                $trafficFilters = $request->post('ahrefs_traffic');

                if (is_array($trafficFilters)) {
                    $query->where(function ($query) use ($trafficFilters) {
                        foreach ($trafficFilters as $trafficRange) {
                            list($min, $max) = explode('-', $trafficRange);
                            $query->orWhereBetween('ahrefs_traffic', [(int)$min, (int)$max]);
                        }
                    });
                } else {
                    list($min, $max) = explode('-', $trafficFilters);
                    $query->whereBetween('ahrefs_traffic', [(int)$min, (int)$max]);
                }
            }


            if (!empty($request->post('semrush_traffic'))) {
                $trafficFilters = $request->post('semrush_traffic');

                if (is_array($trafficFilters)) {
                    $query->where(function ($query) use ($trafficFilters) {
                        foreach ($trafficFilters as $trafficRange) {
                            list($min, $max) = explode('-', $trafficRange);
                            if (is_numeric($min) && is_numeric($max)) {
                                $query->orWhereBetween('samrush_traffic', [(int)$min, (int)$max]);
                            }
                        }
                    });
                } else {
                    list($min, $max) = explode('-', $trafficFilters);
                    if (is_numeric($min) && is_numeric($max)) {
                        $query->whereBetween('samrush_traffic', [(int)$min, (int)$max]);
                    }
                }
            }


            if (!empty($request->post('selectday'))) {
                $days = $request->post('selectday');
                $dateLimit = now()->subDays(max($days));
                $query->where('created_at', '>=', $dateLimit);
            }


            $query->where('status', 'approve');
            $query->where('deleted_at', null);
        });

        $website = $lslbWebsite->get();
        return response()->json($website);
    }
}
