import axios from 'axios';

const oApiClient = axios.create({
    baseURL : '/api/user',
    headers : {
        Accept : 'application/json',
        'Content-Type' : 'application/json'
    }
});

export default {
    /**
     * login
     * @param {object} oCredentials 
     * @returns 
     */
    login(oCredentials) {
        return oApiClient.post('/login', oCredentials);
    },

    /**
     * createUser
     * @param {object} oParameters 
     * @returns 
     */
    createUser(oParameters) {
        return oApiClient.post('/', oParameters);
    }
}