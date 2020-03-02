@extends('layouts.app')

@section('content')
    @push('scripts')
        <script src="{{asset('js/recipe.js')}}"></script>
    @endpush

    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <h3 class="main-title">Новый рецепт:</h3>
        <form method="post" action="{{route('recipe.store')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                    <div class=" col-md-6">
                        <div class="form-group">
                            <label for="title">Введите название рецепта</label>
                            <input id="title" type="text" class="form-control" value="{{old('title')}}" required name="title">

                        </div>
                        <div class="form-group">
                            <p>Введите ингридиенты</p>
                            <div class="form-group">
                                <label for="titleIngredient">Введите название ингридиена</label>
                                <input id="titleIngredient" type="text" class="form-control" name="titleIngredient">
                            </div>
                            <div class="form-group">
                                <label for="countIngredient">Введите колличество ингридиена (цифра)</label>
                                <input id="countIngredient" type="text" class="form-control" name="countIngredient">
                            </div>
                            <div class="form-group">
                                <label for="units">Выбирите единицы измерения</label>
                                <select id="units" class="form-control" name="units" >
                                    <option selected disabled>Выберите из списка</option>
                                    @foreach($units as $unit)
                                        <option>{{$unit->titleUnit}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" onclick="AddIngredient()">Добавить ингридиент</button>
                            <p id="errorIngredient" style="display: none;" class="bg-danger">Поля название ингридиента и колличество должны быть заполнены!</p>
                            <p id="errorTitleIngredient" style="display: none;" class="bg-danger">Вы уже добавили данный ингридиент!</p>
                            <p class="second-title">Ваши ингридиенты</p>
                            <table id="ingredientTable" class="table">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Ваши ингридиенты</th>
                                    <th scope="col">Удаление из списка</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <input id="ingredients" value="{{old('ingredients')}}" type="hidden" class="form-control" name="ingredients">

                        </div>
                        <div class="form-group">
                            <label for="description">Введите описание рецепта</label>
                            <textarea id="description" required value="{{old('description')}}" class="form-control" name="description"></textarea>

                        </div>
                        <div class="form-group">
                            <label for="photoRecipe">Загрузите фото блюда</label>
                            <input type="file" value="{{old('photoRecipe')}}" name="photoRecipe">

                        </div>
                    </div>
                    <div class=" col-md-6">

                    <div class="form-group">
                        <label for="description">Выбирите категорию</label>
                        <select class="form-control" name="category" value="{{old('category')}}">
                            <option selected disabled>Выберите из списка</option>
                            @foreach($categories as $category)
                                <option value="{{$category->idCategory}}">{{$category->categoryTitle}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="timePrepare">Время приготовления</label>
                        <input id="timePrepare" type="number" class="form-control" value="{{old('timePrepare')}}" name="timePrepare">

                    </div>
                    <div class="form-group">
                        <label for="">Колличество калорий</label>
                        <input id="calory" type="number" class="form-control" value="{{old('calory')}}" name="calory">

                    </div>

                    <p class="second-title">Опишите шаги приготовления</p>
                    <div class="col-md-12" style="padding: 0; ">
                        <div id="stepPlaceholder">
                            <?php $stepCounter = 0?>
                            @if (isset($steps[0]))
                                @foreach($steps as $step)
                                        <?php $stepCounter++?>
                                        <div class="col-md-12 step-form">
                                            <div class="step-header">
                                                <button id="btnStepRemove" class="btn btn-danger" type="button" onclick="DeleteStep(this)" style="height:30px; line-height:10px; vertical-align:middle;  margin-left:80px; display:inline-block">Entfernen</button>
                                            </div>
                                            <div class="template-body">
                                                <label>Описание</label>

                                                <input type="text" required name=<?php print htmlentities("step[".$stepCounter."][StepDescription]")?> class="bio-value"
                                                       value={{$step->stepDescription}}>

                                                <label>Фото</label>
                                                <input type="file" value={{$step->stepPhoto}} name=<?php print  htmlentities("step[".$stepCounter."][StepPhoto]")?>>

                                            </div>
                                        </div>
                                @endforeach
                            @endif
                        </div>
                        <button id="btnAddStep" style="margin-bottom: 20px" type="button" onclick="AddStep()" class="btn btn-success">Добавить следующий шаг</button>
                    </div>
                    </div>
                    </div>
            <div class="add-recipe-button">
                <input type="submit" value="Добавить новый рецепт" class="btn btn-danger">
            </div>

                </form>


    </div>

    <div id="stepTemplate" class="create-step-short"  style="visibility:hidden;">
        <div class="step-header">
            <button id="btnStepRemove" class="btn btn-danger" type="button" onclick="DeleteStep(this)" style="height:30px; line-height:10px; vertical-align:middle;  margin-left:10px; display:inline-block">Entfernen</button>
        </div>
        <div class="template-body">
            <label>Описание</label>

            <input type="text" required name="step[1][StepDescription]" class="bio-value">
            <label>Фото</label>
            <input type="file" name="step[1][StepPhoto]">
        </div>

    </div>
@endsection
