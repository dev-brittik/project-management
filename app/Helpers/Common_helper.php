<?php

use App\Models\Milestone;
use App\Models\Role;
use App\Models\Task;
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
if (!function_exists('get_user_info')) {
    function get_user_info($user_id = "")
    {
        $user_info = App\Models\User::where('id', $user_id)->firstOrNew();
        return $user_info;
    }
}

if (!function_exists('timeAgo')) {
    function timeAgo($time_ago)
    {
        $time_ago     = strtotime($time_ago);
        $cur_time     = time();
        $time_elapsed = $cur_time - $time_ago;
        $seconds      = $time_elapsed;
        $minutes      = round($time_elapsed / 60);
        $hours        = round($time_elapsed / 3600);
        $days         = round($time_elapsed / 86400);
        $weeks        = round($time_elapsed / 604800);
        $months       = round($time_elapsed / 2600640);
        $years        = round($time_elapsed / 31207680);
        // Seconds
        if ($seconds <= 60) {
            return "just now";
        }
        //Minutes
        else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 minute ago";
            } else {
                return "$minutes minutes ago";
            }
        }
        //Hours
        else if ($hours <= 24) {
            if ($hours == 1) {
                return "1 hour ago";
            } else {
                return "$hours hours ago";
            }
        }
        //Days
        else if ($days <= 7) {
            if ($days == 1) {
                return "Yesterday";
            } else {
                return "$days days ago";
            }
        }
        //Weeks
        else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "1 week ago";
            } else {
                return "$weeks weeks ago";
            }
        }
        //Months
        else if ($months <= 12) {
            if ($months == 1) {
                return "1 month ago";
            } else {
                return "$months months ago";
            }
        }
        //Years
        else {
            if ($years == 1) {
                return "1 year ago";
            } else {
                return "$years years ago";
            }
        }
    }
}

if (!function_exists('get_task_progress')) {
    function get_task_progress($milestone_id = "")
    {
        $tasks = Milestone::where('id', $milestone_id)->value('tasks');
        if (count($tasks) > 0) {
            $total_progress = Task::whereIn('id', $tasks)->sum('progress');
            $count_tasks    = Task::whereIn('id', $tasks)->count();
            $avg            = $total_progress / $count_tasks;
            return $avg;
        }
        return 0;
    }
}
