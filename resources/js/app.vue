<template>
    <v-layout class="rounded rounded-md side">
        <v-navigation-drawer class="borderright side">
            <Menu />
        </v-navigation-drawer>

        <!-- <v-app-bar title=""><bar /></v-app-bar> -->

        <v-main class="scroll_jna">
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
.borderright
{
    border-right: none !important;
}
.side {
    background-color: #f6f4f4;
}


.scroll_jna {
    height: 100vh ;
    overflow-y: auto;
}
.scroll_jna::-webkit-scrollbar {
    width: 4px;
}

.scroll_jna::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.scroll_jna::-webkit-scrollbar-thumb {
    background: #b1b1b1;
    border-radius: 4px;
}

.scroll_jna::-webkit-scrollbar-thumb:hover {
    background: #a6a5a5;
}
/* ======== */
/* Add smooth transition effect */
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(-10px);
    opacity: 1;
}

</style>
