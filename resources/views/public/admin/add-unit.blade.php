@extends('layouts.app')

@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <h3 class="main-title">Новая единица измерения:</h3>
        <form method="post" action="{{route('unit-store')}}" style="width: 60%; margin-left: 20%;">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">Введите название единицы измерения</label>
                <input id="title" type="text" class="form-control"  required name="title">
            </div>
            <div class="add-recipe-button">
                <input type="submit" value="Добавить новую единицу измерения" class="btn btn-danger">
            </div>
        </form>
    </div>
@endsection
