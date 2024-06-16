<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::all();

        return [
            'name' => fake()->text(50),
            'difficulty' => fake()->randomElement(['easy', 'medium', 'hard']),
            'author' => fake()->name(),
            'prep_time_minutes' => floor(fake()->numberBetween(15, 60 * 3) / 5) * 5, // To keep prep times neat, let's floor them as multiples of five within the range
            'ingredients' => fake()->text(200),
            'image_url' => 'images/recipes/placeholder.jpeg',
            'instructions' => fake()->text(750),
        ];
    }
}
