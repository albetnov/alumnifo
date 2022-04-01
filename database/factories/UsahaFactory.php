<?php

namespace Database\Factories;

use App\Models\Usaha;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usaha>
 */
class UsahaFactory extends Factory
{
    protected $model = Usaha::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jk = ['l', 'p'];

        return [
            'name'                 => $this->faker->name(),
            'jenis_kelamin'        => $jk[rand(0, 1)],
            'jenis_usaha'          => $this->faker->sentence(),
            'alamat_usaha'         => $this->faker->streetAddress(),
            'tahun_usaha'          => rand(2000, 2100),
            'dibuat'               => 'Root',
        ];
    }
}
