<?php

namespace App\Http\Controllers;

use App\Models\ProjectTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{

    public function index(Request $request, $id)
    {

        $page_data['project_tasks'] = Task::paginate(10);
        return view('projects.task.index', $page_data);
    }

    public function create()
    {
        $page_data['project_id']   = request()->query('id');
        $page_data['milestone_id'] = request()->query('id');
        return view('projects.task.create', $page_data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationError' => $validator->getMessageBag()->toArray(),
            ]);
        }

        $data['title']        = htmlspecialchars($request->title);
        $data['project_id']   = htmlspecialchars($request->project_id);
        $data['milestone_id'] = htmlspecialchars($request->milestone_id);
        $data['milestone']    = htmlspecialchars($request->milestone);
        $data['status']       = htmlspecialchars($request->status);
        $data['progress']     = htmlspecialchars($request->progress);
        $data['client']       = htmlspecialchars($request->client);
        $data['team']         = htmlspecialchars($request->team);
        $data['start_date']   = strtotime($request->start_date);
        $data['end_date']     = strtotime($request->end_date);

        Task::insert($data);
        return response()->json([
            'success' => 'Task has been stored.',
        ]);
    }

    public function delete($id)
    {
        Task::where('id', $id)->delete();
        return response()->json([
            'success' => 'Task has been deleted.',
        ]);
    }

    public function edit(Request $request, $id)
    {

        $data['task'] = Task::where('id', $id)->first();
        return view('projects.task.edit', $data);
    }
    public function update(Request $request, $id)
    {

        $project['title']      = htmlspecialchars($request->title);
        $project['milestone']  = htmlspecialchars($request->milestone);
        $project['status']     = htmlspecialchars($request->status);
        $project['progress']   = htmlspecialchars($request->progress);
        $project['client']     = htmlspecialchars($request->client);
        $project['team']       = htmlspecialchars($request->team);
        $project['start_date'] = strtotime($request->start_date);
        $project['end_date']   = strtotime($request->end_date);
        Task::where('id', $request->id)->update($project);

        return response()->json([
            'success' => 'Task has been updated.',
        ]);
    }

    public function multiDelete(Request $request)
    {
        $ids = $request->input('data');

        if (!empty($ids)) {
            Task::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Tasks deleted successfully!']);
        }

        return response()->json(['error' => 'No tasks selected for deletion.'], 400);
    }

}
