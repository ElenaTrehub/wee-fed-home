<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecipeRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Unit;
use App\Models\User;
use App\Models\recipeStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Filesystem\Filesystem;

class RecipeController extends Controller
{
    public $limit;
    public $offset;
    public function __construct()
    {
        $this->limit = config('constants.limit');
        $this->offset = config('constants.offset');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.recipe.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if($user && $user->can("create", Recipe::class)){
            $categories = Category::all();
            $units = Unit::all();
            $steps = [];
            $context = [
                'categories' => $categories,
                'steps' => $steps,
                'units' => $units
            ];
            return view('public.recipe.create', $context);
        }
        else{
            return view('auth.login');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRecipeRequest $request)
    {

//dd($request->all());
        if(array_key_exists('photoRecipe', $request->all())){
            $path = $request->file('photoRecipe')->store('uploads/recipe', 'public');
        }
        else{
            $path = null;
        }

//dd($path);
        $id = Recipe::insertGetId([
            'idUser' => Auth::user()->id,
            'recipeTitle' => $request->get('title'),
            'recipePhoto' => $path,
            'recipeDescription' => $request->get('description'),
            'idCategory' => $request->get('category'),
            'timePrepare' => $request->get('timePrepare'),
            'calory' => $request->get('calory')
        ]);


        if($id){
            if(array_key_exists('step', $request->all())){
                $steps = ($request->all())['step'];
                //dd($stepInfo);
                if($steps){
                    //$steps = array_chunk($request->get('step'), 3);
                    $i=1;
                    //dd($steps);
                    foreach ($steps as $step){
                        //dd($step);
                        $photo = null;
                        if(isset($step['StepPhoto'])){

                            $photoPath = $step['StepPhoto']->store('uploads/recipeStep/'.$id, 'public');;
                        }
                        else{
                            $photoPath = null;
                        }
                        $step= recipeStep::create([
                            'idRecipe' => $id,
                            'stepPhoto' => $photoPath,
                            'stepDescription' => $step['StepDescription'],
                            'stepNumber' => $i++
                        ]);

                        if(!$step){
                            return redirect()->back();
                        }
                    }
                }

            }
            if(array_key_exists('ingredients', $request->all())) {
                $ingred = $request->get('ingredients');
                $ingredients = mb_substr($ingred, 0, -1);
                $ingredientArray =  explode(";", $ingredients);

                foreach ($ingredientArray as $ingredient){

                    $ingredientInfo =  explode("-", $ingredient);
                    //dd($ingredientInfo);
                    $title = trim($ingredientInfo[0]);

                    if ( !isset($ingredientInfo[1])) {
                        $ingredientInfo[1] = null;
                    }
                    //dd($ingredientInfo[1]);
                    $countArray = explode(" ", trim($ingredientInfo[1]));
                    //dd($countArray);
                    $count =(double)trim($countArray[0]);

                    if ( ! isset($countArray[1])) {
                        $countArray[1] = null;
                    }
                    //dd(trim($countArray[1]));
                    $unit = Unit::where('titleUnit', trim($countArray[1]))->first();
//dd($unit);
                    if($unit) {
                        $idUnit = $unit->idUnit;
                    }


                    $ingredient = Ingredient::create([
                        'titleIngredient' => $title,
                        'count' => $count,
                        'idRecipe' => $id,
                        'idUnit' => $idUnit
                    ]);

                    if(!$ingredient){
                        $request->session()->flash('flash_message', 'Не удалось сохранить рецепт!');
                        return redirect()->back();
                    }
                }


            }
            else {

            }

        }
        else {
            return redirect()->back();
        }
        $request->session()->flash('flash_message', 'Сохранение рецепта прошло успешно!');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipeUser = User::findOrFail($recipe->idUser)->toJson();
        $user = json_decode($recipeUser);
        $recipeCategory = Category::findOrFail($recipe->idCategory);
        $recipeSteps = recipeStep::where('idRecipe', $id)->get();
        $ingredients = $recipe->ingredients()->get();

        $currentIngredients = [];
        foreach($ingredients as $ingredient){
            $unit = Unit::findOrFail($ingredient->idUnit);
            $app = app();
            $obj = $app->make('stdClass');
            $obj->unit = $unit->titleUnit;
            $obj->ingredient = $ingredient;
            $currentIngredients[] = $obj;
        }

        $likes = $recipe->usersWhoLike()->count();
        $dislike = $recipe->usersWhoDislike()->count();

        $comments = Comment::with('user')->where('idRecipe', $id)->orderBy('createdAt', 'desc')->skip($this->offset)->take($this->limit)->get();
        //dd($comments);
        $context = [
            'recipe'=>$recipe,
            'category'=>$recipeCategory,
            'user'=>$user,
            'recipeSteps'=>$recipeSteps,
            'comments'=>$comments,
            'likes' =>$likes,
            'dislikes' =>$dislike,
            'ingredients' => $currentIngredients
        ];
//dd($context);
        return view('public.recipe.show', $context);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $recipe = Recipe::findOrFail($id);
        if($user && $user->can("edit", $recipe)){
            $categories = Category::all();
            $recipeSteps = recipeStep::where('idRecipe', $id)->get();
            $recipeCategory = Category::findOrFail($recipe->idCategory);

            $ingredients = $recipe->ingredients()->get();
            $currentIngredients = [];
            $ingrString = '';
            foreach($ingredients as $ingredient){
                $unit = Unit::findOrFail($ingredient->idUnit);
                $app = app();
                $obj = $app->make('stdClass');
                $obj->unit = $unit->titleUnit;
                $obj->ingredient = $ingredient;
                $currentIngredients[] = $obj;
                $ingrString = $ingrString.$ingredient->titleIngredient.' - '.$ingredient->count.' '.$unit->titleUnit.';';
            }
            //dd($comments);
            $context = [
                'recipe'=>$recipe,
                'category'=>$recipeCategory,
                'steps'=>$recipeSteps,
                'categories'=>$categories,
                'ingredients' => $currentIngredients,
                'ingredStr' => $ingrString
            ];
            return view('public.recipe.edit', $context);
        }
        else{
            return view('auth.login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateRecipeRequest $request, $id)
    {
        if(array_key_exists('photoRecipe', $request->all())){
            //if(file_exists( 'storage/uploads/recipe/'.$request->get('photoRecipe'))){
               // $path = 'storage/uploads/recipe/'.$request->get('photoRecipe');
            //}
            //else{
            if(array_key_exists('oldPhotoRecipe', $request->all())){
                app(Filesystem::class)->delete(public_path('storage/'.$request->get('oldPhotoRecipe')));
            }
            $path = $request->file('photoRecipe')->store('uploads/recipe', 'public');
            //}


        }
        else if(array_key_exists('oldPhotoRecipe', $request->all())){
            $path = $request->get('oldPhotoRecipe');
        }
        else{
            $path = 0;
        }
        $recipe = Recipe::findOrFail($id);


        if($recipe){
            $recipe->update([
                'recipeTitle' => $request->get('title'),
                'recipePhoto' => $path,
                'recipeDescription' => $request->get('description'),
                'idCategory' => $request->get('category'),
                'timePrepare' => $request->get('timePrepare'),
                'calory' => $request->get('calory')
            ]);
            if($recipe->save()){
                if(array_key_exists('step', $request->all())){
                    $oldSteps = $recipe->steps()->get();
                    foreach($oldSteps as $step){
                        $step->delete();
                    }
                    $steps = ($request->all())['step'];
                    //dd($stepInfo);
                    if($steps){
                        //$steps = array_chunk($request->get('step'), 3);
                        $i=1;
                        //dd($steps);
                        foreach ($steps as $step){
                            //dd($step);
                            $photo = null;
                            if(isset($step['StepPhoto'])){

                                $photoPath = $step['StepPhoto']->store('uploads/recipeStep/'.$id, 'public');;
                            }
                            else{
                                $photoPath = null;
                            }
                            $step= recipeStep::create([
                                'idRecipe' => $id,
                                'stepPhoto' => $photoPath,
                                'stepDescription' => $step['StepDescription'],
                                'stepNumber' => $i++
                            ]);

                            if(!$step){
                                return redirect()->back();
                            }
                        }
                    }

                }
                if(array_key_exists('ingredients', $request->all())) {

                    $oldIngredients = $recipe->ingredients()->get();
                    foreach($oldIngredients as $ingredient){
                        $ingredient->delete();
                    }
                    $ingred = $request->get('ingredients');
                    $ingredients = mb_substr($ingred, 0, -1);
                    $ingredientArray =  explode(";", $ingredients);

                    foreach ($ingredientArray as $ingredient){

                        $ingredientInfo =  explode("-", $ingredient);
                        //dd($ingredientInfo);
                        $title = trim($ingredientInfo[0]);

                        if ( !isset($ingredientInfo[1])) {
                            $ingredientInfo[1] = null;
                        }
                        //dd($ingredientInfo[1]);
                        $countArray = explode(" ", trim($ingredientInfo[1]));
                        //dd($countArray);
                        $count =(double)trim($countArray[0]);

                        if ( ! isset($countArray[1])) {
                            $countArray[1] = null;
                        }
                        //dd(trim($countArray[1]));
                        $unit = Unit::where('titleUnit', trim($countArray[1]))->first();
//dd($unit);
                        if($unit) {
                            $idUnit = $unit->idUnit;
                        }


                        $ingredient = Ingredient::create([
                            'titleIngredient' => $title,
                            'count' => $count,
                            'idRecipe' => $id,
                            'idUnit' => $idUnit
                        ]);

                        if(!$ingredient){
                            $request->session()->flash('flash_message', 'Не удалось сохранить рецепт!');
                            return redirect()->back();
                        }
                    }


                }
                else {

                }
            }
            else{
                return redirect()->back();
            }

        }
        else {
            return redirect()->back();
        }
        $request->session()->flash('flash_message', 'Обновление рецепта прошло успешно!');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function recipeLike(Request $request, $idRecipe)
    {
        $user = Auth::user();
//dd($user);
        if(!$user){
            return view('auth.login');
        }
        $recipe = Recipe::findOrFail($idRecipe);
        if($user->can("like", $recipe)){

            //$recipe->like = $recipe->like +1;
            //$recipe->save();
            $user->likeRecipes()->attach($recipe);
            $user->rating = $user->rating + 1;
            $user->save();

            if($user->isDislikeRecipe($idRecipe)){
                $user->dislikeRecipes()->detach($recipe);
                //$recipe->dislike = $recipe->dislike -1;
                //$recipe->save();
            }
            return redirect()->back();
        }
        else{
            $request->session()->flash('flash_message', 'Вы уже отзывались хорошо об этом рецепте!');
            return redirect()->back();
        }
    }
    public function recipeDislike(Request $request, $idRecipe)
    {
        $user = Auth::user();
//dd($user);
        if(!$user){
            return view('auth.login');
        }
        $recipe = Recipe::findOrFail($idRecipe);
        if($user->can("dislike", $recipe)){

            //$recipe->dislike = $recipe->dislike +1;
            //$recipe->save();
            $user->dislikeRecipes()->attach($recipe);
            $user->rating = $user->rating - 1;
            $user->save();
            if($user->isLikeRecipe($idRecipe)){
                $user->likeRecipes()->detach($recipe);
                //$recipe->like = $recipe->like -1;
                //$recipe->save();
            }
            return redirect()->back();
        }
        else{
            $request->session()->flash('flash_message', 'Вы уже отзывались негативно об этом рецепте!');
            return redirect()->back();
        }
    }

    public function showOwnRecipe(){
        $user = Auth::user();

        if($user && $user->can("create", Recipe::class)){
            $recipes = Recipe::where('idUser', $user->id)->get();
            $recipeInfo=[];
            foreach($recipes as $recipe){

                $ingredients = $recipe->ingredients()->get();

                $currentIngredients = [];
                foreach($ingredients as $ingredient){
                    $unit = Unit::findOrFail($ingredient->idUnit);
                    $app = app();
                    $obj = $app->make('stdClass');
                    $obj->unit = $unit->titleUnit;
                    $obj->ingredient = $ingredient;
                    $currentIngredients[] = $obj;
                }


                $recipeCategory = Category::findOrFail($recipe->idCategory);
                $app = app();
                $obj = $app->make('stdClass');
                $obj->recipe = $recipe;
                $obj->category = $recipeCategory;
                $obj->ingredients = $currentIngredients;
                $recipeInfo[]=$obj;
            }

            $context = [
                'recipes' => $recipeInfo
            ];
            return view('public.recipe.own_recipes', $context);
        }
        else{
            return view('auth.login');
        }

    }

    public function deleteOwnRecipe(Request $request, $idRecipe){
        //dd($idRecipe);
        $recipe = Recipe::findOrFail($idRecipe);
        $user = Auth::user();

        if(!$user){
            return view('auth.login');
        }
        if($user->can("delete", $recipe)) {
            //dd($recipe->cookerBooks()->count());
            if($recipe->cookerBooks()->count() === 0){
                $comments = Comment::where('idRecipe', $idRecipe)->get();
                $ingredients = Ingredient::where('idRecipe', $idRecipe)->get();
                $steps = recipeStep::where('idRecipe', $idRecipe)->get();
                if($comments){
                    foreach ($comments as $comment){
                        $comment->delete();
                    }
                }
                if($ingredients){
                    foreach ($ingredients as $ingredient){
                        $ingredient->delete();
                    }
                }
                if($steps){
                    foreach ($steps as $step){
                        $step->delete();
                    }
                }
                $recipe->delete();
                $request->session()->flash('flash_message', 'Рецепт удален!');
                return redirect()->back();
            }
            else{
                $request->session()->flash('flash_message', 'Вы не можете удалить данный рецепт! Он добавлен в кулинарные книги других пользователей!');
                return redirect()->back();
            }


        }
        else{
            $request->session()->flash('flash_message', 'Вы не можете удалить данный рецепт!');
            return redirect()->back();

        }
    }//deleteOwnRecipe
}
