<template>
    <div class="h-full max-h-ful">
        <nav-bar />
        <router-view />
    </div>
</template>

<script>
    import NavBar from './components/NavBar.vue';

    export default {
        name: 'dashboard',
        components : {
            NavBar
        },
        data() {
            return {
            }
        }
    }
</script>