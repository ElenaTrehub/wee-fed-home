@extends('layouts.app')

@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <h3 class="main-title">Единица измерения:</h3>
        <form  action="{{route('unit-update', ['idUnit'=> $unit->idUnit])}}" method="POST" style="width: 60%; margin-left: 20%;">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="title">Название единицы измерения</label>
                <input id="title" type="text" class="form-control" value="{{$unit->titleUnit}}" name="title">
            </div>
            <div class="add-recipe-button">
                <input type="submit" value="Изменить единицу измерения" class="btn btn-danger">
            </div>
        </form>
    </div>
@endsection
