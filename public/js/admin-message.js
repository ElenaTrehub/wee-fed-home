"use strict"

let limit = 3;
let offset = 0;
function showMoreMessage(id) {

    offset = offset + limit;

    $.ajax({

        url: 'http://localhost:1252/laravel/well-fed-home/public/admin-message',

        type: "GET",

        data: {limit: limit, offset: offset, id: id},

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },

        success: function (data) {
            console.log(data);
            if (+data !== 0) {
                let strCommentList = '';

                for (let i = 0; i < data.comments.length; i++) {
                    if(data.comments[i].message.idSender === 11){
                        let button = '';
                        if (data.comments[i].message.isRead === 0) {
                            button = '<a href="message-delete/' + data.comments[i].message.idMessage + '" class="btn btn-danger">Удалить</a>'
                        }

                        let strComment = '<div class="message-sender">' +
                            '<div class="user-name">' +
                            data.comments[i].user.name +
                            '</div>' +
                            '<div class="comment-date">' +
                            data.comments[i].message.createdAt +
                            '</div>' +
                            '<div class="comment-text">' +
                            data.comments[i].message.textMessage +
                            '</div>' + button +

                            '</div>';
                        strCommentList += strComment;


                    }
                    else{
                        let strComment = '<div class="message-taker">' +
                            '<div class="user-name">' +
                            data.comments[i].user.name +
                            '</div>' +
                            '<div class="comment-date">' +
                            data.comments[i].message.createdAt +
                            '</div>' +
                            '<div class="comment-text">' +
                            data.comments[i].message.textMessage ;
                        strCommentList += strComment;


                    }


                }


                $('.comment-list').append(strCommentList);
            }
            else{
                let button = document.getElementById('showMoreMessage');
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
