<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('recipe', 'RecipeController');

Route::get('/show-more', 'HomeController@showMoreRecipe')->name('showMoreRecipe');
Route::post('/recipe-search', 'HomeController@recipeSearch')->name('recipe-search');
Route::get('/recipe-like/{recipe}', 'RecipeController@recipeLike')->name('recipe-like');
Route::get('/recipe-dislike/{recipe}', 'RecipeController@recipeDislike')->name('recipe-dislike');
Route::get('/own-recipe-show', 'RecipeController@showOwnRecipe')->name('own-recipe-show');
Route::get('/own-recipe-delete/{recipe}', 'RecipeController@deleteOwnRecipe')->name('own-recipe-delete');

Route::resource('comment', 'CommentController');
Route::get('/comment-delete/{comment}', 'CommentController@deleteComment')->name('comment-delete');
Route::get('/recipe-comments', 'CommentController@showComments')->name('recipe-comments');

Route::get('/cooker-book-add-recipe/{recipe}', 'CookerBookController@addRecipe')->name('cooker-book-add-recipe');
Route::get('/cooker-book-show', 'CookerBookController@show')->name('cooker-book-show');
Route::get('/cooker-book-category-recipes/{category}', 'CookerBookController@getRecipesByCategory')->name('cooker-book-category-recipes');
Route::get('/show', 'CookerBookController@showMoreRecipes');
Route::get('/delete-from-cookerbook/{recipe}', 'CookerBookController@deleteRecipeFromCookerBook')->name('delete-from-cookerbook');


Route::get('/personal-show', 'UserController@personalShow')->name('personal-show');
Route::post('/user-change-name', 'UserController@userChangeName')->name('user-change-name');
Route::post('/user-change-email', 'UserController@userChangeEmail')->name('user-change-email');
Route::post('/user-change-photo', 'UserController@userChangePhoto')->name('user-change-photo');
Route::post('/send-message-admin', 'UserController@sendMessageAdmin')->name('send-message-admin');
Route::get('/message-delete/{message}', 'UserController@messageDelete')->name('message-delete');

Route::get('/nutritionist-conditions', 'NutritionistController@showCondition')->name('nutritionist-conditions');


Route::get('/broadcast', function() {
   \App\Events\NewMessageNotification::dispatch('Test message!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');
    //event(new \App\Events\NewMessageNotification('Test message'));
//dd(new \App\Events\NewMessageNotification('Test message'));
    return view('welcome');
});
