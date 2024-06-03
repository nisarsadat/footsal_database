<template>
    <v-dialog v-model="dialog" max-width="600">
        <v-card>
            <div class="">
                <div class="d-flex pb-6 text-3xl font-semibold leading-snug font-serif margin" flat>
                    <v-card-text class="alph">
                        ||<strong class="book"><span class="mdi mdi-book-plus"></span> BOOKING</strong>
                    </v-card-text>
                </div>
                <form @submit.prevent="submit" class="w-full margin">
                    <v-text-field
                        v-model="name"
                        :counter="10"
                        :error-messages="nameErrorMessage"
                        label="Name"
                        density="compact"
                        variant="outlined"
                    ></v-text-field>

                    <v-text-field
                        v-model="phone"
                        :counter="7"
                        :error-messages="phoneErrorMessage"
                        label="Phone Number"
                        variant="outlined"
                        type="number"
                    ></v-text-field>

                    <v-btn class="me-4" type="submit">Submit</v-btn>
                    <v-btn @click="handleReset">Clear</v-btn>
                </form>
            </div>
            <v-card-actions class="margin">
                <v-spacer></v-spacer>
                <v-btn class="hoverred  mdi mdi-close-circle-outline text-10xl"  text @click="closeDialog" >Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import { useField, useForm } from 'vee-validate';

export default {
    name: 'BookingPopup',
    data() {
        return {
            dialog: false,
        };
    },
    methods: {
        closeDialog() {
            this.dialog = false;
        },
        openDialog() {
            this.dialog = true;
        },
    },
    setup() {
        const { handleSubmit, handleReset } = useForm({
            validationSchema: {
                name(value) {
                    if (value?.length >= 2) return true;
                    return 'Name needs to be at least 2 characters.';
                },
                phone(value) {
                    if (value?.length >= 9 && /[0-9-]+/.test(value)) return true;
                    return 'Phone number needs to be at least 9 digits.';
                },
            },
        });

        const nameField = useField('name');
        const phoneField = useField('phone');

        const name = nameField.value;
        const nameErrorMessage = nameField.errorMessage;

        const phone = phoneField.value;
        const phoneErrorMessage = phoneField.errorMessage;

        const submit = handleSubmit((values) => {
            alert(JSON.stringify(values, null, 2));
        });

        return { name, nameErrorMessage, phone, phoneErrorMessage, submit, handleReset };
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
.hoverred:hover
{
    color: rgb(225, 0, 0);
}




</style>
