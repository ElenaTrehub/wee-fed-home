"use strict"

let limit = 3;
let offset = 0;
function showMoreComments(idRecipe) {

    offset = offset + limit;

    //console.log(offset);
   //console.log(limit);
   // let idRecipe = $('#idRecipe').value;
    //console.log(idRecipe);
    $.ajax({

        url: 'http://localhost:1252/laravel/well-fed-home/public/recipe-comments',

        type: "GET",

        data: {limit: limit, offset: offset, idRecipe: idRecipe },

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },

        success: function (data) {
            console.log(data);
            if (+data !== 0) {
                let strCommentList = '';

                for (let i = 0; i < data.comments.length; i++) {
                    let button = '';
                    if (data.comments[i].idUser === idRecipe) {
                        button = '<a href="comment-delete/' + data.comments[i].idComment + '" class="btn btn-danger">Удалить</a>'
                    }

                    let strComment = '<div class="comment">' +
                        '<div class="user-name">' +
                        data.comments[i].user.name +
                        '</div>' +
                        '<div class="comment-date">' +
                        data.comments[i].createdAt +
                        '</div>' +
                        '<div class="comment-text">' +
                        data.comments[i].commentText +
                        '</div>' + button +

                        '</div>';
                    strCommentList += strComment;
                }


                $('.comment-list').append(strCommentList);
            }
            else{
                let button = document.getElementById('showMoreComment');
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
