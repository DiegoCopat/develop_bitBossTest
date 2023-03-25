<?php

use App\Http\Controllers\Admin\CandidatureController;
use App\Http\Controllers\Auth\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/candidatura', [HomeController::class, 'candidature'])->name('auth.candidature');

    Route::post('/invio-candidatura', [CandidatureController::class, 'store'])->name('auth.candidature.store');

    Route::get('stato-della-candidatura', [CandidatureController::class, 'status'])->name('auth.candidature.status');
});


