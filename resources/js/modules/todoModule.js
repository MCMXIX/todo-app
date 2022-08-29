import oTodoService from '../services/todoService';

const oInitialState = {
    aTodoList : []
}

const mutations = {
    /**
     * SET_TODO_LIST
     * @param { object } state 
     * @param { array } aTodoList 
     */
    SET_TODO_LIST(state, aTodoList) {
        state.aTodoList = aTodoList;
    }
}

const actions = {
    /**
     * getTodoList
     * @param object commit
     * @param { object } oParam
     */
    async getTodoList({ commit }, oParam) {
        await oTodoService.getTodoList(oParam)
            .then(oResponse => {
                commit('SET_TODO_LIST', oResponse.data.list);
            })
    },

    /**
     * updateTodo
     * @param object commit
     * @param { object } oParam
     */
     async updateTodo({ commit }, oParam) {
        await oTodoService.updateTodo(oParam)
            .then(oResponse => {
                alert(oResponse.data.message);
            })
            .catch((oError) => {
                alert(oError.response.data.message);
            });
    },

    /**
     * createTodo
     * @param object commit
     * @param { object } oParam
     */
     async createTodo({ commit }, oParam) {
        await oTodoService.createTodo(oParam)
            .then(oResponse => {
                alert(oResponse.data.message);
            })
            .catch((oError) => {
                alert(oError.response.data.message);
            });
    },

    /**
     * deleteTodo
     * @param object commit
     * @param { int } iId 
     */
    async deleteTodo({ commit }, iId) {
        await oTodoService.deleteTodo(iId)
            .then(oResponse => {
                alert(oResponse.data.message);
            })
            .catch((oError) => {
                alert(oError.response.data.message);
            });
    }
}

const getters = {
    /**
     * aTodoList
     * @param { object } state 
     * @returns array
     */
    aTodoList(state) {
        return state.aTodoList;
    }
}

export default {
    state : oInitialState,
    mutations,
    actions,
    getters,
    namespaced: true
}