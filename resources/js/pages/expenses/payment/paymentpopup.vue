<template>
    <v-dialog transition="dialog-top-transition" width="600px" v-model="dailog">
        <template v-slot:default="{ isActive }">
            <v-card class="px-3">
                <v-card-title class="px-6 py-4 d-flex justify-space-between">
                    <h2>Create</h2>

                    <v-btn variant="text" @click="closePopup"
                        ><v-icon> mdi-close </v-icon></v-btn
                    >
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-form ref="formRef">
                        <v-autocomplete
                            v-model="formData.bookingId"
                            clearable
                            variant="outlined"
                            label="name*"
                            density="compact"
                            :items="Bookings"
                            :return--object="false"
                            item-title="id"
                            item-value="name"
                            :rules="[rules.required]"
                            :return-object="false"
                        ></v-autocomplete>
                        <v-text-field
                            v-model="formData.payed"
                            variant="outlined"
                            density="compact"
                            label="Amount *"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.date"
                            variant="outlined"
                            density="compact"
                            label="Date *"
                            type="date"
                            class="pb-4"
                        ></v-text-field>
                    </v-form>
                </v-card-text>
                <div class="justify-start pl-6 pb-6">
                    <v-btn color="light-blue-darken-1" @click="createCategory"
                        >Submit</v-btn
                    >
                </div>
            </v-card>
        </template>
    </v-dialog>
</template>
<script setup>
let dailog = defineProps("dailog");
import { reactive, ref } from "vue";
import { defineEmits } from "vue";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

const emit = defineEmits(["closePopup"]);

const closePopup = () => {
    emit("closePopup");
};

const formRef = ref(null);
let Bookings = reactive([]);
const formData = reactive({
    paymentId: "",
    bookingId: "",
    payed: "",
    date: "",
});
const FetchBookings = async () => {
    const response = await axios.get(`bookings`);
    Bookings = response.data.data;
};
FetchBookings();

const CreateExpense = async (formData) => {
    console.log(formData);
    // Adding a custom header to the Axios request
    // setContentType("application/json");
    const config = {
        method: "POST",
        url: "payments",

        data: formData,
    };

    // Using Axios to make a GET request with async/await and custom headers
    const response = await axios(config);
    // toast.success("Expense Succesfully Created", {
    //     autoClose: 1000,
    // });
    // this.router.push("/allExpenses");
    // this.fetchExpenses({
    //     page: this.page,
    //     itemsPerPage: this.itemsPerPage,
    // });

};

const createCategory = async () => {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            CreateExpense(formData);
            closePopup();
            Toastify({
                text: "Deleted successfully!",
                duration: 4000,
                close: true,
                backgroundColor:
                    "linear-gradient(to right, #F31A1A)",
                className: "info",
                stopOnFocus: true, // Prevents dismissing of toast on hover

            }).showToast();
        }
    });
};

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};

// const closePopup=()=>{
//     this.$emit('closePopup');
// }
</script>
