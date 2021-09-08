window.Vue = require('vue');
export const EventBus = new Vue();

Vue.component('search-box', require('./components/Search.vue').default);
 
new Vue({
    el: '#search'
});