<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();

        if (get_current_user_role() == 'client') {
            $page_data['projects'] = Project::where('client_id', $user->id)->get();
        } elseif (get_current_user_role() == 'staff') {
            $page_data['projects'] = Project::whereJsonContains('staffs', (string) $user->id)->get();
        } else {
            $page_data['projects'] = Project::all();
        }

        return view('projects.index', $page_data);
    }

    public function show()
    {
        return view('projects.details');
    }

    public function create()
    {
        $page_data['projects'] = Project::get();
        $client                = Role::where('title', 'client')->first();
        $page_data['clients']  = User::where('role_id', $client->id)->get();
        $staffs                = Role::where('title', 'staff')->first();
        $page_data['staffs']   = User::where('role_id', $staffs->id)->get();

        return view('projects.create', $page_data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'           => 'required|string|max:255',
            'code'            => 'required|string|max:255',
            'description'     => 'required|string',
            'category_id'     => 'required|integer',
            'client_id'       => 'required|integer',
            'staffs'          => 'required|array',
            'budget'          => 'required|numeric',
            'progress_status' => 'required|string|max:255',
            'status'          => 'required|string|max:255',
            'note'            => 'required|string',
            'privacy'         => 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $project['title']           = htmlspecialchars($request->title);
        $project['code']            = Str::random(6);
        $project['description']     = htmlspecialchars($request->description);
        $project['category_id']     = htmlspecialchars($request->category_id);
        $project['client_id']       = htmlspecialchars($request->client_id);
        $project['staffs']          = json_encode($request->staffs);
        $project['budget']          = htmlspecialchars($request->budget);
        $project['progress_status'] = htmlspecialchars($request->progress_status);
        $project['status']          = htmlspecialchars($request->status);
        $project['note']            = htmlspecialchars($request->note);
        $project['privacy']         = htmlspecialchars($request->privacy);
        $project['timestamp_start'] = date('Y-m-d H:i:s', time());
        $project['timestamp_end']   = date('Y-m-d H:i:s', time());

        Project::insert($project);

        return response()->json([
            'success' => 'Product has been stored.',
        ]);
    }
    public function delete($code)
    {
        Project::where('code', $code)->delete();
        return response()->json([
            'success' => 'Product has been deleted.',
        ]);
    }

    public function edit($code)
    {
        $project['project'] = Project::where('code', $code)->first();

        $client             = Role::where('title', 'client')->first();
        $project['clients'] = User::where('role_id', $client->id)->get();

        $staffs            = Role::where('title', 'staff')->first();
        $project['staffs'] = User::where('role_id', $staffs->id)->get();

        return view('projects.edit', $project);
    }

    public function update(Request $request, $code)
    {
        $project['title']           = htmlspecialchars($request->title);
        $project['description']     = htmlspecialchars($request->description);
        $project['category_id']     = htmlspecialchars($request->category_id);
        $project['client']          = htmlspecialchars($request->client);
        $project['staffs']          = json_decode($request->staffs);
        $project['budget']          = htmlspecialchars($request->budget);
        $project['progress_status'] = htmlspecialchars($request->progress_status);
        $project['status']          = htmlspecialchars($request->status);
        $project['note']            = htmlspecialchars($request->note);
        $project['privacy']         = htmlspecialchars($request->privacy);
        $project['timestamp_start'] = date('Y-m-d H:i:s', time());
        $project['timestamp_end']   = date('Y-m-d H:i:s', time());

        Project::where('code', $code)->update($project);

        return response()->json([
            'success' => 'Product has been updated.',
        ]);
    }

    public function multiDelete(Request $request)
    {
        $codes = $request->input('data');
        if (!empty($codes)) {
            Project::whereIn('code', $codes)->delete();
            return response()->json(['success' => 'Project deleted successfully!']);
        }

        return response()->json(['error' => 'No project selected for deletion.'], 400);
    }
}
