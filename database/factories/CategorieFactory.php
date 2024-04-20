<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->productName;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => implode(' ', $this->faker->sentences(15)),
            'image' => $this->faker->imageUrl(600, 600),
           
        ];
    }
}
