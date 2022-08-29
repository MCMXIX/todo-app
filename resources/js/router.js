import Vue from 'vue';
import Router from 'vue-router';
import Login from './user/views/login.vue'; 
import CreateUser from './user/views/CreateUser.vue';
import UpdateUser from './user/views/UpdateUser.vue';
import Home from './dashboard/views/home.vue';

Vue.use(Router);

export default new Router({
    mode : 'history',
    scrollBehavior (to, from, savedPosition) {
        if (to.hash) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    resolve({selector : to.hash});
                }, 1000);
            });
        }
        return {x : 0, y : 0};
    },
    routes : [
        {
            path : '/login',
            name : 'login',
            component : Login
        },
        {
            path : '/register',
            name : 'registration',
            component : CreateUser
        },
        {
            path : '/user_info',
            name : 'UpdateUser',
            component : UpdateUser
        },
        {
            path : '/',
            name : 'home',
            component : Home
        }
    ]
});