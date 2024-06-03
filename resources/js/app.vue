<template>
    <v-layout class="rounded rounded-md">
        <v-navigation-drawer>
            <Menu />
        </v-navigation-drawer>

        <v-app-bar title=""><bar /></v-app-bar>

        <v-main class="d-flex align-center justify-center main-content">
            <div class="main-content"><router-view />   </div>
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
.main-content {
    width: 85%;
    height: 100%;
    margin: 20px;
}




</style>
