<?php

namespace Database\Factories;

use App\Enums\TypeLeague;
use App\Enums\TypeProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\League>
 */
class LeagueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name();
        return [
            'name' => $name,
            'slug' => Str::of($name)->slug('-'),
            'type_profile' => TypeProfile::Influencer
        ];
    }
}
