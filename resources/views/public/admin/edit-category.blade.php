@extends('layouts.app')

@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <h3 class="main-title">Категория:</h3>
        <form  action="{{route('category-update', ['idCategory'=> $category->idCategory])}}" method="POST" style="width: 60%; margin-left: 20%;">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="title">Название категории</label>
                <input id="title" type="text" class="form-control" value="{{$category->categoryTitle}}" name="title">
            </div>
            <div class="add-recipe-button">
                <input type="submit" value="Изменить категорию" class="btn btn-danger">
            </div>
        </form>
    </div>
@endsection
