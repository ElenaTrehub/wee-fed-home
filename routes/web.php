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
Route::get('/nutritionist-resume', 'NutritionistController@showResume')->name('nutritionist-resume');
Route::post('/resume-send', 'NutritionistController@resumeSend')->name('resume-send');
Route::get('/doctor-list', 'NutritionistController@doctorListShow')->name('doctor-list');
Route::get('/nutritionist-info/{doctor}', 'NutritionistController@doctorInfo')->name('nutritionist-info');
Route::get('/more-nutritionist', 'NutritionistController@moreNutritionists')->name('more-nutritionist');


Route::get('/admin-panel', 'AdminController@showAdminPanel')->name('admin-panel');
Route::get('/user-block/{user}', 'AdminController@userBlock')->name('user-block');
Route::get('/user-unlock/{user}', 'AdminController@userUnlock')->name('user-unlock');
Route::get('/admin-show-more-users', 'AdminController@moreUsers')->name('admin-show-more-users');

Route::get('/categories', 'AdminController@showCategories')->name('categories');
Route::get('/add-category', 'AdminController@addCategory')->name('add-category');
Route::get('/category-edit/{category}', 'AdminController@editCategory')->name('category-edit');
Route::get('/category-delete/{category}', 'AdminController@deleteCategory')->name('category-delete');
Route::post('/category-store', 'AdminController@storeCategory')->name('category-store');
Route::put('/category-update/{category}', 'AdminController@updateCategory')->name('category-update');


Route::get('/units', 'AdminController@showUnits')->name('units');
Route::get('/add-unit', 'AdminController@addUnit')->name('add-unit');
Route::get('/unit-edit/{unit}', 'AdminController@editUnit')->name('unit-edit');
Route::get('/unit-delete/{unit}', 'AdminController@deleteUnit')->name('unit-delete');
Route::post('/unit-store', 'AdminController@storeUnit')->name('unit-store');
Route::put('/unit-update/{unit}', 'AdminController@updateUnit')->name('unit-update');


Route::get('/user-admin-message/{user}', 'AdminController@showUserAdminMessage')->name('user-admin-message');
Route::post('/send-message-from-admin', 'AdminController@sendMessageFromAdmin')->name('send-message-from-admin');
Route::get('/admin-message', 'AdminController@showMoreMessages')->name('admin-message');


Route::get('/admin-nutritionist', 'AdminController@adminNutritionist')->name('admin-nutritionist');
Route::get('/nutritionist-application', 'AdminController@applicationNutritionist')->name('nutritionist-application');
Route::get('/admin-nutritionist-info/{doctor}', 'AdminController@adminDoctorInfo')->name('admin-nutritionist-info');
Route::get('/admin-nutritionist-block/{doctor}', 'AdminController@adminDoctorBlock')->name('admin-nutritionist-block');
Route::get('/admin-nutritionist-unlock/{doctor}', 'AdminController@adminDoctorUnlock')->name('admin-nutritionist-unlock');
Route::get('/admin-show-more-nutritionist', 'AdminController@moreNutritionists')->name('admin-show-more-nutritionist');
Route::get('/admin-show-more-application', 'AdminController@moreApplication')->name('admin-show-more-application');
