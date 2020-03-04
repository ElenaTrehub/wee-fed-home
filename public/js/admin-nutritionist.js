"use strict"
let limit = 3;
let offset = 0;
function showMoreNutritionist() {
    offset = offset + limit;
    console.log(limit);
    $.ajax({

        url: 'admin-show-more-nutritionist',

        type: "GET",

        data: {limit: limit, offset: offset},

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },

        success: function (data) {
            console.log(data);
            if (+data !== 0) {

                let strUserList = '';
                for (let i = 0; i < data.doctors.length; i++) {
                    let userPfoto;

                    if (data.doctors[i].user.userPhoto) {
                        userPfoto ='storage/'+ data.users[i].user.userPhoto;
                    } else {
                        userPfoto = "storage/uploads/user-default.png";
                    }
                    let strUser = '';
                    let specialty = '';
                    for (let j = 0; j < data.doctors[i].specialties.length; j++) {
                        specialty += '<p class="info">'+
                            data.doctors[i].specialties[j].titleSpecialty + '</p>'
                    }


                        strUser = '<div class="doctor">'+
                            '<div class="doctor-info">'+
                            '<div class="doctor-photo">'+
                            '<img src="' + userPfoto + '">' +
                            '</div>'+
                            '</div>'+

                            '<div class="doctor-description">'+
                            '<p class="recipe-title">'+
                    data.doctors[i].doctorInfo.surname + data.doctors[i].doctorInfo.name +data.doctors[i].doctorInfo.second_name +
                                '</p>'+
                            '<p class="recipe-category">'+
                            data.doctors[i].user.email +
                            '</p>'+
                            '<label>Образование:</label>'+
                            specialty+
                            '<a href="admin-nutritionist-info/'+ data.doctors[i].doctorInfo.idDoctorInfo +'">Подробнее...</a>'+
                            '</div>'+
                            '</div>';
                        strUserList += strUser;




                }

                //console.log(strRecipeList);

                $('.doctor-list').append(strUserList);
            }
            else{
                let button = document.getElementById('showMoreNutritionist');
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
