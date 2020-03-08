"use strict";

let isFilterShow = false;
let limit = 3;
let offset = 0;
function ShowFilters(){
    let filters = document.getElementsByClassName('filters')[0];
    let button = document.getElementById('showFilters');
    //console.log(filters);
    if(isFilterShow === false){
        filters.style.display = 'block';
        isFilterShow = true;
        button.value = 'Убрать фильтры';
    }
    else{
        filters.style.display = 'none';
        isFilterShow = false;
        button.value = 'Отобразить фильтры';
    }
}
function showMoreRecipe() {
    offset = offset + limit;
    //et filters = document.getElementsByClassName('filters')[0];
    if(isFilterShow){
        SearchRecipe(offset, limit)
    }
    else{
        MoreRecipe(offset, limit);
    }

}
function MoreRecipe(offset, limit) {

    console.log(offset);
    console.log(limit);
    $.ajax({

        url: 'show-more',

        type: "GET",

        data: {limit: limit, offset: offset},

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },

        success: function (data) {
            console.log(data);
            if (+data !== 0) {

                let strRecipeList = '';
                for (let i = 0; i < data.recipes.length; i++) {
                    let userPfoto;

                    if (data.recipes[i].user.userPhoto) {
                        userPfoto ='storage/'+ data.recipes[i].user.userPhoto;
                    } else {
                        userPfoto = "storage/uploads/user-default.png";
                    }
                    let recipePfoto;
                    if (data.recipes[i].recipe.recipePhoto) {
                        recipePfoto = 'storage/' + data.recipes[i].recipe.recipePhoto;
                    } else {
                        recipePfoto = '/storage/uploads/user-default.png';
                    }
                    let recipeDescription = "";
                    if (data.recipes[i].recipe.recipeDescription.length > 90) {
                        recipeDescription = data.recipes[i].recipe.recipeDescription;
                        let desc = recipeDescription.substring(0, 90);
                        let lastIndex = desc.lastIndexOf(" ");
                        recipeDescription = desc.substring(0, lastIndex) + '...';
                    }
                    let calory = 0;
                    if (data.recipes[i].recipe.calory == null) {
                        calory = "Калории неизвестны";
                    } else {
                        calory = data.recipes[i].recipe.calory + 'kal';
                    }
                    let strRecipe = '<div class="recipe">' +
                        '<div class="user-info">' +
                        '<div class="user-content">' +
                        '<div class="user-photo">' +
                        '<img src="' + userPfoto + '">' +
                        '</div>' +
                        '<div class="user-state">' +
                        '<div class="user-name">' +
                        data.recipes[i].user.name +
                        '</div>' +
                        '<div class="user-date">' +
                        data.recipes[i].user.createdAt +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="user-rating">' +
                        '<div><p>Rating</p></div>' +
                        '<div>' + data.recipes[i].user.rating + '</div>' +

                        '</div>' +
                        '</div>' +
                        '<div class="recipe-photo">' +
                        '<img src="' + recipePfoto + '">' +
                        '<div class="calory">' +
                        calory +
                        '</div>' +
                        '</div>' +
                        '<div class="recipe-info">' +
                        '<p class="recipe-title">' + data.recipes[i].recipe.recipeTitle + '</p>' +
                        '<p class="recipe-category">' + data.recipes[i].category.categoryTitle + '</p>' +
                        '<p class="recipe-description">' + recipeDescription + '</p>' +
                        '<a href="recipe/' + data.recipes[i].recipe.idRecipe + '">Подробнее...</a>' +
                        '</div>' +
                        '<div class="recipe-ratio">' +
                        '<div class="recipe-like">' +
                        '<img src="storage/uploads/like.png">' +
                        data.recipes[i].likes +
                        '</div>' +
                        '<div class="recipe-dislike">' +
                        '<img src="storage/uploads/dislike.png">' +
                        data.recipes[i].dislikes +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    strRecipeList += strRecipe;
                }

                console.log(strRecipeList);

                $('.recipe-list').append(strRecipeList);
            }
            else{
                let button = document.getElementById('showMore');
                //console.log(button);
                button.style.disabled = true;
                button.style.opacity = 0.5;
            }
        },

        error: function (msg) {

            alert('Ошибка');

        }

    });

}

function SearchRecipe(offset, limit) {
//console.log(offset);
    //console.log(limit);
    let category = $('#category')[0].value;
    console.log(category);
    let max_calory = $('#max_calory')[0].value;
    console.log(max_calory);
    let ingr = $('#ingr')[0].value;
    console.log(ingr);


    $.ajax({

        url: 'recipe-search',

        type: "GET",

        data: {category: category, calory: max_calory, ingr: ingr, limit: limit, offset: offset},

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },

        success: function (data) {
            console.log(data);
            if (+data !== 0) {
                let strRecipeList = '';
                for (let i = 0; i < data.recipes.length; i++) {
                    let userPfoto;

                    if (data.recipes[i].user.userPhoto) {
                        userPfoto = 'storage/' + data.recipes[i].user.userPhoto;
                    } else {
                        userPfoto = "storage/uploads/user-default.png";
                    }
                    let recipePfoto;
                    if (data.recipes[i].recipe.recipePhoto) {
                        recipePfoto = 'storage/' + data.recipes[i].recipe.recipePhoto;
                    } else {
                        recipePfoto = 'storage/uploads/user-default.png';
                    }
                    let recipeDescription = "";
                    if (data.recipes[i].recipe.recipeDescription.length > 90) {
                        recipeDescription = data.recipes[i].recipe.recipeDescription;
                        let desc = recipeDescription.substring(0, 90);
                        let lastIndex = desc.lastIndexOf(" ");
                        recipeDescription = desc.substring(0, lastIndex) + '...';
                    }
                    let calory = 0;
                    if (data.recipes[i].recipe.calory == null) {
                        calory = "Калории неизвестны";
                    } else {
                        calory = data.recipes[i].recipe.calory + 'kal';
                    }
                    let strRecipe = '<div class="recipe">' +
                        '<div class="user-info">' +
                        '<div class="user-content">' +
                        '<div class="user-photo">' +
                        '<img src="' + userPfoto + '">' +
                        '</div>' +
                        '<div class="user-state">' +
                        '<div class="user-name">' +
                        data.recipes[i].user.name +
                        '</div>' +
                        '<div class="user-date">' +
                        data.recipes[i].user.createdAt +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="user-rating">' +
                        '<div><p>Rating</p></div>' +
                        '<div>' + data.recipes[i].user.rating + '</div>' +

                        '</div>' +
                        '</div>' +
                        '<div class="recipe-photo">' +
                        '<img src="' + recipePfoto + '">' +
                        '<div class="calory">' +
                        calory +
                        '</div>' +
                        '</div>' +
                        '<div class="recipe-info">' +
                        '<p class="recipe-title">' + data.recipes[i].recipe.recipeTitle + '</p>' +
                        '<p class="recipe-category">' + data.recipes[i].category.categoryTitle + '</p>' +
                        '<p class="recipe-description">' + recipeDescription + '</p>' +
                        '<a href="recipe/' + data.recipes[i].recipe.idRecipe+ '">Подробнее...</a>' +
                        '</div>' +
                        '<div class="recipe-ratio">' +
                        '<div class="recipe-like">' +
                        '<img src="storage/uploads/like.png">' +
                        data.recipes[i].likes +
                        '</div>' +
                        '<div class="recipe-dislike">' +
                        '<img src="storage/uploads/dislike.png">' +
                        data.recipes[i].dislikes +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    strRecipeList += strRecipe;
                }

                //console.log(strRecipeList);

                if (offset === 0) {
                    $('.recipe-list').empty();
                }

                $('.recipe-list').append(strRecipeList);

            } else {
                let button = document.getElementById('showMore');
                console.log(button);
                button.style.disabled = true;
                button.style.opacity = 0.5;
            }
        },
            error: function (msg) {

                alert('Ошибка' + msg);
                console.log(msg);

            }


    });

}
