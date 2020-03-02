@extends('layouts.app')
@section('content')
    @push('scripts')
        <script src="{{asset('js/resume.js')}}"></script>
    @endpush
    <div class="container">
        @include("partial.error")
        @include("partial.success")
        <p class="main-title">Resume</p>
        <form method="post" action="{{route('resume-send')}}" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row">
                <div class=" col-md-6">
                    <div class="form-group">
                        <label for="surname">Введите Вашу фамилию</label>
                        <input id="surname" type="text" class="form-control"  required name="surname">

                    </div>
                    <div class="form-group">
                        <label for="name">Введите Ваше имя</label>
                        <input id="name" type="text" class="form-control"  required name="name">

                    </div>
                    <div class="form-group">
                        <label for="second_name">Введите Ваше отчество</label>
                        <input id="second_name" type="text" class="form-control"  required name="second_name">

                    </div>
                    <div class="form-group">
                        <label for="birth">Введите дату рождения</label>
                        <input id="birth" type="date" class="form-control"  required name="birth">

                    </div>
                    <div class="form-group">
                        <label for="phone">Введите телефон в формате +380xxxxxxxxx</label>
                        <input id="phone"  type="text" class="form-control"  required name="phone">

                    </div>
                    <p class="second-title">Образование и ученые степени</p>
                    <div class="col-md-12" style="padding: 0; ">
                        <div id="diplomPlaceholder">
                            <?php $diplomCounter = 0?>
                            @if (isset($diploms[0]))
                                @foreach($diploms as $diplom)
                                    <?php $diplomCounter++?>
                                    <div class="col-md-12 step-form">
                                        <div class="step-header">
                                            <button id="btnStepRemove" class="btn btn-danger" type="button" onclick="DeleteDiplom(this)" style="height:30px; line-height:10px; vertical-align:middle;  margin-left:80px; display:inline-block">Entfernen</button>
                                        </div>
                                        <div class="template-body">
                                            <label>Специальность</label>

                                            <input type="text" required name=<?php print htmlentities("diplom[".$diplomCounter."][diplomSpecialty]")?> class="bio-value"
                                                   value={{$diplom->diplomSpecialty}}>

                                            <p>Фото диплома</p>
                                            <input type="file" value={{$diplom->diplomPhoto}} name=<?php print  htmlentities("diplom[".$diplomCounter."][DiplomPhoto]")?>>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button id="btnAddDiplom" style="margin-bottom: 20px" type="button" onclick="AddDiplom()" class="btn btn-success">Добавить новую специальность</button>
                    </div>
                </div>
                <div class=" col-md-6">
                    <div class="form-group">
                        <p class="second-title">Выбирите Ваши услуги</p>
                        <div class="form-group">
                            <label for="titleIngredient">Выбирите услугу</label>
                            <label for="description">Выбирите категорию</label>
                            <select id="service" class="form-control" name="service">
                                <option selected disabled>Выберите из списка</option>
                                @foreach($services as $service)
                                    <option value="{{$service->idService}}">{{$service->titleService}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="count">Введите стоимость в гривнах (цифра)</label>
                            <input id="count" type="text" class="form-control" name="count">
                        </div>

                        <button type="button" onclick="AddService()">Добавить услугу</button>
                        <p id="errorService" style="display: none;" class="bg-danger">Поля название ингридиента и колличество должны быть заполнены!</p>
                        <p id="errorTitleService" style="display: none;" class="bg-danger">Такая услуга есть в Вашем списке!</p>
                        <p class="second-title">Ваши услуги</p>
                        <table id="servicesTable" class="table">
                            <thead>

                            <th scope="col">Ваши услуги</th>
                            <th scope="col">Удаление из списка</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <input id="services" type="hidden" class="form-control" name="services">

                    </div>
                    <div class="form-group">
                        <label for="private_practice">Опыт частной практики (лет):</label>
                        <input type="text" id="private_practice" value="{{old('private_practice')}}" class="form-control" name="private_practice">

                    </div>
                    <div class="form-group">
                        <label for="med_practice">Опыт работы в медицинских учреждениях (лет):</label>
                        <input type="text" id="med_practice" value="{{old('med_practice')}}" class="form-control" name="med_practice">

                    </div>

                    <div class="form-group">
                        <label for="description">Дополнительно о себе:</label>
                        <textarea id="description" required value="{{old('description')}}" class="form-control" name="description"></textarea>

                    </div>
                    <div class="form-group">
                        <label for="description">Для подтверждения Вашей личности приложите Ваше фото с паспортом в руках (открытым на первой странице):</label>
                        <input type="file" required  name="passport">

                    </div>
                </div>
            <div class="add-recipe-button">
                <input type="submit" value="Отправить резюме" class="btn btn-danger">
            </div>
            </div>
        </form>


    </div>
    <div id="diplomTemplate" class="create-diplom-short"  style="visibility:hidden;">
        <div class="step-header">
            <button id="btnDiplomRemove" class="btn btn-danger" type="button" onclick="DeleteDiplom(this)" style="height:30px; line-height:10px; vertical-align:middle;  margin-left:10px; display:inline-block">Entfernen</button>
        </div>
        <div class="template-body">
            <label>Специальность</label>

            <input type="text" required name="diplom[1][diplomSpecialty]" class="bio-value">
            <p>Фото диплома</p>
            <input type="file" name="diplom[1][DiplomPhoto]">
        </div>

    </div>
@endsection
