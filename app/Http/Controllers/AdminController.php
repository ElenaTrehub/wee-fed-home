<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UnitRequest;
use App\Models\Category;
use App\Models\DoctorInfo;
use App\Models\Message;
use App\Models\recipeStep;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->limit = config('constants.limit');
        $this->offset = config('constants.offset');
    }

    public function showAdminPanel()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('roles.idRole', 1);
        })->skip($this->offset)->take($this->limit)->get();

        $context = [
            'users' => $users
        ];

        return view('public.admin.admin-panel', $context);

    }//showAdminPanel

    public function userBlock($id)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $currentUser = User::where('id', $id);
            //dd($currentUser);
            $currentUser->update([
                'idStatus' => 2
            ]);


            if ($currentUser->first()->save()) {
                return redirect()->back();
            } else {

                return redirect()->back();
            }
        } else {
            return view('auth.login');
        }
    }//userBlock

    public function userUnlock($id)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $currentUser = User::where('id', $id);


            $currentUser->update([
                'idStatus' => 3
            ]);


            if ($currentUser->first()->save()) {

                return redirect()->back();
            } else {

                return redirect()->back();
            }
        } else {
            return view('auth.login');
        }
    }//userBlock

    public function moreUsers(Request $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $users = User::whereHas('roles', function ($q) {
            $q->where('roles.idRole', 1);
        })->skip($offset)->take($limit)->get();

        if (count($users) > 0) {

            $userInfo=[];
            foreach($users as $user){
                $app = app();
                $obj = $app->make('stdClass');
                $obj->user = $user ;
                if(count($user->takeNoReadMessagesToAdmin())>0){
                    $obj->hasMessage = true;
                }
                else{
                    $obj->hasMessage = false;
                }
                $userInfo[] = $obj;
            }
            $context = [
                'users' => $userInfo
            ];

            return $context;
        } else {
            return 0;
        }
    }//moreUsers

    public function showCategories()
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $categories = Category::all();
            $context = [
                'categories' => $categories
            ];

            return view('public.admin.categories', $context);

        } else {
            return view('auth.login');
        }
    }//showCategories

    public function addCategory()
    {

        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            return view('public.admin.add-category');
        } else {
            return view('auth.login');
        }
    }//addCategory

    public function editCategory($idCategory)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $category = Category::findOrFail($idCategory);
            $context = [
                'category' => $category
            ];

            return view('public.admin.edit-category', $context);

        } else {
            return view('auth.login');
        }
    }//editCategory

    public function deleteCategory(Request $request, $idCategory)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $category = Category::findOrfail($idCategory);
            $category->delete();
            $request->session()->flash('flash_message', 'Категория удалена!');
            return redirect()->back();

        } else {
            return view('auth.login');
        }
    }//deleteCategory

    public function storeCategory(CategoryRequest $request)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $category = Category::create([
                'categoryTitle' => $request->get('title')

            ]);

            if (!$category) {
                $request->session()->flash('flash_message', 'Не удалось сохранить категорию!');
                return redirect()->back();
            }
            $request->session()->flash('flash_message', 'Категория успешна сохранена!!');
            return redirect()->back();
        } else {
            return view('auth.login');
        }

    }//storeCategory

    public function updateCategory(CategoryRequest $request, $idCategory)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $category = Category::findOrFail($idCategory);
            if ($category) {
                $category->update([
                    'categoryTitle' => $request->get('title')

                ]);
                if ($category->save()) {
                    $request->session()->flash('flash_message', 'Обновление категории прошло успешно!');
                    return redirect()->route('categories');
                } else {
                    $request->session()->flash('flash_message', 'Не удалось обновить категорию!');
                    return redirect()->route('categories');
                }
            }


        } else {
            return view('auth.login');
        }
    }//updateCategory


    public function showUnits()
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $units = Unit::all();
            $context = [
                'units' => $units
            ];

            return view('public.admin.units', $context);

        } else {
            return view('auth.login');
        }
    }//showUnits

    public function addUnit()
    {

        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            return view('public.admin.add-unit');
        } else {
            return view('auth.login');
        }
    }//addUnit

    public function editUnit($idUnit)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $unit = Unit::findOrFail($idUnit);
            $context = [
                'unit' => $unit
            ];

            return view('public.admin.edit-unit', $context);

        } else {
            return view('auth.login');
        }
    }//editUnit

    public function deleteUnit(Request $request, $idUnit)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $unit = Unit::findOrfail($idUnit);
            $unit->delete();
            $request->session()->flash('flash_message', 'Единица измерения  удалена!');
            return redirect()->back();

        } else {
            return view('auth.login');
        }
    }//deleteUnit

    public function storeUnit(UnitRequest $request)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $unit = Unit::create([
                'titleUnit' => $request->get('title')

            ]);

            if (!$unit) {
                $request->session()->flash('flash_message', 'Не удалось сохранить единицу измерения!');
                return redirect()->route('units');
            }
            $request->session()->flash('flash_message', 'Единица измерения успешно сохранена!');
            return redirect()->route('units');
        } else {
            return view('auth.login');
        }

    }//storeUnit

    public function updateUnit(UnitRequest $request, $idUnit)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $unit = Unit::findOrFail($idUnit);
            if ($unit) {
                $unit->update([
                    'titleUnit' => $request->get('title')

                ]);
                if ($unit->save()) {
                    $request->session()->flash('flash_message', 'Обновление единицы измерения прошло успешно!');
                    return redirect()->route('units');
                } else {
                    $request->session()->flash('flash_message', 'Не удалось обновить единицу измерения!');
                    return redirect()->route('units');
                }
            }


        } else {
            return view('auth.login');
        }
    }//updateUnit

    public function showUserAdminMessage($id)
    {

        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $messageUser = User::findOrFail($id);

            $readMessages = Message::where([['idSender', $id], ['idTaker', $user->id]])->get();

            foreach ($readMessages as $mess) {
                $mess->update(['isRead' => true]);
                $mess->save();
            }
            $context = [];
            $messages = Message::where([['idSender', $id], ['idTaker', $user->id]])->orWhere([['idSender', $user->id], ['idTaker', $id]])->orderBy('createdAt', 'desc')->skip($this->offset)->take($this->limit)->get();
            //dd($messages);
            if($messageUser->hasRole(2)){
                $doctor = DoctorInfo::where('idUser', $messageUser->id)->first();
                //dd($doctor);
                $context = [
                    'user' => $messageUser,
                    'messages' => $messages,
                    'doctor' => $doctor

                ];
            }
            else{
                $context = [
                    'user' => $messageUser,
                    'messages' => $messages

                ];
            }

            return view('public.admin.messaging', $context);
        } else {
            return view('auth.login');
        }


    }//showUserAdminMessage

    public function sendMessageFromAdmin(Request $request)
    {

        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:2500',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $message = Message::create([
                'idSender' => $user->id,
                'idTaker' => $request->get('userId'),
                'textMessage' => $request->get('message'),
            ]);
            if ($message) {
                // want to broadcast NewMessageNotification event

                //dd(event(new NewMessageNotification($message, $user)));
                //\App\Events\NewMessageNotification::dispatch($message);
                $request->session()->flash('flash_message', 'Ваше сообщение отправлено!');
                return redirect()->back();
            } else {
                $request->session()->flash('flash_message', 'Не удалось отправить сообщение!');
                return redirect()->back();
            }

        } else {
            return view('auth.login');
        }
    }//sendMessageFromAdmin

    public function showMoreMessages(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $offset = $request->input('offset');
            $limit = $request->input('limit');
            //dd($offset);
            $comments = Message::where([['idSender', $request->input('id')], ['idTaker', $user->id]])->orWhere([['idSender', $user->id], ['idTaker', $request->input('id')]])->orderBy('createdAt', 'desc')->skip($offset)->take($limit)->get();
            if(count($comments)>0){
                $messageInfo=[];
                foreach($comments as $comment){
                    $user = User::findOrFail($comment->idSender);
                    $app = app();
                    $obj = $app->make('stdClass');
                    $obj->user = $user ;
                    $obj->message = $comment;
                    $messageInfo[]=$obj;
                }
                $context = [
                    'comments'=>$messageInfo
                ];
                //dd($context);
                return $context;
            }
            else{
                return 0;
            }

        } else {
            return view('auth.login');
        }
    }//showMoreMessages

    public function adminNutritionist(){
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $doctors = DoctorInfo::where('isConfirmed', '=', 1)->skip($this->offset)->take($this->limit)->get();
            $doctorInfo=[];
            foreach($doctors as $doctor){
                $currentUser = User::findOrFail($doctor->idUser);
                $user = $currentUser->toJson();
                $user = json_decode($user);
                $specialties = Specialty::where('idUser', $doctor->idUser)->get();
                $app = app();
                $obj = $app->make('stdClass');
                $obj->doctorInfo = $doctor;
                $obj->user = $user ;
                $obj->specialties = $specialties;
                $doctorInfo[]=$obj;
            }


            $context = [
                'doctors'=>$doctorInfo
            ];
            return view('public.admin.nutritionist_list', $context);

        } else {
            return view('auth.login');
        }
    }//adminNutritionist
    public function applicationNutritionist(){
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $doctors = DoctorInfo::where('isConfirmed', '=', 0)->skip($this->offset)->take($this->limit)->get();
            $doctorInfo=[];
            foreach($doctors as $doctor){
                $currentUser = User::findOrFail($doctor->idUser);
                $user = $currentUser->toJson();
                $user = json_decode($user);
                $specialties = Specialty::where('idUser', $doctor->idUser)->get();
                $app = app();
                $obj = $app->make('stdClass');
                $obj->doctorInfo = $doctor;
                $obj->user = $user ;
                $obj->specialties = $specialties;
                $doctorInfo[]=$obj;
            }


            $context = [
                'doctors'=>$doctorInfo
            ];
            return view('public.admin.application_list', $context);

        } else {
            return view('auth.login');
        }
    }//applicationNutritionist

    public function adminDoctorInfo($idDoctor){
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {

            $doctor = DoctorInfo::findOrFail($idDoctor);

            $currentUser = User::findOrFail($doctor->idUser);
            $user = $currentUser->toJson();
            $user = json_decode($user);
            $specialties = Specialty::where('idUser', $doctor->idUser)->get();
            $services = $currentUser->services()->get();
            $likes = $doctor->usersWhoLike()->count();
            $dislike = $doctor->usersWhoDislike()->count();
            $app = app();
            $obj = $app->make('stdClass');
            $obj->doctorInfo = $doctor;
            $obj->user = $user ;
            $obj->specialties = $specialties;
            $obj->likes = $likes;
            $obj->dislikes = $dislike;
            $obj->services = $services;

            $context = [
                'doctor'=>$obj
            ];
            return view('public.admin.doctorInfo', $context);

        } else {
            return view('auth.login');
        }
    }//adminDoctorInfo

    public function adminDoctorBlock(Request $request, $idDoctor){
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $currentDoctor = DoctorInfo::findOrFail($idDoctor);
            //dd($currentUser);
            $currentDoctor->update([
                'isConfirmed' => false
            ]);


            if ($currentDoctor->save()) {
                $request->session()->flash('flash_message', 'Специалист успешно заблокирован! ');
                return redirect('nutritionist-application');
            } else {
                $request->session()->flash('flash_message', 'Не удалось заблокировать специалиста! ');
                return redirect()->back();
            }
        } else {
            return view('auth.login');
        }
    }//adminDoctorBlock
    public function adminDoctorUnlock(Request $request, $idDoctor){
        $user = Auth::user();

        if ($user && $user->can("admin", User::class)) {
            $currentDoctor = DoctorInfo::findOrFail($idDoctor);
            //dd($currentUser);
            $currentDoctor->update([
                'isConfirmed' => true
            ]);


            if ($currentDoctor->save()) {
                $request->session()->flash('flash_message', 'Специалист успешно разблокирован! ');
                return redirect('admin-nutritionist');
            } else {
                $request->session()->flash('flash_message', 'Не удалось разблокировать специалиста! ');
                return redirect()->back();
            }
        } else {
            return view('auth.login');
        }
    }//adminDoctorUnlock

    public function moreNutritionists(Request $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $doctors = DoctorInfo::where('isConfirmed', '=', 1)->skip($offset)->take($limit)->get();

        if (count($doctors) > 0) {

            $doctorInfo=[];
            foreach($doctors as $doctor){
                $currentUser = User::findOrFail($doctor->idUser);
                $user = $currentUser->toJson();
                $user = json_decode($user);
                $specialties = Specialty::where('idUser', $doctor->idUser)->get();
                $app = app();
                $obj = $app->make('stdClass');
                $obj->doctorInfo = $doctor;
                $obj->user = $user ;
                $obj->specialties = $specialties;
                $doctorInfo[]=$obj;
            }
            $context = [
                'doctors' => $doctorInfo
            ];

            return $context;
        } else {
            return 0;
        }
    }//moreUsers
    public function moreApplication(Request $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $doctors = DoctorInfo::where('isConfirmed', '=', 0)->skip($offset)->take($limit)->get();

        if (count($doctors) > 0) {

            $doctorInfo=[];
            foreach($doctors as $doctor){
                $currentUser = User::findOrFail($doctor->idUser);
                $user = $currentUser->toJson();
                $user = json_decode($user);
                $specialties = Specialty::where('idUser', $doctor->idUser)->get();
                $app = app();
                $obj = $app->make('stdClass');
                $obj->doctorInfo = $doctor;
                $obj->user = $user ;
                $obj->specialties = $specialties;
                $doctorInfo[]=$obj;
            }
            $context = [
                'doctors' => $doctorInfo
            ];

            return $context;
        } else {
            return 0;
        }
    }//moreUsers
}
