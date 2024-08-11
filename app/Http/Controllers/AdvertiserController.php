<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\lslbWebsite;
use App\Models\lslbOrder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\lslbProject;

Validator::extend('url', function ($attribute, $value, $parameters, $validator) {
    return preg_match('/^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/', $value);
});

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
    private function getCommonData()
    {
        $data = [];
        if (Auth::check()) {
            $data['orderCount'] = lslbOrder::where('u_id', Auth::id())->count();
            $data['successOrderCount'] = lslbOrder::where('u_id', Auth::id())->where('payment_status', 'success')->count();
            $data['pendingOrderCount'] = lslbOrder::where('u_id', Auth::id())->where('payment_status', 'pending')->count();
            $data['progressingOrderCount'] = lslbOrder::where('u_id', Auth::id())->where('payment_status', 'progressing')->count();
            $data['failedOrderCount'] = lslbOrder::where('u_id', Auth::id())->where('payment_status', 'failed')->count();
        }
        return $data;
    }
    public function index($page = 'home')
    {
        $data = array();
        if (Auth::user()) {
            $data['orderCount'] = lslbOrder::where('u_id', Auth::user()->id)->count();
            $data['successOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'success')->count();
            $data['pendingOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'pending')->count();
            $data['progressingOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'progressing')->count();
            $data['failedOrderCount'] = lslbOrder::where('u_id', Auth::user()->id)->where('payment_status', 'failed')->count();

            $userId = Auth::user()->id;
            //$projects = lslbProject::all();
            $projects = lslbProject::where('user_id', $userId)->get();
            $selectedProjectId = session('selected_project_id', $projects->first()->id ?? null);
            $selectedProject = $projects->where('id', $selectedProjectId)->first();
            if ($selectedProject) {
                $projects = $projects->filter(function ($project) use ($selectedProjectId) {
                    return $project->id !== $selectedProjectId;
                })->prepend($selectedProject);
            }

            $data['projects'] = $projects;
            $data['selectedProject'] = $selectedProject;

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
        if (!Auth::check()) {
            return redirect('/login');
        }

        $data = $this->getCommonData();
        //$data['project'] = lslbProject::findOrFail($id);
        return view('advertiser/home')->with($data);
        //return view('advertiser/home');
    }

    public function projectStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'project_url' => 'required|url',
            'projectCategories' => 'required|array',
            'projectForbiddenCategories' => 'required|array',
            'additional_note' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('advertiser.projects.create')
                ->withErrors($validator)
                ->withInput();
        }
    
        try {
            $validatedData = $validator->validated();
    
            $user_id = Auth::user()->id;
            $data = [
                'user_id' => $user_id,
                'project_name' => $validatedData['project_name'],
                'project_url' => $validatedData['project_url'],
                'categories' => serialize($validatedData['projectCategories']),
                'forbidden_category' => serialize($validatedData['projectForbiddenCategories']),
                'additional_note' => $validatedData['additional_note'],
            ];
    
            $result = lslbProject::create($data);
            // session()->flash('project_created', true);

            cookie()->queue(cookie()->forever('new_project_created', true));
    
            // Return a success response
            return redirect()->route('advertiser.projects.store')
                ->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('advertiser.projects.create')
                ->with('error', 'Failed to create project. Please try again later.')
                ->withInput();
        }
    }
    

    public function projectEdit($id)
    {
        $getProjectDetail = lslbProject::find($id);
        $getProjectDetail->categories = unserialize($getProjectDetail->categories);
        $getProjectDetail->forbidden_category = unserialize($getProjectDetail->forbidden_category);

        return response()->json($getProjectDetail);
    }

    public function projectUpdate(Request $request, $id)
    {
        if (isset($id)) {
            $validator = Validator::make($request->all(), [
                'project_name' => 'required|string|max:255',
                'project_url' => 'required|url',
                'projectCategories' => 'required|array',
                'projectForbiddenCategories' => 'required|array',
                'additional_note' => 'nullable|string',
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('advertiser')
                    ->withErrors($validator)
                    ->withInput();
            }
    
            try {
                $validatedData = $validator->validated();
    
                $project = lslbProject::findOrFail($id);
    
                $project->update([
                    'project_name' => $validatedData['project_name'],
                    'project_url' => $validatedData['project_url'],
                    'categories' => serialize($validatedData['projectCategories']),
                    'forbidden_category' => serialize($validatedData['projectForbiddenCategories']),
                    'additional_note' => $validatedData['additional_note'],
                ]);
    
                return redirect()->route('advertiser')->with('success', 'Project updated successfully');
            } catch (\Exception $e) {
                return redirect()->route('advertiser')
                    ->with('error', 'Failed to update project. Please try again later.')
                    ->withInput();
            }
        }
    
        return redirect()->route('advertiser')->with('error', 'Project ID is missing.');
    }
    

    public function showMenu()
    {
        $userId = Auth::id();
        $projects = lslbProject::select('id', 'project_name')->where('user_id', $userId)->get()->toArray();

        return response()->json([
            'statuscode' => 200,
            'message' => 'Projects retrieved successfully',
            'data' => $projects
        ], 200);
    }
    public function getProjectName(Request $request)
    {
        $projectId = $request->input('id');
        $project = lslbProject::find($projectId);

        if ($project) {
            session(['selected_project_id' => $projectId]);
            return response()->json([
                'success' => true,
                'project_name' => $project->project_name
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Project not found'
            ]);
        }
    }
    public function setSelectedProject(Request $request)
    {
        $selectedProjectId = $request->input('selected_project_id');
        session(['selected_project_id' => $selectedProjectId]);

        return response()->json(['success' => true]);
    }
}
