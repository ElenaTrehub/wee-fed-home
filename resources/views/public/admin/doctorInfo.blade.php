@extends('layouts.app')

<meta name="_token" content="{!! csrf_token() !!}">
@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")

        <div class="nutritionist-info">
            <div class="doctor">
                <div class="doctor-info">

                    <div class="doctor-photo">
                        @if (isset($doctor->user->userPhoto))
                            <img src={{asset('storage/'.$doctor->user->userPhoto)}}>
                        @else
                            <img src={{asset('storage/uploads/user-default.png')}}>
                        @endif
                    </div>

                    <div class="doctor-ratio">
                        <div class="doctor-like">
                            <img src={{asset('storage/uploads/like.png')}}>
                            {{$doctor->likes}}
                        </div>
                        <div class="doctor-dislike">
                            <img src={{asset('storage/uploads/dislike.png')}}>
                            {{$doctor->dislikes}}
                        </div>
                    </div>
                </div>

                <div class="doctor-description">
                    <p class="recipe-title">{{$doctor->doctorInfo->surname}} {{$doctor->doctorInfo->name}} {{$doctor->doctorInfo->second_name}}</p>
                    <p class="recipe-category">Рейтинг: {{$doctor->doctorInfo->rating}}</p>
                    <p class="info">Дата рождения: {{date('d-m-Y', strtotime($doctor->doctorInfo->birth))}}</p>
                    <p class="info">Телефон: {{$doctor->doctorInfo->phone}}</p>
                    <p class="info">Опыт частной практики: {{$doctor->doctorInfo->private_practice}} лет</p>
                    <p class="info">Опыт работы в медицинских учреждениях: {{$doctor->doctorInfo->med_practice}} лет</p>
                    <p class="info">Следующий день оплаты: {{date('d-m-Y', strtotime($doctor->doctorInfo->dayPay))}}</p>
                    <p class="recipe-title">Сумма оплаты: {{$doctor->doctorInfo->sumPay}} грн.</p>
                </div>

            </div>
            <div class="nutritionist-description">
                <div class="main-title">Услуги:</div>
                @foreach($doctor->services as $service)
                    <p class="info">{{$service->titleService}} - {{$service->pivot->sum}} грн.</p>
                @endforeach
            </div>
            <div class="nutritionist-description">
                <div class="main-title">Образование:</div>
                @foreach($doctor->specialties as $specialty)
                    <p class="info">{{$specialty->titleSpecialty}}</p>
                    @if (isset($specialty->urlDiplom))
                        <img style="width: 96%; height: auto" src={{asset('storage/'.$specialty->urlDiplom)}}>
                    @endif
                @endforeach
            </div>
            <div class="nutritionist-description">
                <div class="main-title">О себе:</div>
                <p class="info">{{$doctor->doctorInfo->description}}</p>
            </div>
            <div class="nutritionist-description">
                <div class="main-title">Паспорт:</div>
                @if (isset($doctor->doctorInfo->passport))
                    <img style="width: 96%; height: auto" src={{asset('storage/'.$doctor->doctorInfo->passport)}}>
                @endif
            </div>
            @if ($doctor->doctorInfo->isConfirmed === 1))
                <div class="add-recipe-button">
                    <a class="btn btn-danger" href="{{route('admin-nutritionist-block', ['idDoctorInfo' => $doctor->doctorInfo->idDoctorInfo])}}">Заблокировать</a>
                </div>
            @else
                <div class="add-recipe-button">
                    <a class="btn btn-success" href="{{route('admin-nutritionist-unlock', ['idDoctorInfo' => $doctor->doctorInfo->idDoctorInfo])}}">Разблокировать</a>
                </div>
            @endif

        </div>


    </div>

@endsection
