@extends('layouts.app')

@section('content')
    @push('scripts')
        <script src="{{asset('js/updateRecipe.js')}}"></script>
    @endpush
    @include("partial.error")
    @include("partial.success")
    <div class="container">

        <h3 class="main-title">{{$recipe->recipeTitle}}</h3>
        <form  action="{{route('recipe.update', ['idRecipe'=> $recipe->idRecipe])}}" method="POST"  enctype="multipart/form-data">
            {{csrf_field()}}
            {{ method_field('PUT') }}

            <div class="row">
                <div class=" col-md-6">
                    <div class="form-group">
                        <label for="title">Название рецепта</label>
                        <input id="title" type="text" class="form-control" value="{{$recipe->recipeTitle}}" required name="title">

                    </div>
                    <div class="form-group">
                        <p>Введите ингридиенты</p>
                        <div class="form-group">
                            <label for="titleIngredient">Введите название ингридиена</label>
                            <input id="titleIngredient" type="text" class="form-control" name="titleIngredient">
                        </div>
                        <div class="form-group">
                            <label for="countIngredient">Введите колличество ингридиена (цифра)</label>
                            <input id="countIngredient" type="text"class="form-control" name="countIngredient">
                        </div>
                        <div class="form-group">
                            <label for="units">Введите единицы измерения (напимер л)</label>
                            <input id="units" type="text" class="form-control" name="units">
                        </div>
                        <button type="button" onclick="AddIngredient()">Добавить ингридиент</button>
                        <p id="errorIngredient" style="display: none;" class="bg-danger">Поля название ингридиента и колличество должны быть заполнены!</p>
                        <p class="second-title">Ваши ингридиенты</p>
                        <table id="editIngredientTable" class="table">
                            <thead>

                            <th scope="col">Ваши ингридиенты</th>
                            <th scope="col">Удаление из списка</th>
                            </thead>
                            <tbody>
                                @php $i=0; $strArray =  explode(";", $recipe->recipeIngredients);@endphp
                                @foreach ($strArray as $str)
                                    @if($str !='')
                                        @php $i++;@endphp
                                        <tr>
                                            <td>@php echo($i);@endphp</td>
                                            <td>@php printf("%s<br>", $str);@endphp</td>
                                            <td><input data-index="@php echo($i);@endphp" type="button" value="Remove" onclick="deleteIngredient(this)" class="btn btn-danger"></td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>



                        <input id="ingredients" value="{{$recipe->recipeIngredients}}"  class="form-control" name="ingredients">

                    </div>
                    <div class="form-group">
                        <label for="description">Введите описание рецепта</label>
                        <textarea id="description" required class="form-control" name="description">{{$recipe->recipeDescription}}</textarea>

                    </div>
                    <div class="form-group">
                        <p class="second-title">Фото рецепта</p>
                        <div class="table-photo">
                            @if (isset($recipe->recipePhoto))
                                <img src={{asset('storage/'.$recipe->recipePhoto)}} >
                                <input type="hidden" value="{{$recipe->recipePhoto}}" name="oldPhotoRecipe">
                            @endif
                        </div>
                        <label for="photoRecipe">Загрузите фото блюда</label>
                        <input type="file"  name="photoRecipe">

                    </div>
                </div>
                <div class=" col-md-6">

                    <div class="form-group">
                        <label for="description">Выбирите категорию</label>
                        <select class="form-control" name="category" >
                            <option selected disabled>Выберите из списка</option>
                            @foreach($categories as $category)
                                <option value="{{$category->idCategory}}">{{$category->categoryTitle}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="timePrepare">Время приготовления</label>
                        <input id="timePrepare" type="number" class="form-control" value="{{$recipe->timePrepare}}" name="timePrepare">

                    </div>
                    <div class="form-group">
                        <label for="">Колличество калорий</label>
                        <input id="calory" type="number" class="form-control" value="{{$recipe->calory}}" name="calory">

                    </div>
                    <p class="second-title">Опишите шаги приготовления</p>
                    <div class="col-md-12" style="padding: 0; ">
                        <div id="stepPlaceholder">
                            <?php $stepCounter = 0?>
                            @if (isset($steps[0]))
                                @foreach($steps as $step)
                                    <?php $stepCounter++?>
                                    <div class="col-md-12 create-step-short">
                                        <div class="step-header">
                                            <button id="btnStepRemove" class="btn btn-danger" type="button" onclick="DeleteStep(this)" style="height:30px; line-height:10px; vertical-align:middle;  margin-left:10px; display:inline-block">Entfernen</button>
                                        </div>
                                        <div class="template-body">
                                            <label>Описание</label>

                                            <input type="text" required name=<?php print htmlentities("step[".$stepCounter."][StepDescription]")?> class="bio-value"
                                                   value="{{$step->stepDescription}}">
                                            <p class="second-title">Фото текущего шага</p>
                                            <div class="table-photo">
                                                @if (isset($step->stepPhoto))
                                                    <img src={{asset('storage/'.$step->stepPhoto)}} >
                                                @endif
                                            </div>
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
                <input type="submit" value="Изменить рецепт" class="btn btn-danger">
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
