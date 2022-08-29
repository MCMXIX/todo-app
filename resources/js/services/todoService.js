import axios from 'axios';

const oApiClient = axios.create({
    baseURL : '/api/todo',
    headers : {
        Accept : 'application/json',
        'Content-Type' : 'application/json'
    }
});

export default {
    /**
     * getTodoList
     * @param { object } oParam 
     * @returns 
     */
    getTodoList(oParam) {
        return oApiClient.get('/', { params : oParam });
    },

    /**
     * updateTodo
     * @param { object } oUpdateParam 
     * @returns 
     */
    updateTodo(oUpdateParam) {
        return oApiClient.put('/' + oUpdateParam.id, oUpdateParam.updated_data);
    },

    /**
     * createTodo
     * @param { object } oCreateParam 
     * @returns 
     */
    createTodo(oCreateParam) {
        return oApiClient.post('/', oCreateParam);
    },

    /**
     * deleteTodo
     * @param { int } iId 
     * @returns 
     */
    deleteTodo(iId) {
        return oApiClient.delete('/' + iId);
    }
}