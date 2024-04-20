<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(5, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => implode(' ', $this->faker->sentences(15)),
            'image' => $this->faker->imageUrl(600, 600),
            'price' => $this->faker->randomFloat(1, 1, 499),
            'compare_price' => $this->faker->randomFloat(1, 500, 999),
            'category_id' => Categorie::inRandomOrder()->first()->id,
            'featured' => $this->faker->boolean,
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
