@extends('layouts.app')
@push('scripts')
    <script src="{{asset('js/admin.js')}}"></script>

@endpush
<meta name="_token" content="{!! csrf_token() !!}">
@section('content')

    <div class="container">
    @include("partial.error")
    @include("partial.success")
        <div class="main-title">Пользователи</div>
        <div class="user-list">
            @foreach($users as $user)
                @if($user->isBlock === 0)
                    <div class="user-not-block">
                        <div class="user-admin-photo">
                            @if (isset($user->userPhoto))
                                <img src={{asset('storage/'.$user->userPhoto)}}>
                            @else
                                <img src={{asset('storage/uploads/user-default.png')}}>
                            @endif
                        </div>

                        <div class="user-admin-name">
                            {{$user->name}}
                        </div>
                        <div class="user-admin-email">
                            {{$user->email}}
                        </div>
                        <div class="user-admin-button">
                            <a href="{{route('user-block', ['id' => $user->id])}}" class="btn btn-danger">Block</a>
                        </div>
                    </div>
                @else
                    <div class="user-block">
                        <div class="user-admin-photo">
                            @if (isset($user->userPhoto))
                                <img src={{asset('storage/'.$user->userPhoto)}}>
                            @else
                                <img src={{asset('storage/uploads/user-default.png')}}>
                            @endif
                        </div>
                        <div class="user-admin-name">
                            {{$user->name}}
                        </div>
                        <div class="user-admin-email">
                            {{$user->email}}
                        </div>
                        <div class="user-admin-button">
                            <a href="{{route('user-unlock', ['id' => $user->id])}}" class="btn btn-danger">Unlock</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="add-recipe-button">
            <input id="showMoreUsers" onclick="showMoreUsers()" value="Больше пользователей" class="btn btn-success">
        </div>

    </div>
@endsection
