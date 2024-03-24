<?php

namespace Database\Factories;

use App\Enums\TypeProfile;
use App\Models\League;
use App\Models\Profile;
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
            "username" => $this->faker->name(),
            "description" => $this->faker->paragraph(),
            "profile_mini_image" => $this->faker->imageUrl(200,200),
            "profile_header_image" => $this->faker->imageUrl(200,200),
            "phone" => $this->faker->e164PhoneNumber(),
            "type_profile" => TypeProfile::cases()[rand(0, count(TypeProfile::cases()) - 1)],
            "fav_styles" => json_encode([1,2,3,4,5]),
            "fav_brands" => json_encode([1,2,3,4,5]),
        ];
    }
}
