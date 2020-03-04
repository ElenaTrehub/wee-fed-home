"use strict";
let limit = 3;
let offset = 0;
function moreNutritionist() {
    offset = offset + limit;
    console.log(limit);
    $.ajax({

        url: 'more-nutritionist',

        type: "GET",

        data: {limit: limit, offset: offset},

        headers: {

            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

        },

        success: function (data) {
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

                    let services = '';
                    for (let k = 0; k < data.doctors[i].services.length; k++) {
                        services += '<p class="info">'+
                            data.doctors[i].services[k].titleService + ' - ' + data.doctors[i].services[k].pivot.sum + ' грню' + '</p>'
                    }
                    let doctorDescription = "";
                    if (data.doctors[i].doctorInfo.description.length > 90) {
                        doctorDescription = data.doctors[i].doctorInfo.description;
                        let desc = doctorDescription.substring(0, 90);
                        let lastIndex = desc.lastIndexOf(" ");
                        doctorDescription = desc.substring(0, lastIndex) + '...';
                    }


                    strUser = '<div class="doctor">'+
                        '<div class="doctor-info">'+
                        '<div class="doctor-photo">'+
                        '<img src="' + userPfoto + '">' +
                        '</div>'+
                        '<div class="doctor-ratio">'+
                        '<div class="doctor-like">'+
                        '<img src="storage/uploads/like.png">'+
                        data.doctors[i].likes +
                        '</div>'+
                    '<div class="doctor-dislike">'+
                        '<img src="storage/uploads/dislike.png">'+
                        data.doctors[i].dislikes +
                        '</div>' +
                        '</div>'+
                        '</div>'+

                        '<div class="doctor-description">'+
                        '<p class="recipe-title">'+
                        data.doctors[i].doctorInfo.surname + ' ' + data.doctors[i].doctorInfo.name + ' ' + data.doctors[i].doctorInfo.second_name +
                        '</p>'+
                        '<p class="recipe-category">Рейтинг: '+
                        data.doctors[i].doctorInfo.rating +
                        '</p>'+
                        '<label>Образование:</label>'+
                        specialty +
                        '<label>Услуги:</label>'+
                        services +
                        '<label>О себе:</label>'+
                        '<p class="info">'+
                        doctorDescription +
                        '</p>'+
                        '<a href="nutritionist-info/'+ data.doctors[i].doctorInfo.idDoctorInfo +'">Подробнее...</a>'+
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
