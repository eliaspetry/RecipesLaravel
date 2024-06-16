<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Recipe;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_names = [
            'Italiana',
            'Barata',
            'Sencilla',
            'Tradicional',
            'Oriental',
            'Vegana',
            'Saludable',
            'Postres',
            'Tapas',
            'Carne',
            'Pescado'
        ];

        foreach ($category_names as $category_name) {
            // Check if the category already exists
            if (Category::all()->pluck('name')->contains($category_name)) {
                continue;
            }

            // If it doesn't exist, create it
            Category::factory()->create(['name' => $category_name]);
        }
    }
}
