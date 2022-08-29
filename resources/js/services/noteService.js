import axios from 'axios';

const oApiClient = axios.create({
    baseURL : '/api/note',
    headers : {
        Accept : 'application/json',
        'Content-Type' : 'application/json'
    }
});

export default {
    /**
     * updateNote
     * @param { object } oUpdateParam 
     * @returns 
     */
    updateNote(oUpdateParam) {
        return oApiClient.put('/' + oUpdateParam.id, oUpdateParam.updated_data);
    },

    /**
     * createNote
     * @param { object } oCreateParam 
     * @returns 
     */
    createNote(oCreateParam) {
        return oApiClient.post('/', oCreateParam);
    },

    /**
     * deleteNote
     * @param { int } iId 
     * @returns 
     */
    deleteNote(iId) {
        return oApiClient.delete('/' + iId);
    }
}