<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Post;
use App\Models\Style;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'main_comment' => $this->faker->sentence(),
            'style_id' => 1
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            for ($i=0; $i < fake()->numberBetween(0, 3); $i++) {
                $post->addMediaFromUrl(asset('images/image-'. fake()->numberBetween(0, 10) .'.jpg'))->toMediaCollection();
            }
            Style::all()->random()->posts()->save($post);
            Brand::all()->random()->posts()->save($post);
        });
    }
}
