"use strict";

let limit = 3;
let offset = 0;

function showMoreRecipe(idCategory) {
    offset = offset + limit;
    console.log(idCategory);
    $.ajax({

        url: 'http://localhost:1252/laravel/well-fed-home/public/show',

        type: "GET",

        data: {limit: limit, offset: offset, idCategory: idCategory},

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },
        success:
            function (data) {
            console.log(data);
            if (+data !== 0) {

                let strRecipeList = '';
                for (let i = 0; i < data.recipes.length; i++) {
                    let userPfoto;

                    if (data.recipes[i].user.userPhoto) {
                        userPfoto = data.recipes[i].user.userPhoto;
                    } else {
                        userPfoto = "http://localhost:1252/laravel/well-fed-home/public/storage/uploads/user-default.png";
                    }
                    let recipePfoto;
                    if (data.recipes[i].recipe.recipePhoto) {
                        recipePfoto = 'http://localhost:1252/laravel/well-fed-home/public/storage/' + data.recipes[i].recipe.recipePhoto;
                    } else {
                        recipePfoto = 'http://localhost:1252/laravel/well-fed-home/public/storage/uploads/user-default.png';
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
                    let strRecipe = '<div class="recipe" style="margin-top: 50px">' +
                        '<div class="delete-from-cooker">'+
                        '<input type="hidden" value="' + data.recipes[i].recipe.idRecipe +'">'+
                        'Удалить из кулинарной книги'+
                        '</div>'+
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
                        '<p class="recipe-category">' + data.category.categoryTitle + '</p>' +
                        '<p class="recipe-description">' + recipeDescription + '</p>' +
                        '<a href="recipe/' + data.recipes[i].recipe.idRecipe + '">Подробнее...</a>' +
                        '</div>' +
                        '<div class="recipe-ratio">' +
                        '<div class="recipe-like">' +
                        '<img src="http://localhost:1252/laravel/well-fed-home/public/storage/uploads/like.png">' +
                        data.recipes[i].recipe.like +
                        '</div>' +
                        '<div class="recipe-dislike">' +
                        '<img src="http://localhost:1252/laravel/well-fed-home/public/storage/uploads/dislike.png">' +
                        data.recipes[i].recipe.dislike +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    strRecipeList += strRecipe;
                }

                //console.log(strRecipeList);

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
