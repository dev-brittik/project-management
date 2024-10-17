<?php

use App\Addons\Event\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::name('event.')->controller(EventController::class)->group(function () {
    Route::get('events', 'events')->name('events');
});
