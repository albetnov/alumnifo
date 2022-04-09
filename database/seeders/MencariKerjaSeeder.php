<?php

namespace Database\Seeders;

use App\Models\MencariKerja;
use Illuminate\Database\Seeder;

class MencariKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MencariKerja::factory(30)->create();
    }
}
