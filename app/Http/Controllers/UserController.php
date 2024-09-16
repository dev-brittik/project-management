<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $page_data = User::paginate(10);
        return view('users.index', $page_data);
    }

    public function create()
    {
        $page_data['role_id'] = request()->query('id');
        return view('users.create', $page_data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validationError' => $validator->getMessageBag()->toArray(),
            ]);
        }
        $data['role_id']  = htmlspecialchars($request->role_id);
        $data['name']     = htmlspecialchars($request->name);
        $data['email']    = htmlspecialchars($request->email);
        $data['password'] = Hash::make($request->password);

        User::insert($data);
        return response()->json([
            'success' => 'User has been stored.',
        ]);
    }

    public function edit(Request $request, $id)
    {
        $data['user'] = User::where('id', $id)->first();
        return view('users.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $data['name']  = htmlspecialchars($request->name);
        $data['email'] = htmlspecialchars($request->email);

        User::where('id', $request->id)->update($data);

        return response()->json([
            'success' => 'User has been updated.',
        ]);
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return response()->json([
            'success' => 'User has been deleted.',
        ]);
    }
}
