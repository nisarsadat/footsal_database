<template>
    <v-layout class="rounded rounded-md">
        <v-navigation-drawer>
            <Menu />
        </v-navigation-drawer>

        <!-- <v-app-bar title=""><bar /></v-app-bar> -->

        <v-main>
            <router-view />  
        </v-main>
    </v-layout>
</template>
<script>
import Menu from "./components/menu.vue";
import bar from "./components/bar.vue";

export default {
    components: {
        Menu,
        bar,
    },
};
</script>


<style>





</style>
