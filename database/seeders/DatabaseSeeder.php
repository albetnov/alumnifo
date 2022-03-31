<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TeamsSeeder::class);
        $this->call(PublicContact::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KerjaSeeder::class);
        $this->call(KuliahSeeder::class);
        $this->call(KerjaKuliahSeeder::class);
        $this->call(MencariKerjaSeeder::class);
        $this->call(MembukaUsahaSeeder::class);
    }
}
