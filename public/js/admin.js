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

                    if (data.users[i].user.userPhoto) {
                        userPfoto ='storage/'+ data.users[i].user.userPhoto;
                    } else {
                        userPfoto = "storage/uploads/user-default.png";
                    }
                    let strUser = '';
                    let message = '';

                    if (data.users[i].hasMessage === true) {
                        message ='<label style="margin-left:20px; background: #ffe924;padding: 5px;\n' +
                            '    border-radius: 0 10px 10px 10px; color: #4d4729;">\n' +
                            '                                    Message!\n' +
                            '                                </label>';
                    }
                    if(data.users[i].user.idStatus === 3){
                        strUser = '<div class="user-not-block">'+
                            '<div class="user-admin-photo">'+
                            '<img src="' + userPfoto + '">' +
                            '</div>'+

                            '<div class="user-admin-name">'+
                            data.users[i].user.name +
                            '</div>'+
                            '<div class="user-admin-email">'+
                            data.users[i].user.email +
                            message+
                            '</div>'+
                            '<div class="user-admin-button">'+
                            '<a href="user-block/'+ data.users[i].user.id +'" class="btn btn-danger">Block</a>'+
                            '<a href="user-admin-message/'+ data.users[i].user.id + '"style="margin-left: 10px" class="btn btn-primary">Сообщения</a>'+
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
                            data.users[i].user.name +
                            '</div>'+
                            '<div class="user-admin-email">'+
                            data.users[i].user.email +
                            message+
                            '</div>'+
                            '<div class="user-admin-button">'+
                            '<a href="user-unlock/'+ data.users[i].user.id +'" class="btn btn-danger">Unlock</a>'+
                            '<a href="user-admin-message/'+ data.users[i].user.id + '"style="margin-left: 10px" class="btn btn-primary">Сообщения</a>'+
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
