<?php

use App\Http\Controllers\Admin\CandidatureController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/

Route::middleware([
    'auth:sanctum',
    'role:staff',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/home', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('candidature', CandidatureController::class)->except(['create', 'store']);

});
