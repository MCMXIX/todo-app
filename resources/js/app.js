require('./bootstrap');

import Vue from 'vue';
import Dashboard from './dashboard/dashboard.vue';
import router from './router.js';
import store from './store.js'

new Vue({
    el : '#dashboard',
    router,
    store,
    render: h => h(Dashboard)
});
