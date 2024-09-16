<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists('get_phrase')) {
    function get_phrase($phrase)
    {
        return $phrase;
    }
}

if (!function_exists('get_user_role')) {
    function get_user_role($id)
    {
        $role_id = User::where('id', $id)->value('role_id');
        $role    = Role::where('id', $role_id)->value('title');
        return $role;
    }
}

if (!function_exists('get_current_user_role')) {
    function get_settings($param)
    {
        return $param;
    }
}
if (!function_exists('get_current_user_role')) {
    function get_current_user_role()
    {
        $role = Role::where('id', Auth::user()->role_id)->value('title');
        return $role;
    }
}
