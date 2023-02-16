window._ = require('lodash');

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

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

// window.Echo.channel('message').listen('MessageCreated', (event) => {
//     // console.log(event)

//     playSound()
//     const datas = fetch('/message').then(res => res.json()).then(data => notifEl(data))
// })

// function playSound() {
//     const audio = new Audio('http://commondatastorage.googleapis.com/codeskulptor-assets/Evillaugh.ogg');
//     audio.play();
// }

// getMessage()
// function getMessage() {
//     fetch('/message').then(res => res.json()).then(data => notifEl(data))
// }

// function notifEl(datas) {
//     let html = ''
//     let links = ''

//     datas.forEach(data => {
//         html += `
//             <div class="dropdown-divider"></div>
//             <a href="#!" class="dropdown-item notify-expired" data-id="${data.id}">
//                 <span class="float-right text-muted text-sm">${timeSince(formatDate(data.created_at))}</span>
//                 <h6 class="mb-0">Pesan Baru</h6>
//                 <small class="mt-0 text-gray">${data.message}</small>
//             </a>
//         `
//     });
//     if(datas.length > 0) {
//         links += `
//             <div class="dropdown-divider"></div>
//             <a href="/notification-orders" class="dropdown-item dropdown-footer">See All Notifications</a>
//         `
//     }
//     document.getElementById('notification-el').innerHTML = html
//     document.getElementById('see-all-notify').innerHTML = links
//     document.getElementById('count-notify').innerText = datas.length
// }

// function formatDate(date) {
//     var m = new Date(date);
//     return m
// }

// function timeSince(date) {
//     let seconds = Math.floor((new Date() - date) / 1000);
//     let interval = seconds / 31536000;

//     if (interval > 1) {
//         return Math.floor(interval) + " years";
//     }
//     interval = seconds / 2592000;
//     if (interval > 1) {
//         return Math.floor(interval) + " months";
//     }
//     interval = seconds / 86400;
//     if (interval > 1) {
//         return Math.floor(interval) + " days";
//     }
//     interval = seconds / 3600;
//     if (interval > 1) {
//         return Math.floor(interval) + " hours";
//     }
//     interval = seconds / 60;
//     if (interval > 1) {
//         return Math.floor(interval) + " minutes";
//     }
//     return Math.floor(seconds) + " seconds";
// }