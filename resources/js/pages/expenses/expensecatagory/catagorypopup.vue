<template>
    <div class="text-center pa-4">
        <v-dialog v-model="dialog" max-width="600" persistent>
            <template v-slot:activator="{ props: activatorProps }" >
                <v-btn v-bind="activatorProps" class="green"><span class="mdi mdi-plus "></span> Create</v-btn>
            </template>

            <v-card class="boxShadow">
                <v-card-title>
                    <span class="headline"><strong >||<span class="mdi mdi-expansion-card"></span>    Expense Catagory</strong></span>
                </v-card-title>
                <v-card-text>
                    <form @submit.prevent="submit" class="margin">
                        <v-text-field
                            :counter="10"
                            :error-messages="name.errorMessage"
                            label="Name"
                            variant="outlined"
                        ></v-text-field>
                        <v-textarea
                            :error-messages="noteErrorMessage"
                            label="Note"
                            variant="outlined"
                        ></v-textarea>
                        <v-checkbox
                            v-model="checkbox.value"
                            :error-messages="checkbox.errorMessage"
                            label="Option"
                            value="1"
                        ></v-checkbox>

                        <v-btn class="me-4" type="submit" >Submit</v-btn>
                        <v-btn @click="resetForm">Clear</v-btn>
                    </form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="dialog = false"><strong>Cancel</strong></v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm, useField } from "vee-validate";
import * as yup from "yup";

const dialog = ref(false);

const schema = yup.object({
    name: yup
        .string()
        .min(2, "Name needs to be at least 2 characters.")
        .required("Name is required."),
    note: yup
        .string()
        .min(10, "Note needs to be at least 10 characters.")
        .required("Note is required."),
    checkbox: yup
        .boolean()
        .oneOf([true], "Must be checked.")
        .required("Checkbox is required."),
});

const { handleSubmit } = useForm({
    validationSchema: schema,
});

const name = useField("name");
const note = useField("note");
const checkbox = useField("checkbox");

const noteErrorMessage = ref("");

const submit = handleSubmit((values) => {
    alert(JSON.stringify(values, null, 2));
});

const resetForm = () => {
    name.value = "";
    note.value = "";
    checkbox.value = false;
};
</script>

<style>
.boxShadow {
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    padding: 20px;
    margin: 20px;
}
.margin {
    width: 90%;
    height: 90%;
    margin: 0 auto;
}
.green
{
    background-color: rgb(11, 155, 11);
}
</style>
