<template>
    <div class="container h-14 mx-auto pt-4 pr-2 w-2/3">
        <div class="w-full flex flex-row">
            <div class="w-1/2">
                <button :class="{'activeNavItem' : getIsActive('home'), 'navItem' : !getIsActive('home') }" @click="redirectPage('/')"> HOME </button>
            </div>
            <div class="flex flex-row-reverse w-1/2 gap-4">
                <button class="navItem" @click="logout"> Logout </button>
                <div class="font-normal text-white p-1 text-xl">|</div>
                <button class="navItem">{{ sUserFullName }}</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'NavBar',
        data() {
            return {
            }
        },
        computed : {
            /**
             * sUserFullName
             * @return string
             */
            sUserFullName() {
                return sessionStorage.getItem('full_name');
            }
        },
        methods : {
            /**
             * Remove session and redirect to login page
             */
            logout() {
                location.replace('/api/user/logout');
            },
            /**
             * get current active route
             * @param { string } sRouteName
             * @return boolean
             */
            getIsActive(sRouteName) {
                return (this.$router.currentRoute.name === sRouteName);
            },
            /**
             * redirectPage
             * @param { string } sPath
             */
            redirectPage(sPath) {
                if (this.$router.currentRoute.path !== sPath) {
                    this.$router.push({ path : '/' });
                }
            }
        }
    }
</script>

<style scoped>
    .navItem {
        @apply text-xl font-normal text-white p-1 hover:underline hover:underline-offset-4;
    }

    .activeNavItem {
        @apply text-xl font-bold text-white p-1 underline underline-offset-4;
    }
</style>