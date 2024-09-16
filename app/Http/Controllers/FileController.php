<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class FileController extends Controller
{
    public function index(Request $request)
    {

        $page_data['files'] = File::paginate(10);
        return view('projects.file.index', $page_data);

    }
    public function create()
    {
        $page_data['project_id'] = request()->query('id');
        $page_data['user_id']    = request()->query('id');
        return view('projects.file.create', $page_data);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            // 'file'  => 'required|file|max:3072',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationError' => $validator->getMessageBag()->toArray(),
            ]);
        }

        $file = $request->file('file');

        $data['project_id'] = htmlspecialchars($request->project_id);
        $data['title']      = htmlspecialchars($request->title);
        $data['extension']  = $file->getClientOriginalExtension();
        $data['size']       = round(($file->getSize() / 1048576), 2);
        $data['file']       = FileUploader::upload($file, 'file');

        File::insert($data);
        return response()->json([
            'success' => 'File has been stored.',
        ]);
    }

    public function delete($id)
    {
        File::where('id', $id)->delete();
        return response()->json([
            'success' => 'File has been deleted.',
        ]);
    }

    public function edit(Request $request, $id)
    {

        $data['file'] = File::where('id', $id)->first();
        return view('projects.file.edit', $data);
    }
    public function update(Request $request, $id)
    {

        $project['title'] = htmlspecialchars($request->title);

        File::where('id', $request->id)->update($project);

        return response()->json([
            'success' => 'File has been updated.',
        ]);
    }

    public function multiDelete(Request $request)
    {
        $ids = $request->input('data');

        if (!empty($ids)) {
            File::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Files deleted successfully!']);
        }

        return response()->json(['error' => 'No files selected for deletion.'], 400);
    }

    public function download($id)
    {
        $file      = File::where('id', $id)->first();
        $file_path = public_path($file->path);

        return Response::download($file_path);
    }
}
