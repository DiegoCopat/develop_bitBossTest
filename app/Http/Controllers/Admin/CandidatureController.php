<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\StatusCandidature;
use App\Models\Candidature;
use App\Models\User;
use App\Notifications\SlackNotification;
use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Candidature/Index', [
            'candidatures' => Candidature::orderBy('created_at', 'DESC')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'String', 'max:255'],
            'last_name' => ['required', 'String', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:candidatures'],
            'phone' => ['required', 'String', 'max:15'],
            'notes' => ['required', 'String'],
        ]); 

        $new_candidature = Candidature::create([
            'user_id' => $user->id,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'notes' => $request['notes'],
        ]);

        $address_to = 'diego@easy-life.it';
        $message = 'Grazie per aver inviato la tua candidatura, riceverai presto nostre notizie!';
        $object = "Candidatura ricevuta!";

        Mail::to($address_to)->send(new StatusCandidature($message, $object));

        // selezione del responsabile per l'invio della notifica sul gruppo Slack
        
        $send_notification_to_user = User::find(12);
        $send_notification_to_user->notify(new SlackNotification());
        
        return Redirect::back()->with('sessionGreen', 'Complimenti, la tua candidatura è stata inviata con successo! Verrai contattato presto dal nostro personale');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $candidature_id)
    {
        $request->validate([
            'change_to' => ['required', Rule::in(['in verifica', 'approvato', 'rifiutato'])],
        ]);

        $candidature = Candidature::find($candidature_id);

        $candidature->status = $request['change_to'];
        $candidature->save();

        $address_to = 'diego@easy-life.it';
        $object = "Risultato candidatura!";

        if($request['change_to'] == 'approvato') {
            
            $message = 'Complimenti, la tua candidatura è stata approva e presto sarai contattato da qualcuno del nostro staff!';
    
            Mail::to($address_to)->send(new StatusCandidature($message, $object));
            
        }else if($request['change_to'] == 'rifiutato') {
            $message = 'Siamo spiacenti, la tua candidatura non è in linea con le nostre richieste, ti ringraziamo comunque per averci inviato il tuo lavoro!';

            Mail::to($address_to)->send(new StatusCandidature($message, $object));
        }

        return response()->json([
            'candidature_status' => $candidature->status,
            'sessionGreen' => 'La modifica è stata apportata con successo!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status(string $id) {

        $user = Auth::user();
        
        if($user->hasRole('staff')) {
            $candidatures = Candidature::orderBy('created_at', 'DESC')->get();
        }else if($user->hasRole('staff')) {
            $candidatures = Candidature::where('user_id', $user->id)->get();
        }else {
            $candidatures = null;
        }

        return Inertia::render('Auth/Candidatures/index', [
            'candidature' => $candidatures,
        ]);
    }
}
