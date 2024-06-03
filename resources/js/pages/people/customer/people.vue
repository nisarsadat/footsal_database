<template>
    <div class="boxShadow">
        <div
            class="d-flex pb-6 text-3xl font-semibold leading-snug font-serif margin"
            flat
        >
        <v-card-text class="alph">||<strong class="book">   Customer</strong></v-card-text>

            <v-btn
                prepend-icon="mdi-plus"
                variant="tonal"
                class="mt-6 BGGREEN"
                @click="openDialog"
                >create</v-btn
            >

        </div>
        <people-popup ref="PeoplePopup"></people-popup>


        <!-- Popup Dialog Component -->

        <peopletable />
    </div>
</template>

<script>
import PeoplePopup from './peoplepopup.vue';
import peopletable from './peopletable.vue';
export default {
    components: {
        PeoplePopup,
        peopletable,
    },
    methods: {
        openDialog() {
            this.$refs.PeoplePopup.openDialog();
        },
    },
};
</script>

<style scoped>
.book {
    font-size: 18px;
    font-weight: bolder;
    letter-spacing: 12px;
    line-height: 3;
}
.alph {
    font-size: 18px;
    font-weight: bolder;
    line-height: 3;
}
.boxShadow {
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    width: 100%;
    height: 100%;
    padding-bottom: 20px;
    margin-top: 30px;
}
.margin {
    width: 90%;
    height: 90%;
    margin: 0 auto;
}
.BGGREEN {
    background-color: rgb(31, 228, 77);
}
</style>
