import oUserService from '../services/userService';

const oInitialState = {
    oUserInfo : {}
}

const mutations = {
    /**
     * SET_USER_INFO
     * @param { object } state 
     * @param { array } oUserInfo 
     */
    SET_USER_INFO(state, oUserInfo) {
        state.oUserInfo = oUserInfo;
    }
}

const actions = {
    /**
     * login
     * @param object commit
     * @param { object } oCredentials 
     */
    async login({ commit }, oCredentials) {
        await oUserService.login(oCredentials)
            .then(() => {
                location.replace('/');
            })
            .catch(oError => {
                alert(oError.response.data.message);
            });
    },

    /**
     * createUser
     * @param commit
     * @param { object } oParameters 
     */
    async createUser({ commit }, oParameters) {
        await oUserService.createUser(oParameters)
            .then(() => {
                location.replace('/login');
            })
            .catch(oError => {
                alert(oError.response.data.message);
            });
    },

    /**
     * getUserInfo
     * @param object commit
     */
    async getUserInfo({ commit }) {
        await oUserService.getUserInfo()
            .then((oResponse) => {
                commit('SET_USER_INFO', oResponse.data.user[0]);
            })
            .catch((oError) => {
                alert(oError.response.data.message);
            })
    }
}

const getters = {
    /**
     * oUserInfo
     * @param { object } state 
     * @returns array
     */
     oUserInfo(state) {
        return state.oUserInfo;
    }
}

export default {
    state : oInitialState,
    mutations,
    actions,
    getters,
    namespaced: true
}