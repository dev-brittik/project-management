<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function index(Request $request)
    {

        $page_data['meetings'] = Meeting::paginate(10);
        return view('projects.meeting.index', $page_data);
    }

    public function create()
    {
        $page_data['project_id'] = request()->query('id');
        return view('projects.meeting.create', $page_data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'time'  => 'required|date',
            'link'  => 'required|url',

            // 'audience' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationError' => $validator->getMessageBag()->toArray(),
            ]);
        }

        $data['project_id'] = htmlspecialchars($request->project_id);
        $data['title']      = htmlspecialchars($request->title);
        $data['time']       = htmlspecialchars($request->time);
        $data['link']       = htmlspecialchars($request->link);

        Meeting::insert($data);
        return response()->json([
            'success' => 'Meeting has been stored.',
        ]);
    }

    public function delete($id)
    {
        Meeting::where('id', $id)->delete();
        return response()->json([
            'success' => 'Meeting has been deleted.',
        ]);
    }

    public function edit(Request $request, $id)
    {

        $data['meeting'] = Meeting::where('id', $id)->first();
        return view('projects.meeting.edit', $data);
    }
    public function update(Request $request, $id)
    {

        $project['title'] = htmlspecialchars($request->title);

        Meeting::where('id', $request->id)->update($project);

        return response()->json([
            'success' => 'Meeting has been updated.',
        ]);
    }

    public function multiDelete(Request $request)
    {
        $ids = $request->input('data');

        if (!empty($ids)) {
            Meeting::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Meeting deleted successfully!']);
        }

        return response()->json(['error' => 'No meeting selected for deletion.'], 400);
    }

    public function join($id, Request $request)
    {
        $meeting = Meeting::where('id', $id)->first();
        $project = Project::where('id', $meeting->project_id)->first();

        $audience = $meeting->audience ? json_decode($meeting->audience) : [];

        if ($project->user_id != Auth::user()->id) {
            $audience[] = Auth::user()->id;
            json_encode($audience);

            Meeting::find($id)->update(['audience' => $audience]);
        }

        return redirect($meeting->link);
    }

}
