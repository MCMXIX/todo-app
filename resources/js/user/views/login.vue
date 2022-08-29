<template>
    <div class="m-auto rounded bg-cyan-900 drop-shadow-lg w-1/2 h-1/2">
        <div class="flex flex-col text-center text-gray-100 p-5">
            <h1 class="text-4xl font-bold"> LOGIN </h1>
            <div class="pt-10">
                <label class="block font-bold"> USERNAME </label>
                <input v-model.trim="sUsername" 
                    type="text" 
                    :class="[{ 'invalidField' : bErrorUsername }, 'input']" 
                    autocomplete="false"
                    @keypress.enter="doLogin"
                >
            </div>
            <div class="pt-10">
                <label class="block font-bold"> PASSWORD </label>
                <input v-model.trim="sPassword" 
                    type="password" 
                    :class="[{ 'invalidField' : bErrorPassword }, 'input']" 
                    autocomplete="false"
                    @keypress.enter="doLogin"
                >
            </div>
            <div class="flex flex-col pt-10">
                <button class="w-28 text-center rounded h-10 mx-auto bg-slate-400 text-black hover:font-bold border-2 border-white" @click="doLogin">Login</button>
                <p class="text-1 pt-5">
                    Create account <span @click="$router.push({ path : '/register' })" class="font-bold hover:italic" style="cursor:pointer;">here</span>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        name: 'login',
        data() {
            return {
                sUsername : '',
                sPassword : '',
                bIsProcessing : false,
                bErrorUsername : false,
                bErrorPassword : false
            }
        },
        computed : {
            /**
             * bIsFieldInValid
             * check if fields is valid
             * @return boolean
             */
            bIsFieldInValid() {
                return (this.bErrorUsername === true || this.bErrorPassword === true);
            }
        },
        watch : {
            /**
             * sUsername
             */
            sUsername() {
                if (this.sUsername !== '') {
                    this.bErrorUsername = false;
                } else {
                    this.bErrorUsername = true;
                }
            },

            /**
             * sPassowrd
             */
            sPassword() {
                if (this.sPassword !== '') {
                    this.bErrorPassword = false;
                } else {
                    this.bErrorPassword = true;
                }
            }
        },
        methods : {
            ...mapActions('oUser', ['login']),

            /**
             * Perform user login and validation
             */
            async doLogin() {
                this.validateFields();
                if (this.bIsFieldInValid === false && this.bIsProcessing === false) {
                    this.bIsProcessing = true;
                    await this.login({ username : this.sUsername, password : this.sPassword });
                    this.bIsProcessing = false;
                }
            },

            /**
             * validateFields
             * validate the input fields before submittin
             */
            validateFields() {
                if (this.sUsername === '') {
                    this.bErrorUsername = true;
                }

                if (this.sPassword === '') {
                    this.bErrorPassword = true;
                }
            }
        }
    }
</script>