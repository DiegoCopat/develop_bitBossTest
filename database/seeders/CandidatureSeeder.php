<?php

namespace Database\Seeders;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('candidate')->get();

        foreach($users as $user) {

            Candidature::create([
                'user_id' => $user->id,
                'first_name' => explode(" ", $user->name)[0],
                'last_name' => explode(" ", $user->name)[1],
                'email' => $user->email,
                'phone' => 'xxx-xxxxxxx',
                'notes' => 'Questa è la mia candidatura',
                'status' => 'in verifica',
            ]);
        }
    }
}
