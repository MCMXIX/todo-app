import oUserService from '../services/userService';

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
    }
}

export default {  
    actions,
    namespaced : true
}