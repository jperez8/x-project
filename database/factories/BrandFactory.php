<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    private $styles = ['Zara', 'Nike', 'Reebok', 'Polo', 'Burberry', 'Balenciaga', 'Gucci', 'Kenzo'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $name = $this->styles[rand(0,7)],
            'slug' => Str::of($name)->slug('-')
        ];
    }

}
