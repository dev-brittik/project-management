<?php

namespace App\Addons\Event\Controllers;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function events()
    {
        return view('event::event.events')->render();
    }
}
