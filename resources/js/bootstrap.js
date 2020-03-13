window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

 import Echo from 'laravel-echo';

 window.Pusher = require('pusher-js');

 window.Echo = new Echo({
     broadcaster: 'pusher',
     key: 'dd6390afff618f644706',
     cluster: 'eu',
     encrypted: true,
     authEndpoint: 'http://localhost:1252/laravel/well-fed-home/public/broadcasting/auth',
     csrfToken: document.querySelector('meta[name="_token"]').getAttribute('content')
     //auth: {
         //headers: {
             //'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
         //}
     //}
 });

window.Echo.private('room.11')
    .listen('NewMessageNotification', (e) => {
       //alert('Вам сообщение от администратора!');
        let admin_link = document.getElementById('admin');
        let mess = document.createElement("div");
        mess.setAttribute("style", "position:absolute; top:30px; left:0; background: #ffe924;padding: 5px;\n" +
            "border-radius: 0 10px 10px 10px; color: #4d4729;");
        mess.textContent = 'Message!';
        admin_link.appendChild(mess);
    });
let id = document.getElementById('idUser').value;

window.Echo["private"]('message-from-admin.11.' + id).listen('NewAdminMessageNotification', function (e) {
    //alert('Вам сообщение от администратора!');
    var admin_link = document.getElementById('user');
    var mess = document.createElement("div");
    mess.setAttribute("style", "position:absolute; top:30px; left:0; background: #ffe924;padding: 5px;\n" + "border-radius: 0 10px 10px 10px; color: #4d4729;");
    mess.textContent = 'Message!';
    admin_link.appendChild(mess);
});
