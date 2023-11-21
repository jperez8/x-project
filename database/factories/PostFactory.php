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
        //TODO: SEED MEDIA LIBRARY
        return [
            'main_comment' => $this->faker->sentence(),
            'style_id' => 1
        ];
    }

    public function configure()
    {
        //TODO:: ADD MEDIA IMAGES
        return $this->afterCreating(function (Post $post) {
            Style::all()->random()->posts()->save($post);
            Brand::all()->random()->posts()->save($post);
        });
    }
}
