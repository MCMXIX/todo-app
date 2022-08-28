require('./bootstrap');

import Vue from 'vue';
import User from './user/user.vue';
import router from './router.js';
import store from './store.js'

new Vue({
    el : '#user-management',
    router,
    store,
    render: h => h(User)
});
