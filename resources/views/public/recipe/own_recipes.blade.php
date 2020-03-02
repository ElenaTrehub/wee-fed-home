@extends('layouts.app')

@section('content')

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <p class="main-title">Ваши рецепты</p>
        <table class="own-table">
            <tr>
                <th>Название рецепта</th>
                <th>Фото</th>
                <th>Категория</th>
                <th>Ингридиенты</th>
                <th>Описание</th>
                <th>Корректировать</th>
                <th>Удалить</th>
            </tr>
            @foreach($recipes as $recipe)
                <tr>
                    <td>{{$recipe->recipe->recipeTitle}}</td>
                    <td class="table-photo">
                        @if (isset($recipe->recipe->recipePhoto))
                            <img src={{asset('storage/'.$recipe->recipe->recipePhoto)}} >
                        @else
                            <img src={{asset('storage/uploads/user-default.png')}}>
                        @endif
                    </td>
                    <td>{{$recipe->category->categoryTitle}}</td>
                    <td>
                        @foreach ($recipe->ingredients as $ingredient)
                            {{$ingredient->ingredient->titleIngredient}} - {{$ingredient->ingredient->count}} {{$ingredient->unit}};
                        @endforeach
                    </td>
                    <td>{{Str::limit($recipe->recipe->recipeDescription, 90)}}</td>
                    <td ><a href="{{route('recipe.edit', ['idRecipe' => $recipe->recipe->idRecipe])}}" class="btn btn-primary" style="color:#ffffff">Edit</a></td>
                    <td><a href="{{route('own-recipe-delete', ['idRecipe' => $recipe->recipe->idRecipe])}}" class="btn btn-danger" style="color:#ffffff">Delete</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
