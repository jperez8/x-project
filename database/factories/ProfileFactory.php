<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "description" => $this->faker->paragraph(),
            "profile_mini_image" => $this->faker->imageUrl(200,200),
            "profile_header_image" => $this->faker->imageUrl(200,200),
            "phone" => $this->faker->e164PhoneNumber(),
        ];
    }
}
