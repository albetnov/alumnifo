<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicContact>
 */
class PublicContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->name(),
            'email'   => $this->faker->email(),
            'subject' => $this->faker->text(50),
            'message' => $this->faker->paragraph(3),
        ];
    }
}
