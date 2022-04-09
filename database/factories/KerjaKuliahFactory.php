<?php

namespace Database\Factories;

use App\Models\KerjaKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KerjaKuliah>
 */
class KerjaKuliahFactory extends Factory
{
    protected $model = KerjaKuliah::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $jk = ['l', 'p'];

        return [
            'name'             => $this->faker->name(),
            'jenis_kelamin'    => $jk[rand(0, 1)],
            'nama_perusahaan'  => $this->faker->company(),
            'jabatan'          => $this->faker->companySuffix(),
            'tahun_kerja'      => rand(2000, 2100),
            'nama_universitas' => $this->faker->sentence(),
            'jurusan'          => $this->faker->word(),
            'dibuat'           => 'Root',
        ];
    }
}
