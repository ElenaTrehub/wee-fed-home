@extends('layouts.app')
@push('scripts')
    <script src="{{asset('js/admin-application.js')}}"></script>
@endpush
<meta name="_token" content="{!! csrf_token() !!}">
@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")

        <div class="main-title">
            Заявки на подтверждение
        </div>

        <div class="doctor-list">
            @foreach($doctors as $doctor)
                <div class="doctor">

                    <div class="doctor-info">

                        <div class="doctor-photo">
                            @if (isset($doctor->user->userPhoto))
                                <img src={{asset('storage/'.$doctor->user->userPhoto)}}>
                            @else
                                <img src={{asset('storage/uploads/user-default.png')}}>
                            @endif
                        </div>

                    </div>

                    <div class="doctor-description">
                        <div class="second-title" style="text-align: left">
                            Заявка
                        </div>
                        <p class="recipe-title">{{$doctor->doctorInfo->surname}} {{$doctor->doctorInfo->name}} {{$doctor->doctorInfo->second_name}}</p>
                        <p class="recipe-category">{{$doctor->user->email}}</p>
                        <label>Образование:</label>
                        @foreach($doctor->specialties as $specialty)
                            <p class="info">{{$specialty->titleSpecialty}}</p>
                        @endforeach

                        <a href="{{route('admin-nutritionist-info', ['idDoctorInfo' => $doctor->doctorInfo->idDoctorInfo])}}">Информация...</a>
                    </div>

                </div>



            @endforeach
        </div>
        <div class="add-recipe-button">
            <input id="showMoreApplication" onclick="showMoreApplication()"  value="Больше заявок" class="btn btn-success">
        </div>
    </div>

@endsection
