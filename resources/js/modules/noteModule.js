import oNoteService from '../services/noteService';

const actions = {
    /**
     * updateNote
     * @param object commit
     * @param { object } oParam
     */
     async updateNote({ commit }, oParam) {
        await oNoteService.updateNote(oParam)
            .catch((oError) => {
                alert(oError.response.data.message);
            });
    },

    /**
     * deleteNote
     * @param object commit
     * @param { int } iId 
     */
     async deleteNote({ commit }, iId) {
        await oNoteService.deleteNote(iId)
            .then(oResponse => {
                alert(oResponse.data.message);
            })
            .catch((oError) => {
                alert(oError.response.data.message);
            });
    },

    /**
     * createNote
     * @param object commit
     * @param { object } oParam
     */
     async createNote({ commit }, oParam) {
        await oNoteService.createNote(oParam)
            .then(oResponse => {
                alert(oResponse.data.message);
            })
            .catch((oError) => {
                alert(oError.response.data.message);
            });
    }
}

export default {
    actions,
    namespaced: true
}