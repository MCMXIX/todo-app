<template>
    <div class="container mx-auto w-3/5">
        <div class="flex flex-row-reverse mt-20 mb-2">
            <button class="bg-green-600 text-cyan-900 p-2 text-lg font-medium" @click="addNewTask()">ADD TASK <i class="fa-solid fa-circle-plus"></i></button>
            <input v-model.trim="sNewTask" class="mr-1 p-1 font-medium text-cyan-900" type="text">
        </div>
        <div class="flex flex-row justify-around p-5 bg-yellow-200 drop-shadow-lg">
            <button :class="[{ 'activeTab' : (sStatus === 'T') }, 'taskTabItem']" @click="getList('T')">TO-DO</button>
            <button :class="[{ 'activeTab' : (sStatus === 'I') }, 'taskTabItem']" @click="getList('I')">IN PROGRESS</button>
            <button :class="[{ 'activeTab' : (sStatus === 'D') }, 'taskTabItem']" @click="getList('D')">DONE</button>
        </div>
        <div class="flex flex-col my-5 px-40">
            <task-card 
                v-for="(oTask, iKey) in aTodoList"
                class="mt-3"
                :key="iKey"
                :oTask="oTask"
                @retrieveList="getList(sStatus)"
            />
            <div v-if="(aTodoList.length < 1)" class="text-center text-white">
                <h1 class="text-2xl font-bold">No task available as of the moment.</h1>    
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import TaskCard from '../components/TaskCard.vue';

    export default {
        name: 'home',
        components : {
            TaskCard
        },
        data() {
            return {
                sStatus : 'I',
                bIsProcessing : false,
                sNewTask : ''
            }
        },
        computed : {
            ...mapGetters('oTodo', ['aTodoList'])
        },
        mounted() {
            this.getTodoList({ status : this.sStatus });
        },
        methods : {
            ...mapActions('oTodo', ['getTodoList', 'createTodo']),

            /**
             * getList
             * @param { string } sStatus
             */
            async getList(sStatus) {
                this.sStatus = sStatus;
                if (this.bIsProcessing === false) {
                this.bIsProcessing = true;
                    await this.getTodoList({ status : this.sStatus });
                    this.bIsProcessing = false;
                }
            },

            /**
             * addNewTask
             */
            async addNewTask() {
                if (this.sNewTask !== '' && this.bIsProcessing === false) {
                    this.bIsProcessing = true;
                    await this.createTodo({ task : this.sNewTask });
                    this.bIsProcessing = false;
                    this.sNewTask = '';
                    
                    this.getList(this.sStatus);
                }
            }
        }
    }
</script>

<style scoped>
    .taskTabItem {
        @apply text-2xl font-medium text-cyan-900 hover:underline hover:underline-offset-4;
    }

    .activeTab {
        @apply font-bold underline underline-offset-4;
    }
</style>