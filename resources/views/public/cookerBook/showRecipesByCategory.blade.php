@extends('layouts.app')
@push('scripts')
    <script src="{{asset('js/cooker.js')}}"></script>
@endpush
<meta name="_token" content="{!! csrf_token() !!}">
@section('content')

    @include("partial.error")
    @include("partial.success")
    <div class="container">
        <div class="recipe-list" >
            <p class="main-title">Кулинарная книга ( {{$category->categoryTitle}} )</p>
            @foreach($recipes as $recipe)

                <div class="recipe" style="margin-top: 50px">
                    <div class="delete-from-cooker">
                        <a href="{{route('delete-from-cookerbook',['idRecipe'=>$recipe->recipe->idRecipe])}}">
                            Удалить из кулинарной книги</a>
                    </div>
                    <div class="user-info">
                        <div class="user-content">
                            <div class="user-photo">
                                @if (isset($recipe->user->userPhoto))
                                    <img src={{asset($recipe->user->userPhoto)}}>
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
                        <p class="recipe-category">{{$category->categoryTitle}}</p>
                        <p class="recipe-description">{{Str::limit($recipe->recipe->recipeDescription, 90)}}</p>
                        <a href="{{route('recipe.show', ['idRecipe' => $recipe->recipe->idRecipe])}}">Подробнее...</a>
                    </div>
                    <div class="recipe-ratio">
                        <div class="recipe-like">
                            <img src={{asset('storage/uploads/like.png')}}>
                            {{$recipe->recipe->like}}
                        </div>
                        <div class="recipe-dislike">
                            <img src={{asset('storage/uploads/dislike.png')}}>
                            {{$recipe->recipe->dislike}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="add-recipe-button">
            <input id="showMore" onclick="showMoreRecipe({{$category->idCategory}})" value="Больше рецептов" class="btn btn-success">
        </div>
    </div>
@endsection
