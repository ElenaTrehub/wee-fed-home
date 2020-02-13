@extends('layouts.app')

@section('content')
    <div class="container">
        <p class="main-title">Кулинарная книга</p>
        <div class="category-list">
            @foreach($categories as $category)

                    <div class="category-book">
                        <a href="{{route('cooker-book-category-recipes', ['idCategory' => $category->idCategory])}}">
                            <div class="category-name">
                                {{$category->categoryTitle}}
                            </div>
                        </a>
                    </div>


            @endforeach
        </div>
    </div>
@endsection