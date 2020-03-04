@extends('layouts.app')
@push('scripts')
    <script src="{{asset('js/admin-message.js')}}"></script>
@endpush
@section('content')

    <div class="container">
    @include("partial.error")
    @include("partial.success")
        <div class="comments">
            @if($user->hasRole(2))
                <a class="btn btn-success"  href="{{route('admin-nutritionist-info', ['idDoctorInfo' => $doctor->idDoctorInfo])}}">Информация о докторе</a>
            @endif
            <p class="second-title" style="text-align: left">Отправить письмо пользователю:</p>
            <div class="comment-add">
                <form action="{{route('send-message-from-admin')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="message">Напишите Ваш комментарий</label>
                        <textarea id="message" required  class="form-control" name="message"></textarea>
                        <input type="hidden" name="userId" value="{{$user->id}}">
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
            <div class="add-message-button">
                <input id="showMoreMessage" onclick="showMoreMessage({{$user->id}})" value="Больше сообщений" class="btn btn-success">
            </div>
    </div>
@endsection
