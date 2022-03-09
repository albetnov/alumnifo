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
        User::create([
            'name'     => 'Root',
            'email'    => 'root@mail.com',
            'password' => bcrypt('root12345'),
        ]);

        User::find(1)->first()->assignRole('SuperAdmin');
    }
}
