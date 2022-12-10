<?php

namespace Database\Factories;

use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Style>
 */
class StyleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(),
            'slug' => $this->faker->slug()
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Style $style) {
            $style->slug = Str::slug($style->name, '-');
            $style->save();
        });
    }
}