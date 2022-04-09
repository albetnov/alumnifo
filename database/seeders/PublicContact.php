<?php

namespace Database\Seeders;

use App\Models\PublicContact as ModelsPublicContact;
use Illuminate\Database\Seeder;

class PublicContact extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsPublicContact::factory(20)->create();
    }
}
