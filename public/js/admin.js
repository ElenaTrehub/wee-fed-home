"use strict"
let limit = 3;
let offset = 0;
function showMoreUsers() {
    offset = offset + limit;
    $.ajax({

        url: 'admin-show-more-users',

        type: "GET",

        data: {limit: limit, offset: offset},

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },

        success: function (data) {
            //console.log(data);
            if (+data !== 0) {

                let strUserList = '';
                for (let i = 0; i < data.users.length; i++) {
                    let userPfoto;

                    if (data.users[i].userPhoto) {
                        userPfoto ='storage/'+ data.users[i].userPhoto;
                    } else {
                        userPfoto = "storage/uploads/user-default.png";
                    }
                    let strUser = '';
                    if(data.users[i].isBlock === 0){
                        strUser = '<div class="user-not-block">'+
                            '<div class="user-admin-photo">'+
                            '<img src="' + userPfoto + '">' +
                            '</div>'+

                            '<div class="user-admin-name">'+
                            data.users[i].name +
                            '</div>'+
                            '<div class="user-admin-email">'+
                            data.users[i].email +
                            '</div>'+
                            '<div class="user-admin-button">'+
                            '<a href="user-block/'+ data.users[i].id +'" class="btn btn-danger">Block</a>'+
                            '</div>'+
                            '</div>';
                        strUserList += strUser;
                    }
                    else{
                        strUser ='<div class="user-block">'+
                            '<div class="user-admin-photo">'+
                            '<img src="' + userPfoto + '">' +
                            '</div>'+

                            '<div class="user-admin-name">'+
                            data.users[i].name +
                            '</div>'+
                            '<div class="user-admin-email">'+
                            data.users[i].email +
                            '</div>'+
                            '<div class="user-admin-button">'+
                            '<a href="user-unlock/'+ data.users[i].id +'" class="btn btn-danger">Unlock</a>'+
                            '</div>'+
                            '</div>';
                        strUserList += strUser;
                    }



                }

                //console.log(strRecipeList);

                $('.user-list').append(strUserList);
            }
            else{
                let button = document.getElementById('showMoreUsers');
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
