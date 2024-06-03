<template>
    <div class="boxShadow">
        <div
            class="d-flex pb-6 text-3xl font-semibold leading-snug font-serif margin"
            flat
        >
            <v-card-text class="alph"
                >||<strong class="book"
                    ><span class="mdi mdi-account-tie"></span> 0WENER PICK
                    UP</strong
                ></v-card-text
            >
            <owenerpopup />
        </div>
        <div class="margin">
            <owenerpickuptable />
        </div>
    </div>
</template>
<script>
import owenerpickuptable from "./owenerpickuptable.vue";
import owenerpopup from "./owenerpopup.vue";
export default {
    components: {
        owenerpickuptable,
        owenerpopup,
    },
};
</script>
<style>
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
</style>
