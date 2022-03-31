<?php

namespace Database\Factories;

use App\Models\MencariKerja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MencariKerja>
 */
class MencariKerjaFactory extends Factory
{
    protected $model = MencariKerja::class;

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
            'alamat'               => $this->faker->streetAddress(),
            'alasan_mencari_kerja' => $this->faker->paragraph(),
            'kontak'               => $this->faker->phoneNumber(),
            'dibuat'               => 'Root',
        ];
    }
}
