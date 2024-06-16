<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/recipes/{page?}', [RecipeController::class, 'getAllRecipesAsJson'])->name('api.recipes.all');

Route::get('/recipe/{id}', [RecipeController::class, 'getRecipeByIdAsJson'])->name('api.recipes.id');

Route::get('/category/{id}/{page?}', [RecipeController::class, 'getRecipesByCategoryAsJson'])->name('api.recipes.category');
