<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recipe::factory(100)->create();

        $categories = Category::all();
        $recipes = Recipe::all();

        foreach ($recipes as $recipe) {
            $recipe->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
