<?php

namespace Database\Seeders;

use App\Models\Usaha;
use Illuminate\Database\Seeder;

class MembukaUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usaha::factory(30)->create();
    }
}
