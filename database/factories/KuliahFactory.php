<?php

namespace Database\Factories;

use App\Models\Kuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kuliah>
 */
class KuliahFactory extends Factory
{
    protected $model = Kuliah::class;

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
            'nama_universitas' => $this->faker->sentence(),
            'jurusan'          => $this->faker->word(),
            'dibuat'           => 'Root',
        ];
    }
}
