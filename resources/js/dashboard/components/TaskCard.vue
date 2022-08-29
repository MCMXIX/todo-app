<template>
    <div>
        <div class="flex flex-col border-2 px-4 pt-4 pb-2 text-white bg-teal-600">
            <div class="flex flex-row text-center">
                <div v-if="(bModifyTask === false)" class="text-2xl font-bold">{{ oTask.task }}</div>
                <input v-else v-model="oTask.task" type="text" class="p-1 text-teal-600 font-medium w-5/6">
                <div class="flex flex-row ml-auto gap-2">
                    <!-- UPDATE BUTTON !-->
                    <button v-if="(bModifyTask === false)" 
                        class="text-lg font-medium text-cyan-900" 
                        @click="(bModifyTask = true)"
                    >
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>

                    <!-- SAVE BUTTON !-->
                    <button v-else class="text-lg text-green-400 font-medium" @click="updateTodoTask"><i class="fa-solid fa-floppy-disk"></i></button>

                    <!-- DELETE BUTTON !-->
                    <button class="text-lg text-red-700 font-medium" @click="deleteTask"><i class="fa-solid fa-trash-can"></i></button>
                </div>
            </div>
            <div class="flex flex-col m-10">
                <div class="flex flex-row">
                    <h1 class="text-left font-medium mr-auto">Additional Notes:</h1>
                    <div class="flex flex-row-reverse ml-auto">
                        <button v-if="(bDisplayAddNotefield === false)" 
                            class="text-cyan-900 p-1 font-medium" 
                            @click="this.toggleAddNoteField"
                        >
                            <i class="fa-solid fa-circle-plus"></i>
                        </button>
                        <button v-else class="bg-white text-cyan-900 p-1 font-medium" @click="createNewNote"><i class="fa-solid fa-circle-plus"></i></button>
                        <input v-if="(bDisplayAddNotefield === true)" 
                            v-model.trim="sNewTaskNote"
                            placeholder="Add notes for the task" 
                            class="p-1 font-medium text-cyan-900" 
                            type="text"
                        >
                    </div>
                </div>
                <template v-if="(oTask.notes.length > 0)"> 
                    <div v-for="(oNote, iKey) in oTask.notes" :key="iKey" class="mx-auto mt-5 w-3/5">
                        <div class="flex flex-col justify-center">
                            <div class="flex flex-row">
                                <div class="font-bold text-lg text-center text-cyan-900 w-full">{{ oNote.note }}</div>
                                <div class="flex flex-row ml-auto gap-2">
                                    <!-- DELETE BUTTON !-->
                                    <button class="text-lg text-red-700 font-medium" @click="deleteTodoNote(oNote.id)"><i class="fa-solid fa-trash-can"></i></button>
                                </div>    
                            </div>
                            <div class="flex flex-row justify-center gap-3">
                                <div style="cursor:pointer;" 
                                    :class="[{ 'done-status' : (oNote.status === 'R') }, 'p2 font-medium']"
                                    @click="updateTodoNoteStatus(oNote.id, 'R')"
                                >
                                    RESOLVED
                                </div>
                                <div style="cursor:pointer;" 
                                    :class="[{ 'in-progress-status' : (oNote.status === 'I') }, 'p2 font-medium']"
                                    @click="updateTodoNoteStatus(oNote.id, 'I')"
                                >
                                    IN-PROGRESS
                                </div>
                                <div style="cursor:pointer;" 
                                    :class="[{ 'todo-status' : (oNote.status === 'N') }, 'p2 font-medium']" 
                                    @click="updateTodoNoteStatus(oNote.id, 'N')"
                                >
                                    NOTE
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="flex flex-row justify-between mt-7">
                <div class="font-medium">Created at: {{ oTask.created_at | formatDate }} </div>
                <div class="flex flex-row justify-center gap-3">
                    <div style="cursor:pointer;" 
                        :class="[{ 'todo-status' : (oTask.status === 'T') }, 'p2 font-medium']" 
                        @click="updateTodoStatus('T')"
                    >
                        TODO
                    </div>
                    <div style="cursor:pointer;" 
                        :class="[{ 'in-progress-status' : (oTask.status === 'I') }, 'p2 font-medium']" 
                        @click="updateTodoStatus('I')"
                    >
                        IN-PROGRESS
                    </div>
                    <div style="cursor:pointer;" 
                        :class="[{ 'done-status' : (oTask.status === 'D') }, 'p2 font-medium']" 
                        @click="updateTodoStatus('D')"
                    >
                        DONE
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions }  from 'vuex';

    export default {
        name: 'TaskCard',
        props : {
            oTask : {
                required : true,
                type : Object,
                default : {}
            }
        },
        filters : {
            formatDate(sDate) {
                return new Date(sDate).toISOString().slice(0, 10);
            }
        },
        data() {
            return {
                oUpdatedData : {},
                bModifyTask : false,
                sNewTaskNote : '',
                bDisplayAddNotefield : false
            }
        },
        methods : {
            ...mapActions('oTodo', ['updateTodo', 'deleteTodo']),
            ...mapActions('oNote', ['updateNote', 'deleteNote', 'createNote']),

            /**
             * updateTodoData
             */
            async updateTodoData() {
                await this.updateTodo({ id : this.oTask.id, updated_data : this.oUpdatedData });
                this.oUpdatedData = {};
            },

            /**
             * updateTodoStatus
             * @param { string } sStatus
             */
            updateTodoStatus(sStatus) {
                if (this.oTask.status !== sStatus) {
                    this.oUpdatedData.status = sStatus;
                    this.updateTodoData();
                    this.$emit('retrieveList');
                }
            },

            /**
             * updateTodoTask
             */
            async updateTodoTask() {
                this.oUpdatedData.task = this.oTask.task;
                await this.updateTodoData();
                this.bModifyTask = false;
            },

            /**
             * deleteTask
             */
            async deleteTask() {
                await this.deleteTodo(this.oTask.id);
                this.$emit('retrieveList');
            },

            /**
             * updateTodoNoteStatus
             * @param { int } iId
             * @param { string } sStatus
             */
            async updateTodoNoteStatus(iId, sStatus) {
                await this.updateNote({ id : iId, updated_data : { status : sStatus } });
                this.$emit('retrieveList');
            },

            /**
             * deleteTodoNote
             */
            async deleteTodoNote(iId) {
                await this.deleteNote(iId);
                this.$emit('retrieveList');
            },

            /**
             * createNewNote
             */
            async createNewNote() {
                if (this.sNewTaskNote !== '') {
                    await this.createNote({ todo_id : this.oTask.id, note : this.sNewTaskNote });
                    this.$emit('retrieveList');
                    this.sNewTaskNote = '';
                }

                this.toggleAddNoteField();
            },

            /**
             * toggleAddNoteField
             */
            toggleAddNoteField() {
                this.bDisplayAddNotefield = !this.bDisplayAddNotefield;
            }
        }
    }
</script>

<style scoped>
    .in-progress-status {
        @apply font-bold text-green-400;
    }

    .done-status {
        @apply font-bold text-blue-400;
    }

    .todo-status {
        @apply font-bold text-gray-400;
    }
</style>