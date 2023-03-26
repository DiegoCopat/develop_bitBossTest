<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function candidature() {

        $user = Auth::user();
        $candidature = Candidature::where('user_id', $user->id)->first();
        return Inertia::render('Authenticated/Candidature', [
            'candidature' => $candidature
        ]);

    }

}
