<?php

namespace Database\Seeders;

use App\Models\Teams;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teams::create([
            'name'         => 'Albet Novendo',
            'desc'         => 'Lead Developer',
            'link_twitter' => 'https://twitter.com/AlbetNv',
            'link_ig'      => 'https://instagram.com/al_nv4',
            'link_fb'      => 'https://www.facebook.com/profile.php?id=100077882502140',
            'photo'        => 'sample1.jpg',
        ]);
        Teams::create([
            'name'         => 'Sendy Wahyudi',
            'desc'         => 'UI/UX',
            'link_twitter' => 'https://twitter.com/sendy_tampan',
            'link_ig'      => 'https://instagram.com/sendy_hits',
            'link_fb'      => 'https://facebook.com/sendy_pro',
            'link_in'      => 'https://linkedin.com/ZzSendyZz',
            'photo'        => 'sample2.jpg',
        ]);
        Teams::create([
            'name'         => 'Irwanda Andika',
            'desc'         => 'Developer',
            'photo'        => 'sample3.jpg',
            'link_twitter' => 'https://twitter.com/udah_pagi',
            'link_fb'      => 'https://www.facebook.com/irwanda.andika.1',
            'link_in'      => 'https://www.linkedin.com/in/irwanda-andika-putra-4911871ba/',
            'link_ig'      => 'https://www.instagram.com/wandabiasaaja/',
        ]);
    }
}
