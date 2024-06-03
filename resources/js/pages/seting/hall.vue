<template>
    <div class="boxShadow">
        <div
            class="d-flex pb-6 text-3xl font-semibold leading-snug font-serif margin"
            flat
        >
            <v-card-text class="alph">
                ||<strong class="book"
                    ><span class="mdi mdi-town-hall"></span> HALL</strong
                >
            </v-card-text>
        </div>
        <form @submit.prevent="submit" class="w-full margin ">
            <v-text-field
                v-model="name.value.value"
                :counter="10"
                :error-messages="name.errorMessage.value"
                label="Name"
                density="compact"
                variant="outlined"
            ></v-text-field>
            <v-text-field
                v-model="amount.value.value"
                :counter="7"
                :error-messages="amount.errorMessage.value"
                label="Size"
                type="number"
                variant="outlined"
            ></v-text-field>
            <v-btn class="me-4" type="submit">Submit</v-btn>
            <v-btn @click="resetForm">Clear</v-btn>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useField, useForm } from "vee-validate";

const { handleSubmit } = useForm({
    validationSchema: {
        name(value) {
            if (value?.length >= 2) return true;
            return "Name needs to be at least 2 characters.";
        },
        amount(value) {
            if (/^\d+$/.test(value)) return true;
            return "Amount needs to be a valid number.";
        },
    },
});

const name = useField("name");
const amount = useField("amount");

const submit = handleSubmit((values) => {
    alert(JSON.stringify(values, null, 2));
});

const resetForm = () => {
    name.value.value = "";
    amount.value.value = "";
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
