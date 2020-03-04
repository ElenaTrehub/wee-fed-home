@extends('layouts.app')
<meta name="_token" content="{!! csrf_token() !!}">
@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <p class="main-title">Единицы измерения</p>
        <a href="{{route('add-unit')}}" class="btn btn-primary" style="color:#ffffff; margin-bottom: 20px;">Добавить единицу измерения</a>

        <table class="own-table">
            <tr>
                <th>Название единицы измерения</th>
                <th>Корректировать</th>
                <th>Удалить</th>
            </tr>
            @foreach($units as $unit)
                <tr>
                    <td>{{$unit->titleUnit}}</td>
                    <td ><a href="{{route('unit-edit', ['idUnit' => $unit->idUnit])}}" class="btn btn-primary" style="color:#ffffff">Edit</a></td>
                    <td><a href="{{route('unit-delete', ['idUnit' => $unit->idUnit])}}" class="btn btn-danger" style="color:#ffffff">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
