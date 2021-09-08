window.Vue = require('vue');
export const EventBus = new Vue();

Vue.component('messages-component', require('./components/MessagesComponent.vue').default);
if(typeof Dropzone !== "undefined")
    Dropzone.autoDiscover = false;
import VueEcho from 'vue-echo';
 
Vue.use(VueEcho, {
    broadcaster: 'socket.io',
    host: window.location.hostname + ':' + 6009,
    key: 'c0b03ce0b7c3963aea0c507a3d8d49ae'
});

new Vue({
    el: '#app'
});