<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function home() {

        return Inertia::render('Guest/Home');
    }

    public function apply() {
        return Inertia::render('Guest/Apply');
    }

    public function postApply() {

    }
}
