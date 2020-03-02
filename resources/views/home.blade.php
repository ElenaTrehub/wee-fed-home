@extends('layouts.app')
@push('scripts')
    <script src="{{asset('js/home.js')}}"></script>

@endpush
<meta name="_token" content="{!! csrf_token() !!}">
@section('content')

<div class="container" xmlns="http://www.w3.org/1999/html">
    @include("partial.error")
    @include("partial.success")
    <div class="button-section">

        <a class="btn btn-danger" style="margin-right: 20px" href="{{route('recipe.create')}}">Добавить рецепт</a>
        <input id="showFilters"  class="btn btn-success" value="Отобразить фильтры" onclick="ShowFilters()">
    </div>
    <div class="filters">
        <p class="second-title">Поиск нужных рецептов:</p>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="description">Выбop по категории</label>
                <select id="category" class="form-control" name="category" >
                    <option selected disabled>Выберите из списка</option>
                    @foreach($categories as $category)
                        <option value="{{$category->idCategory}}">{{$category->categoryTitle}}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group col-md-4">
                <label for="max_calory">Выбор по максимальному колличеству калорий</label>
                <input id="max_calory" type="text" class="form-control" name="max_calory">
            </div>
            <div class="form-group col-md-4">
                <label for="ingr">Выбор по ингридиенту</label>
                <input id="ingr" type="text" class="form-control" name="ingr">
            </div>
        </div>
        <input id="moveFilter" onclick="SearchRecipe(0, 3)" class="btn btn-danger" value="Применить фиьтры"/>
    </div>

    <div class="main-title">
        Рецепты
    </div>

    <div class="recipe-list">
        @foreach($recipes as $recipe)
            <div class="recipe">
                <div class="user-info">
                    <div class="user-content">
                        <div class="user-photo">
                            @if (isset($recipe->user->userPhoto))
                                <img src={{asset('storage/'.$recipe->user->userPhoto)}}>
                            @else
                                <img src={{asset('storage/uploads/user-default.png')}}>
                            @endif
                        </div>
                        <div class="user-state">
                            <div class="user-name">
                                {{$recipe->user->name}}
                            </div>
                            <div class="user-date">
                                {{$recipe->user->createdAt}}
                            </div>
                        </div>
                    </div>
                    <div class="user-rating">
                        <div><p>Rating</p></div>
                        <div>{{$recipe->user->rating}}</div>

                    </div>
                </div>
                <div class="recipe-photo">
                    @if (isset($recipe->recipe->recipePhoto))
                        <img src={{asset('storage/'.$recipe->recipe->recipePhoto)}} >
                    @else
                        <img src={{asset('storage/uploads/user-default.png')}}>
                    @endif
                    <div class="calory">
                        @if ($recipe->recipe->calory == null)
                            Калории неизвестны
                        @else
                            {{$recipe->recipe->calory}} kal
                        @endif

                    </div>
                </div>
                <div class="recipe-info">
                    <p class="recipe-title">{{$recipe->recipe->recipeTitle}}</p>
                    <p class="recipe-category">{{$recipe->category->categoryTitle}}</p>
                    <p class="recipe-description">{{Str::limit($recipe->recipe->recipeDescription, 90)}}</p>
                    <a href="{{route('recipe.show', ['idRecipe' => $recipe->recipe->idRecipe])}}">Подробнее...</a>
                </div>
                <div class="recipe-ratio">
                    <div class="recipe-like">
                        <img src={{asset('storage/uploads/like.png')}}>
                        {{$recipe->likes}}
                    </div>
                    <div class="recipe-dislike">
                        <img src={{asset('storage/uploads/dislike.png')}}>
                        {{$recipe->dislikes}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="add-recipe-button">
        <input id="showMore" onclick="showMoreRecipe()" value="Больше рецептов" class="btn btn-success">
    </div>
</div>

@endsection
