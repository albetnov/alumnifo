<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name'     => 'Root',
            'email'    => 'root@mail.com',
            'password' => bcrypt('root12345'),
        ]);

        $admin->assignRole('SuperAdmin');

        $asep = User::create([
            'name' => 'Asep Surasep',
            'email' => 'asep@mail.com',
            'password' => bcrypt('asep12345')
        ]);

        $asep->assignRole('user');
        $asep->givePermissionTo('participate');
    }
}
