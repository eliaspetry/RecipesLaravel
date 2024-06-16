<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;

class RecipeController extends Controller
{
    /**
     * Returns a pagination page of id, name and creation date columns for all recipes as JSON pertaining to the specific page number passed through the URL.
     * 
     * @param int $page The page number
     * 
     * @return \Illuminate\Http\JsonResponse The paginated list of recipes
     */
    public function getAllRecipesAsJson($page = 0)
    {
        RecipeController::parsePageNumber($page);

        $recipes = Recipe::select('id', 'name', 'created_at')->paginate(10, ['*'], 'page', $page)->withPath('/api/recipes');

        return response()->json($recipes);
    }

    /**
     * Returns all fields for the recipe with the specified id as JSON
     * 
     * @param int $id The id of the recipe
     * 
     * @return \Illuminate\Http\JsonResponse The recipe object
     */
    public function getRecipeByIdAsJson($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe)
            return response()->json(['message' => 'Recipe not found'], 404);

        RecipeController::parse($recipe);

        return response()->json($recipe);
    }

    /**
     * Returns a pagination of id, name and creation date columns for all recipes as JSON pertaining to the specific category id and page number passed through the URL.
     * 
     * @param int $id The id of the category
     * @param int $page The page number
     * 
     * @return \Illuminate\Http\JsonResponse The paginated list of recipes
     */
    public function getRecipesByCategoryAsJson($id, $page = 0)
    {
        RecipeController::parsePageNumber($page);

        $category = Category::find($id);

        // If no categories under that id, just pass the first id available as default
        if (!$category)
            $id = Category::first()['id'];

        $recipes = Recipe::whereHas('categories', function ($query) use ($id) {
            $query->where('category_id', $id);
        })->select('id', 'name', 'created_at')->paginate(10, ['*'], 'page', $page)->withPath('/api/category/' . $id);

        return response()->json($recipes);
    }

    /**
     * Fetches a combination of 2 fixed recipes added by Tinker and 3 different random seeded ones each time, and returns index view with these recipes
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function getRecipesIndexView()
    {
        // We want a combination of 2 fixed recipes added by Tinker and 3 different random seeded ones each time
        $recipes = Recipe::whereIn('id', [103, 104])->get();
        $random_recipes = Recipe::inRandomOrder()->whereNotIn('id', [103, 104])->limit(3)->get();
        $recipes = $recipes->merge($random_recipes);

        RecipeController::parse($recipes);

        return view('home', [
            'recipes' => $recipes
        ]);
    }

    /**
     * Fetches the view for the recipe with the specified id, or returns a 404 if it doesn't exist
     * 
     * @param int $id The id of the recipe
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function getRecipeView($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe)
            return response()->json(['message' => 'Recipe not found'], 404);

        RecipeController::parse($recipe);

        return view('recipe', [
            'recipe' => $recipe[0]
        ]);
    }

    /**
     * Processes the array of recipes with the parsing methods, mutating the original reference directly
     * 
     * @param array $recipes The reference to the array of recipes
     * 
     * @return void
     */
    protected function parse(&$recipes)
    {
        if (!is_array($recipes) && !$recipes instanceof \Illuminate\Database\Eloquent\Collection)
            $recipes = [$recipes];

        foreach ($recipes as $recipe) {
            RecipeController::parseDifficulty($recipe);
            RecipeController::setCategories($recipe);
        }
    }

    /**
     * Parses the difficulty column of the array of recipes, mutating the original reference directly
     * 
     * @param array $recipes The reference to the array of recipes
     * 
     * @return void
     */
    protected function parseDifficulty(&$recipe)
    {
        switch ($recipe['difficulty']) {
            case 'hard':
                $recipe['difficulty'] = 'Difícil';
                break;
            case 'medium':
                $recipe['difficulty'] = 'Media';
                break;
            default:
                $recipe['difficulty'] = 'Fácil';
                break;
        }
    }

    /**
     * Sets the categories column of the array of recipes retrieved from the pivot table, mutating the original reference directly
     * 
     * @param array $recipes The reference to the array of recipes
     * 
     * @return void
     */
    protected function setCategories(&$recipe)
    {
        $categories = $recipe->categories();

        $ids = $categories->pluck('category_id');
        $names = $categories->pluck('name');
        $mapping = [];

        for ($i = 0; $i < count($ids); $i++) {
            array_push($mapping, [
                'id' => $ids[$i],
                'name' => $names[$i]
            ]);
        }

        $recipe['categories'] = $mapping;
    }

    /**
     * Tries to obtain a valid page number from the GET params if it is not provided directly in the URL, or defaults to 1
     * 
     * @param int $page The page number reference
     * 
     * @return void
     */
    protected function parsePageNumber(&$page)
    {
        if (!$page) {
            if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
        }
    }
}
