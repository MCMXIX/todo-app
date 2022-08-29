import Vue from 'vue';
import Vuex from 'vuex';
import oUser from './modules/userModule';
import oTodo from './modules/todoModule';
import oNote from './modules/noteModule';

Vue.use(Vuex);

export default new Vuex.Store({
    modules : {
        oUser,
        oTodo,
        oNote
    }
});