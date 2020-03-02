@extends('layouts.app')
@push('scripts')
    <script src="{{asset('js/comment.js')}}"></script>
@endpush
@section('content')


    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <div class="single-recipe">
            <div class="single-recipe_header">
                <div class="single-recipe_photo">
                    <div class="photo">
                        @if (isset($recipe->recipePhoto))
                            <img src={{asset('storage/'.$recipe->recipePhoto)}} >
                        @else
                            <img src={{asset('storage/uploads/user-default.png')}}>
                        @endif
                    </div>
                    <div class="ratio">
                        <div class="single-recipe_ratio">
                            <div class="recipe-like">
                                <a href="{{route('recipe-like', ['idRecipe' => $recipe->idRecipe])}}"><img src={{asset('storage/uploads/like.png')}}></a>

                                {{$likes}}
                            </div>
                            <div class="recipe-dislike">
                                <a href="{{route('recipe-dislike', ['idRecipe' => $recipe->idRecipe])}}"><img src={{asset('storage/uploads/dislike.png')}}></a>
                                {{$dislikes}}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="single-recipe_info">

                    <h1 class="single-recipe_title">{{$recipe->recipeTitle}}</h1>
                    <h5 class="single-recipe_category">{{$recipe->category->categoryTitle}}</h5>

                    <h4 class="single-recipe_time">Время приготовления:  <span>{{$recipe->timePrepare}} мин.</span></h4>
                    <h4 class="single-recipe_time">Колличество калорий:  <span>{{$recipe->calory}} kal</span></h4>
                    <div>
                        <a href="{{route('cooker-book-add-recipe', ['idRecipe' => $recipe->idRecipe])}}" class="btn btn-success">Добавить в книгу рецептов</a>
                    </div>

                    <hr>
                    <h5 class="single-recipe_category">Автор:</h5>
                    <div class="recipe-user-info">

                        <div class="user-content">
                            <div class="user-photo">
                                @if (isset($user->userPhoto))
                                    <img src={{asset('storage/'.$user->userPhoto)}}>
                                @else
                                    <img src={{asset('storage/uploads/user-default.png')}}>
                                @endif
                            </div>
                            <div class="user-state">
                                <div class="user-name">
                                    {{$user->name}}
                                </div>
                                <div class="user-date">
                                    {{$user->createdAt}}
                                </div>
                            </div>
                        </div>
                        <div class="user-rating">
                            <div><p>Rating</p></div>
                            <div>{{$user->rating}}</div>

                        </div>
                    </div>


                </div>

            </div>

            <div class="single-recipe_ingredients">
                <p class="main-title">Ингридиенты:</p>
                @foreach ($ingredients as $ingredient)
                    <p>{{$ingredient->ingredient->titleIngredient}} - {{$ingredient->ingredient->count}} {{$ingredient->unit}}</p>
                @endforeach

            </div>
            <div class="single-recipe_description">
                <p class="main-title">Описание:</p>
                {{$recipe->recipeDescription}}
            </div>
            <div class="single-recipe_description">
                <p class="main-title">Пошаговое описание:</p>
                @foreach($recipeSteps as $step)
                    <p>Шаг {{$step->stepNumber}}.</p>
                    <div class="step-info">
                        @if (isset($step->stepPhoto))
                            <div class="step-photo">
                                <img src={{asset('storage/'.$step->stepPhoto)}}>
                            </div>

                        @endif
                        <div class="step-description">
                            {{$step->stepDescription}}
                        </div>
                    </div>


                @endforeach
            </div>
            <div class="comments">
                <p class="main-title">Комментарии:</p>
                <div class="comment-add">
                    <form action="{{route('comment.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="comment">Оставьте Ваш комментарий</label>
                            <textarea id="comment" required  class="form-control" name="comment"></textarea>
                            <input type="hidden" name="recipeId" value="{{$recipe->idRecipe}}">
                        </div>
                        <div class="add-comment-button">
                            <input type="submit" value="Добавить комментарий" class="btn btn-danger">
                        </div>
                    </form>
                </div>
                <hr>
                <input type="hidden" id="idRecipe" value="{{$recipe->idRecipe}}">
                <div class="comment-list">

                    @foreach($comments as $comment)

                        <div class="comment">
                            <div class="user-name">
                                {{$comment->user->name}}
                            </div>
                            <div class="comment-date">
                                {{$comment->createdAt}}
                            </div>
                            <div class="comment-text">
                                {{$comment->commentText}}
                            </div>
                            @if ($comment->idUser == $recipe->idUser)
                                <a href="{{route('comment-delete', ['idComment' => $comment->idComment])}}" class="btn btn-danger">Удалить</a>
                            @endif
                        </div>
                    @endforeach

                </div>
                <div class="add-recipe-button">
                    <input id="showMoreComment" onclick="showMoreComments()" value="Больше комментариев" class="btn btn-success">
                </div>
            </div>


        </div>


    </div>
@endsection
