@extends('layouts.app')

@section('content')
    @push('scripts')
        <script src="{{asset('js/recipe.js')}}"></script>

    @endpush

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <h3 class="main-title">Личный кабинет</h3>
        <p class="second-title" style="text-align: left">Ваш рейтинг в приложении: {{$user->rating}}</p>
        <div class="row">
            <div class="col-md-8">
                <form method="post" action="{{route('user-change-name')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Имя пользователя:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$user->name}}" required name="name">
                            </div>
                            <div class="col-md-6">
                                <input class="btn btn-primary" type="submit" value="Изменить имя">
                            </div>
                        </div>


                    </div>
                </form>
                <form method="post" action="{{route('user-change-email')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Email пользователя:</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" value="{{$user->email}}" required name="email">
                            </div>
                            <div class="col-md-6">
                                <input class="btn btn-primary" type="submit" value="Изменить email">
                            </div>
                        </div>


                    </div>
                </form>
                <form method="post" action="{{route('user-change-photo')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Фото пользователя:</label>
                        <div class="table-photo">
                            @if (isset($user->userPhoto))
                                <img src={{asset('storage/'.$user->userPhoto)}} >
                                <input type="hidden" value="{{$user->userPhoto}}" name="oldPhotoUser">
                            @else
                                <img src={{asset('storage/uploads/user-default.png')}}>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="photoUser">Загрузите фото пользователя</label>
                                <input type="file"  name="photo">
                            </div>
                            <div class="col-md-6">
                                <input class="btn btn-primary" type="submit" value="Изменить фото">
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <nav class="personal-menu">
                    <ul>
                        <li><a href="{{route('cooker-book-show')}}">Кулинарная книга</a></li>
                        <li><a href="">Подписки</a></li>
                        <li><a href="">Подписчики</a></li>
                        <li><a href="{{route('own-recipe-show')}}">Мои рецепты</a></li>

                    </ul>
                </nav>
            </div>

        </div>

        <div class="comments">
            <p class="second-title" style="text-align: left">Отправить письмо администратору:</p>
            <div class="comment-add">
                <form action="{{route('send-message-admin')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="message">Напишите Ваш комментарий</label>
                        <textarea id="message" required  class="form-control" name="message"></textarea>
                        <input type="hidden" name="recipeId" value="{{$user->id}}">
                    </div>
                    <div class="add-comment-button">
                        <input type="submit" value="Отправить" class="btn btn-danger">
                    </div>
                </form>
            </div>
            <hr>
            <div class="comment-list">

                @foreach($messages as $message)
                    @if ($message->idSender === \Illuminate\Support\Facades\Auth::user()->id)
                        <div class="message-sender">

                            <div class="comment-date">
                                {{$message->createdAt}}
                            </div>
                            <div class="comment-text">
                                {{$message->textMessage}}
                            </div>
                            @if ($message->isRead === 0)
                                <a href="{{route('message-delete', ['idMessage' => $message->idMessage])}}" class="btn btn-danger">Удалить</a>
                            @endif
                        </div>
                    @else
                        <div class="message-taker">

                            <div class="comment-date">
                                {{$message->createdAt}}
                            </div>
                            <div class="comment-text">
                                {{$message->textMessage}}
                            </div>

                        </div>
                    @endif

                @endforeach

            </div>


        </div>
    </div>

@endsection
