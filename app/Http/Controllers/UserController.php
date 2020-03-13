<?php

namespace App\Http\Controllers;

use App\Events\NewMessageNotification;
use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;
use Stripe\Charge;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function personalShow(Request $request){

        $user = Auth::user();

        if($user && $user->can("personal", User::class)){

            $roleAdmin = Role::where('idRole', 3)->first();

            $admin = $roleAdmin->users()->first();

            $readMessages = Message::where([['idSender',$admin->id ], ['idTaker',$user->id]])->get();

            foreach($readMessages as $mess){
                $mess->update(['isRead'=> true]);
                $mess->save();
            }

            $messages = Message::where([['idSender',$user->id ],['idTaker',$admin->id]])->orWhere([['idSender',$admin->id ], ['idTaker',$user->id]])->orderBy('createdAt', 'desc')->get();
            //dd($messages);

            $context = [
                'user' => $user,
                'messages'=>$messages

            ];
            return view('public.user.personal', $context);
        }
        else{
            if($user && $user->hasStatus(2)){
                $request->session()->flash('flash_message', 'Ваша учетная запись заблокирована! Обратитесь к администратору! ');
                return redirect()->back();
            }
            return view('auth.login');
        }

    }//personalShow

    public function userChangeName(Request $request){
        $user = Auth::user();

        if($user && $user->can("personal", User::class)){

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->update([
                'name'=>$request->get('name')
            ]);


            if($user->save()){
                $request->session()->flash('flash_message', 'Имя успешно обновлено!');
                return redirect()->back();
            }
            else{
                $request->session()->flash('flash_message', 'Не удалось изменить имя!');
                return redirect()->back();
            }
        }
        else{
            if($user && $user->hasStatus(2)){
                $request->session()->flash('flash_message', 'Ваша учетная запись заблокирована! Обратитесь к администратору! ');
                return redirect()->back();
            }
            return view('auth.login');
        }
    }//userChangeName
    public function userChangeEmail(Request $request){
        $user = Auth::user();

        if($user && $user->can("personal", User::class)){

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->update([
                'email'=>$request->get('email')
            ]);


            if($user->save()){
                $request->session()->flash('flash_message', 'Email успешно обновлен!');
                return redirect()->back();
            }
            else{
                $request->session()->flash('flash_message', 'Не удалось изменить email!');
                return redirect()->back();
            }
        }
        else{
            if($user && $user->hasStatus(2)){
                $request->session()->flash('flash_message', 'Ваша учетная запись заблокирована! Обратитесь к администратору! ');
                return redirect()->back();
            }
            return view('auth.login');
        }
    }//userChangeEmail

    public function userChangePhoto(Request $request){
        $user = Auth::user();

        if($user && $user->can("personal", User::class)){

            $validator = Validator::make($request->all(), [
                'photo' => 'nullable|image|mimes:jpeg,bmp,png,tmp',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if(array_key_exists('photo', $request->all())){

                if(array_key_exists('oldPhotoUser', $request->all())){
                    app(Filesystem::class)->delete(public_path('storage/'.$request->get('oldPhotoUser')));
                }
                $path = $request->file('photo')->store('uploads/user', 'public');
                //}


            }
            else if(array_key_exists('oldPhotoUser', $request->all())){
                $path = $request->get('oldPhotoUser');
            }
            else{
                $path = 0;
            }

            $user->update([
                'userPhoto'=>$path
            ]);


            if($user->save()){
                $request->session()->flash('flash_message', 'Фото успешно обновлен!');
                return redirect()->back();
            }
            else{
                $request->session()->flash('flash_message', 'Не удалось изменить фото!');
                return redirect()->back();
            }
        }
        else{
            if($user && $user->hasStatus(2)){
                $request->session()->flash('flash_message', 'Ваша учетная запись заблокирована! Обратитесь к администратору! ');
                return redirect()->back();
            }
            return view('auth.login');
        }
    }//userChangeEmail

    public function sendMessageAdmin(Request $request){

        $user = Auth::user();

        if($user && $user->can("sendMessageAdmin", User::class)){

            $validator = Validator::make($request->all(), [
                'message' => 'required|string|max:2500',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $roleAdmin = Role::where('idRole', 3)->first();

            $admin = $roleAdmin->users()->first();


            $message = Message::create([
                'idSender' => $user->id,
                'idTaker' => $admin->id,
                'textMessage' => $request->get('message'),
            ]);


            if($message){
                // want to broadcast NewMessageNotification event

                //dd(event(new NewMessageNotification($message, $user)));
                \App\Events\NewMessageNotification::dispatch($message);
                $request->session()->flash('flash_message', 'Ваше сообщение отправлено!');
                return redirect()->back();
            }
            else{
                $request->session()->flash('flash_message', 'Не удалось отправить сообщение!');
                return redirect()->back();
            }
        }
        else{
            return view('auth.login');
        }

    }//sendMessageAdmin

    public function messageDelete(Request $request, $idMessage){
        $message = Message::findOrFail($idMessage);
        $user = Auth::user();
        if(!$user){
            return view('auth.login');
        }
        if($user->can("delete", $message)) {
            $message->delete();

            return redirect()->back();
        }
        else{
            $request->session()->flash('flash_message', 'Вы не можете удалить данное сообщение!');
            return redirect()->back();

        }
    }//messageDelete


}
