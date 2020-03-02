"use strict"
window.onload = function() {

    let ok = document.getElementById('ok');
    console.log(ok);
    ok.style.display = 'none';
};
function canRegister(){
    let input = document.getElementById('isYes');

    if(input.checked){
        location.href = 'http://localhost:1252/laravel/well-fed-home/public/nutritionist-resume';
    }
    else{
        let ok = document.getElementById('ok');
        ok.style.display = 'block';
    }
}
