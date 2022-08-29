<template>
    <div class="h-screen bg-cyan-900">
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