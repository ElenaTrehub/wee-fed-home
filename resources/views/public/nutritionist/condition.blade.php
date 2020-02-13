@extends('layouts.app')
@push('scripts')
    <script src="{{asset('js/condition.js')}}"></script>
@endpush
@section('content')
    <div class="container">
        <p class="main-title">Регистрация диетолога в базе данных</p>
        <p class="second-title" style="text-align: left">Что мы предлагаем</p>
        <p style="font-size: 16px; color:#666666">1. Бесплатное размещение Вашей анкеты</p>
        <p style="font-size: 16px; color:#666666">2. Фиксированная ежемесячная плата, не зависимо от колличества клиентов, с которыми Вы работаете</p>
        <p class="second-title" style="text-align: left">Как зарегистрироваться</p>
        <p style="font-size: 16px; color:#666666">Оформите заявку, пройдя последовательно 4 этапа:</p>
        <p style="font-size: 16px; color:#666666">а) заполните анкету,</p>
        <p style="font-size: 16px; color:#666666">б) изучите и примите договор оферты,</p>
        <p style="font-size: 16px; color:#666666">в) ознакомтесь с правилами работы приложения,</p>
        <p style="font-size: 16px; color:#666666">г) подтвердите Вашу личность и квалификацию копиями документов</p>
        <p style="font-size: 16px; color:#666666">Отправив данные, дождитесь рассмотрения заявки. Если мы примем положительное решение по вашему запросу, нужно будет пройти собеседование по телефону.</p>
        <p style="font-size: 16px; color:#666666">Первичная регистрация (до собеседования) занимает в среднем 10–15 минут.</p>
        <br>
        <input id="isYes" type="checkbox">
        <label>Я согласен (а)</label>
        <br>
        <button id="registerButton" onclick="canRegister()" href="" class="btn btn-primary">Начать регистрацию</button>
    </div>
@endsection
