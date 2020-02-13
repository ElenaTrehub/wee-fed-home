<?php

namespace App\Http\Controllers;
use App\Events\NewMessageNotification;
use App\Filters\RecipeFilter;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
class HomeController extends Controller
{

    public $limit;
    public $offset;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->limit = 3;
        $this->offset = 0;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();


        $recipes = Recipe::skip($this->offset)->take($this->limit)->get();

        $recipeInfo=[];
        foreach($recipes as $recipe){
            $recipeUser = User::findOrFail($recipe->idUser)->toJson();
            $user = json_decode($recipeUser);
            $recipeCategory = Category::findOrFail($recipe->idCategory);
            $app = app();
            $obj = $app->make('stdClass');
            $obj->recipe = $recipe;
            $obj->user = $user ;
            $obj->category = $recipeCategory;
            $recipeInfo[]=$obj;
        }


        $context = [
            'recipes'=>$recipeInfo,
            'categories' => $categories
        ];
        //dd($context);
        return view('home', $context);
    }

    public function showMoreRecipe(Request $request){

        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $recipes = Recipe::skip($offset)->take($limit)->get();

        if(count($recipes) > 0 ) {
            $recipeInfo = [];
            foreach ($recipes as $recipe) {
                $recipeUser = User::findOrFail($recipe->idUser)->toJson();
                $user = json_decode($recipeUser);
                $recipeCategory = Category::findOrFail($recipe->idCategory);
                $app = app();
                $obj = $app->make('stdClass');
                $obj->recipe = $recipe;
                $obj->user = $user;
                $obj->category = $recipeCategory;
                $recipeInfo[] = $obj;
            }


            $context = [
                'recipes' => $recipeInfo
            ];

            return $context;
        }
        else{
            return 0;
        }

    }//showMoreRecipe

    public function recipeSearch(Request $request){

        $recipes = Recipe::all();
        $count = Recipe::count();
        //dd($recipes);
        $recipesList = (new RecipeFilter($recipes, $request, $count))->apply();
        //dd($recipesList);
        if($recipesList !== 0 ){
            $recipeInfo=[];
            foreach($recipesList as $recipe){
                $recipeUser = User::findOrFail($recipe->idUser)->toJson();
                $user = json_decode($recipeUser);
                $recipeCategory = Category::findOrFail($recipe->idCategory);
                $app = app();
                $obj = $app->make('stdClass');
                $obj->recipe = $recipe;
                $obj->user = $user;
                $obj->category = $recipeCategory;
                $recipeInfo[]=$obj;
            }


            $context = [
                'recipes'=>$recipeInfo
            ];
            //dd($context);
            return $context;
        }
        else{
            return 0;
        }


    }
}
