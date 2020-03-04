<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorRequest;
use App\Models\DoctorInfo;
use App\Models\Role;
use App\Models\Service;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Config;
class NutritionistController extends Controller
{
    public function __construct()
    {
        $this->limit = config('constants.limit');
        $this->offset = config('constants.offset');
    }

    public function showCondition()
    {
        return view('public.nutritionist.condition');
    }//showConditions
    public function showResume()
    {
        $services = Service::all();
        $content = [
            'services'=>$services
        ];
        return view('public.nutritionist.resume', $content);
    }//showResume

    public function resumeSend(CreateDoctorRequest $request){

        $user = Auth::user();

        if($user->hasRole(2)){
            $request->session()->flash('flash_message', 'Вы уже зарегестрированы как доктор!');
            return redirect()->back();
        }
        if($user && $user->can("createDoctor", User::class)){

            if(array_key_exists('passport', $request->all())){
                $path = $request->file('passport')->store('uploads/doctors/', 'public');
            }
            else{
                $path = null;
            }
            $date = new \DateTime();
            $date->add(date_interval_create_from_date_string('1 month'));

            $sum = config('constants.sumDoctorPayMonth');
            $doctorInfo = DoctorInfo::create([
                'idUser' => Auth::user()->id,
                'surname' => $request->get('surname'),
                'name' => $request->get('name'),
                'second_name' => $request->get('second_name'),
                'birth' => $request->get('birth'),
                'phone' => $request->get('phone'),
                'private_practice' => $request->get('private_practice'),
                'med_practice' => $request->get('med_practice'),
                'description' => $request->get('description'),
                'passport' => $path,
                'dayPay' => $date,
                'sumPay' => $sum,
            ]);
//dd($request->all());
            if($doctorInfo){
                if(array_key_exists('diplom', $request->all())){
                    $diploms = ($request->all())['diplom'];

                    if($diploms){

                        $i=1;

                        foreach ($diploms as $diplom){
                            //dd($step);
                            $photo = null;
                            if(isset($diplom['DiplomPhoto'])){

                                $photoPath = $diplom['DiplomPhoto']->store('uploads/specialty/', 'public');
                            }
                            else{
                                $photoPath = null;
                            }
                            $specialty= Specialty::create([
                                'idUser' => Auth::user()->id,
                                'titleSpecialty' => $diplom['diplomSpecialty'],
                                'urlDiplom' => $photoPath

                            ]);

                            $role = Role::where('idRole', 2)->first();
                            $user->roles()->attach($role);

                            if(!$specialty){
                                return redirect()->back();
                            }
                        }
                    }

                }
                else {
                    $request->session()->flash('flash_message', 'Укажите свою специализацию!');
                    return redirect()->back();
                }
                if(array_key_exists('services', $request->all())) {
                    $services = $request->get('services');
                    //dd($services);
                    $serviceArray =  explode(";", $services);

                    foreach ($serviceArray as $service){

                        $serviceInfo =  explode("-", $service);
//dd($serviceInfo);
                        $serv = Service::where('titleService', trim($serviceInfo[0]))->get();

                        if ( ! isset($serviceInfo[1])) {
                            $serviceInfo[1] = null;
                        }
                        $sum =(double)trim($serviceInfo[1]);
                        $user->services()->attach($serv, ['sum' => $sum ]);

                    }


                }
                else {
                    $request->session()->flash('flash_message', 'Укажите услуги, которые В предотавляете!');
                    return redirect()->back();
                }

            }
            else {
                $request->session()->flash('flash_message', 'Проблемы с сервером!');
                return redirect()->back();
            }

            $request->session()->flash('flash_message', 'Ваши данные отправлены администратору. В течении 24 часов их рассмотрят и пришлют Вам ответ!');
            return redirect()->route('home');
        }
        else{
            if($user && $user->hasStatus(2)){
                $request->session()->flash('flash_message', 'Ваша учетная запись заблокирована! Обратитесь к администратору! ');
                return redirect()->back();
            }
            return view('auth.login');
        }




    }//resumeSend


    public function doctorListShow(Request $request){
        $user = Auth::user();

        if($user && $user->can("doctorList", User::class)){
            $doctors = DoctorInfo::where('isConfirmed', '=', '1')->skip($this->offset)->take($this->limit)->get();
            $doctorInfo=[];
            foreach($doctors as $doctor){
                $currentUser = User::findOrFail($doctor->idUser);
                $user = $currentUser->toJson();
                $user = json_decode($user);
                $services = $currentUser->services()->get();
                $specialties = Specialty::where('idUser', $doctor->idUser)->get();
                $likes = $doctor->usersWhoLike()->count();
                $dislike = $doctor->usersWhoDislike()->count();
                $app = app();
                $obj = $app->make('stdClass');
                $obj->likes = $likes;
                $obj->dislikes = $dislike;
                $obj->doctorInfo = $doctor;
                $obj->user = $user ;
                $obj->services = $services;
                $obj->specialties = $specialties;
                $doctorInfo[]=$obj;
            }


            $context = [
                'doctors'=>$doctorInfo
            ];
            return view('public.nutritionist.doctor_list', $context);
        }
        else{
            if($user && $user->hasStatus(2)){
                $request->session()->flash('flash_message', 'Ваша учетная запись заблокирована! Обратитесь к администратору! ');
                return redirect()->back();
            }
            return view('auth.login');
        }

    }//doctorShows

    public function doctorInfo($idDoctor){

        $user = Auth::user();

        if ($user && $user->can("doctorList", User::class)) {

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
            return view('public.nutritionist.doctorInfo', $context);

        } else {
            return view('auth.login');
        }
    }//doctorInfo

    public function moreNutritionists(Request $request){
        $user = Auth::user();

        if ($user && $user->can("doctorList", User::class)) {

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
                    $services = $currentUser->services()->get();
                    $likes = $doctor->usersWhoLike()->count();
                    $dislike = $doctor->usersWhoDislike()->count();
                    $app = app();
                    $obj = $app->make('stdClass');
                    $obj->doctorInfo = $doctor;
                    $obj->user = $user ;
                    $obj->likes = $likes;
                    $obj->dislikes = $dislike;
                    $obj->specialties = $specialties;
                    $obj->services = $services;
                    $doctorInfo[]=$obj;
                }


                $context = [
                    'doctors' => $doctorInfo,
                ];

                return $context;
            } else {
                return 0;
            }

        } else {
            return view('auth.login');
        }
    }//moreNutritionists
}
