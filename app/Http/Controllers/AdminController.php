<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\recipeStep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->limit = config('constants.limit');
        $this->offset = config('constants.offset');
    }

    public function showAdminPanel(){
        $users = User::whereHas('roles', function($q){
            $q->where('roles.idRole', 1);
        })->skip($this->offset)->take($this->limit)->get();

        $context = [
            'users' => $users
        ];

        return view('public.admin.admin-panel', $context);

    }//showAdminPanel

    public function userBlock($id){
        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {
            $currentUser = User::where('id', $id);
            //dd($currentUser);
            $currentUser->update([
                'isBlock' => true
            ]);


            if($currentUser->first()->save()){
                return redirect()->back();
            }
            else{

                return redirect()->back();
            }
        }
        else{
            return view('auth.login');
        }
    }//userBlock
    public function userUnlock($id){
        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {
            $currentUser = User::where('id', $id);


            $currentUser->update([
                'isBlock'=> false
            ]);


            if($currentUser->first()->save()){

                return redirect()->back();
            }
            else{

                return redirect()->back();
            }
        }
        else{
            return view('auth.login');
        }
    }//userBlock

    public function moreUsers(Request $request){
        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $users = User::whereHas('roles', function($q){
            $q->where('roles.idRole', 1);
        })->skip($offset)->take($limit)->get();

        if(count($users) > 0 ) {

            $context = [
                'users' => $users
            ];

            return $context;
        }
        else{
            return 0;
        }
    }//moreUsers

    public function showCategories(){
        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {
            $categories = Category::all();
            $context = [
                'categories' => $categories
            ];

            return view('public.admin.categories', $context);

        }
        else{
            return view('auth.login');
        }
    }//showCategories

    public function addCategory(){

        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {

            return view('public.admin.categories');
        }
        else{
            return view('auth.login');
        }
    }//addCategory

    public function editCategory($idCategory){
        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {

            $category= Category::findOrFail($idCategory);
            $context = [
                'category' => $category
            ];

            return view('public.admin.edit-category', $context);

        }
        else{
            return view('auth.login');
        }
    }//editCategory

    public function deleteCategory(Request $request, $idCategory){
        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {
            $category = Category::findOrfail($idCategory);
            $category->delete();
            $request->session()->flash('flash_message', 'Категория удалена!');
            return redirect()->back();

        }
        else{
            return view('auth.login');
        }
    }//deleteCategory

    public function storeCategory(CategoryRequest $request){
        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {

            $category= Category::create([
                'categoryTitle' => $request->get('title')

            ]);

            if(!$category){
                $request->session()->flash('flash_message', 'Не удалось сохранить категорию!');
                return redirect()->back();
            }
            $request->session()->flash('flash_message', 'Категория успешна сохранена!!');
            return redirect()->back();
        }
        else{
            return view('auth.login');
        }

    }//storeCategory

    public function updateCategory(CategoryRequest $request, $idCategory){
        $user = Auth::user();

        if($user && $user->can("admin", User::class)) {

            $category = Category::findOrFail($idCategory);
            if($category){
                $category->update([
                    'categoryTitle' => $request->get('title')

                ]);
                if($category->save()) {
                    $request->session()->flash('flash_message', 'Обновление категории прошло успешно!');
                    return redirect()->route('categories');
                }
                else{
                    $request->session()->flash('flash_message', 'Не удалось обновить категорию!');
                    return redirect()->route('categories');
                }
            }



        }
        else{
            return view('auth.login');
        }
    }//updateCategory
}
