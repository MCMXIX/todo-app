<template>
    <div class="m-auto rounded bg-cyan-900 drop-shadow-lg w-1/2">
        <div class="flex flex-col text-center text-gray-100 p-5">
            <h1 class="text-4xl font-bold"> Registration </h1>
            <div class="pt-10">
                <label class="block font-bold"> FIRST NAME </label>
                <input v-model.trim="oUserInfo.first_name" 
                    type="text" 
                    autocomplete="false"
                    :class="[{ 'invalidField' : aErrorFields.includes('first_name') }, 'input']" 
                >
            </div>
            <div class="pt-10">
                <label class="block font-bold"> LAST NAME </label>
                <input v-model.trim="oUserInfo.last_name" 
                    type="text" 
                    autocomplete="false"
                    :class="[{ 'invalidField' : aErrorFields.includes('last_name') }, 'input']" 
                >
            </div>
            <div class="pt-10">
                <label class="block font-bold"> USERNAME </label>
                <input v-model.trim="oUserInfo.username" 
                    type="text" 
                    autocomplete="false"
                    :class="[{ 'invalidField' : aErrorFields.includes('username') }, 'input']" 
                >
            </div>
            <div class="pt-10">
                <label class="block font-bold"> PASSWORD </label>
                <input v-model.trim="oUserInfo.password" 
                    type="password" 
                    autocomplete="false"
                    :class="[{ 'invalidField' : aErrorFields.includes('password') }, 'input']" 
                >
            </div>
            <div class="flex flex-col pt-10">
                <button class="w-28 text-center rounded h-10 mx-auto bg-slate-400 text-black hover:font-bold border-2 border-white">SUBMIT</button>
            </div>
        </div>
    </div>
</template>
<script>
    import { mapActions, mapGetters } from 'vuex';

    export default {
        name: 'CreateUser',
        data() {
            return {
                bIsProcessing : false,
                aErrorFields : []
            }
        },
        computed : {
            ...mapGetters('oUser', ['oUserInfo'])
        },
        mounted() {
            this.getUserInfo();
        },
        methods : {
            ...mapActions('oUser', ['getUserInfo']),

            /**
             * validate fields if empty
             */
            validateFields() {
                this.aErrorFields = [];
                for (let sKey in this.oUserInfo) {
                    if (this.oUserInfo[sKey] === '') {
                        this.aErrorFields.push(sKey);
                    }
                }
            }
        }
    }
</script>