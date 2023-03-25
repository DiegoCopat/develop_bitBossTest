<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'staff']);
        $role = Role::create(['name' => 'candidate']);

        $users = User::all();

        $count = 0;

        foreach ($users as $user) {
            if($count <= count($users) - 3) {
                $user->assignRole('staff');
            }else {
                $user->assignRole('candidate');
            }
            $count ++;
        }
    }
}
