<?php

namespace Database\Factories;

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
            'images' => json_encode([
                $this->faker->imageUrl(400, 600, 'fashion'),
                $this->faker->imageUrl(400, 600, 'fashion'),
                $this->faker->imageUrl(400, 600, 'fashion'),
                $this->faker->imageUrl(400, 600, 'fashion')
            ]),
            'style_id' => 1
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            Style::all()->random()->posts()->save($post);            
        });
    }
}
