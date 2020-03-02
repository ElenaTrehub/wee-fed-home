@extends('layouts.app')

@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <p class="main-title">Категории</p>
        <a href="{{route('add-category')}}" class="btn btn-primary" style="color:#ffffff; margin-bottom: 20px;">Добавить категорию</a>

        <table class="own-table">
            <tr>
                <th>Название категории</th>
                <th>Корректировать</th>
                <th>Удалить</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->categoryTitle}}</td>
                    <td ><a href="{{route('category-edit', ['idCategory' => $category->idCategory])}}" class="btn btn-primary" style="color:#ffffff">Edit</a></td>
                    <td><a href="{{route('category-delete', ['idCategory' => $category->idCategory])}}" class="btn btn-danger" style="color:#ffffff">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
