<template>
    <div class="boxShadow">
        <div
            class="d-flex pb-6 text-3xl font-semibold leading-snug font-serif margin"
            flat
        >
            <v-card-text class="alph"
                >||<strong class="book">
                    <span class="mdi mdi-stadium"></span>
                    GEMNASYOM</strong
                ></v-card-text
            >
        </div>
        <form @submit.prevent="submit" class="margin">
            <v-text-field
                v-model="name.value.value"
                :counter="10"
                :error-messages="name.errorMessage.value"
                label="Name"
                variant="outlined"
            ></v-text-field>
            <v-textarea
                v-model="note"
                :error-messages="noteErrorMessage"
                label="Note"
                variant="outlined"
            ></v-textarea>
            <v-checkbox
                v-model="checkbox.value.value"
                :error-messages="checkbox.errorMessage.value"
                label="Option"
                value="1"
            ></v-checkbox>

            <v-btn class="me-4" type="submit">Submit</v-btn>
            <v-btn @click="resetForm">Clear</v-btn>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm, useField } from "vee-validate";

const { handleSubmit } = useForm({
    validationSchema: {
        name(value) {
            if (value?.length >= 2) return true;
            return "Name needs to be at least 2 characters.";
        },
        note(value) {
            if (value?.length >= 10) return true;
            return "Note needs to be at least 10 characters.";
        },
        checkbox(value) {
            if (value === "1") return true;
            return "Must be checked.";
        },
    },
});

const name = useField("name");
const note = ref("");
const checkbox = useField("checkbox");

const noteErrorMessage = ref("");

const submit = handleSubmit((values) => {
    alert(JSON.stringify(values, null, 2));
});

const resetForm = () => {
    name.value.value = "";
    note.value = "";
    checkbox.value.value = false;
};
</script>
<style>
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
