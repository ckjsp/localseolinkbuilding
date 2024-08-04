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

    public function projectCreate()
    {
        return view('advertiser/home');
    }

    public function projectStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'project_url' => 'required|string|max:255',
            'categories' => 'required',
            'forbidden_category' => 'required',
            'additional_note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('advertiser.projects.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        $validatedData = $validator->validated();
        $project = lslbProject::create($validatedData);

        return redirect()->route('advertiser.projects.show', ['id' => $project->id])
                         ->with('success', 'Project created successfully!');
    }

    public function update($id)
    {
        $project = lslbProject::findOrFail($id);
        return view('advertiser.projects', compact('project'));
    }

    public function projectUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'project_url' => 'required|string|max:255',
            'categories' => 'required|array',
            'forbidden_category' => 'required|array',
            'additional_note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('advertiser.projects.show', ['id' => $id])
                            ->withErrors($validator)
                            ->withInput();
        }

        $project = lslbProject::findOrFail($id);
        $validatedData = $validator->validated();
        $validatedData['categories'] = json_encode($validatedData['categories']);
        $validatedData['forbidden_category'] = json_encode($validatedData['forbidden_category']);

        $project->update($validatedData);

        return redirect()->route('advertiser.projects.show', ['id' => $project->id])
                        ->with('success', 'Project updated successfully!');
    }
                        
    public function showMenu()
    {
        $projects = lslbProject::select('id', 'project_name')->get()->toArray();
        
        return response()->json([
            'statuscode' => 200,
            'message' => 'Projects retrieved successfully',
            'data' => $projects
        ], 200);
    }
}
