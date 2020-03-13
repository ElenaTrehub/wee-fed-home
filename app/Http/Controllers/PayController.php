<?php

namespace App\Http\Controllers;

use App\Models\DoctorInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{
    public function showPayForm($id){
        $user = Auth::user();

        if($user && $user->can("pay", User::class)){
            $context = [
                'id'=>$id
            ];
            return view('public.user.pay-form', $context);
        }
        else{

            return view('auth.login');
        }
    }//showPayForm

    public function pay(Request $request){
        $user = Auth::user();
        $id = 0;
        if (Auth::check()) {

            $id = Auth::id();
        }

        if($user && $user->can("pay", User::class)){

             //Устанавливаем секретный ключ
            //Stripe::setApiKey("sk_test_2PTE7DgY08Yokj2blSrb4J5n00Dj7k4PHS");

            // Забираем token из формы
            // $token = $request->get('stripeToken');

            // Создаём оплату
            try {

            //$charge = Charge::create(array(
            // "amount" => 1, // сумма в центах
            // "currency" => "usd",
            // "source" => $token,
            // "description" => "Example charge"
            //));

            $doctor = DoctorInfo::where('idUser', $id)->first();

            $currentDayPay  = new \DateTime($doctor->dayPay);
            $nextDayPay = $currentDayPay->add(date_interval_create_from_date_string('1 month'));

                $doctor->update([
                    'dayPay'=>$nextDayPay
                ]);


                if($doctor->save()){
                    $request->session()->flash('flash_message', 'Ваш платеж прошел успешно!');
                    return redirect()->back();
                }
                else{
                    $request->session()->flash('flash_message', 'Платеж не прошел!');
                    return redirect()->back();
                }

            } catch(\Stripe\Error\Card $e) {
                $request->session()->flash('flash_message', 'Платеж не прошел! ');
                return redirect()->back();
            }
        }
        else{

            return view('auth.login');
        }
    }//showPayForm
}
