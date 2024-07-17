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
                            v-model="formData.hallId"
                            clearable
                            variant="outlined"
                            label="Hall Name*"
                            density="compact"
                            :items="Halls"
                            :return--object="false"
                            item-title="name"
                            item-value="id"
                            :rules="[rules.required]"
                            :return-object="false"
                        ></v-autocomplete>
                        <v-autocomplete
                            v-model="formData.customerId"
                            clearable
                            variant="outlined"
                            label="Customer Id*"
                            density="compact"
                            :items="Customers"
                            :return--object="false"
                            item-title="name"
                            item-value="id"
                            :rules="[rules.required]"
                            :return-object="false"
                        ></v-autocomplete>
                        <v-text-field
                            v-model="formData.bookingName"
                            variant="outlined"
                            density="compact"
                            label="Booking Name*"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.payed"
                            variant="outlined"
                            density="compact"
                            label="Payed *"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.from"
                            variant="outlined"
                            density="compact"
                            label="FROM *"
                            type="time"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.to"
                            variant="outlined"
                            density="compact"
                            label="TO*"
                            type="time"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.price"
                            variant="outlined"
                            density="compact"
                            label="Price*"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.discount"
                            variant="outlined"
                            density="compact"
                            label="Discount*"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.stuffsRent"
                            variant="outlined"
                            density="compact"
                            label="STUFF RENT*"
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
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
let dailog = defineProps("dailog");
import { reactive, ref } from "vue";
import { defineEmits } from "vue";
import axios from "axios";

const emit = defineEmits(["closePopup"]);

const closePopup = () => {
    emit("closePopup");
};

const formRef = ref(null);
let Halls = reactive([]);
let Customers = reactive([]);

const formData = reactive({
    hallId: "",
    customerId: "",
    bookingName: "",
    price: "",
    date: "",
    from: "",
    to: "",
    discount: "",
    stuffsRent: "",
    payed:"",
});
const FetchHalls = async () => {
    const response = await axios.get(`halls`);
    Halls = response.data.data;
};
FetchHalls();

const FetchCustomers = async () => {
    const response = await axios.get(`customers`);
    Customers = response.data.data;
};
FetchCustomers();

const CreateExpense = async (formData) => {
    console.log(formData);
    // Adding a custom header to the Axios request
    // setContentType("application/json");
    const config = {
        method: "POST",
        url: "bookings",

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
    Toastify({
                text: "Customer Added successfully!",
                duration: 3000,
                close: true,
                backgroundColor:
                    "linear-gradient(to right, #F31A1A)",
                className: "info",
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();
};

const createCategory = async () => {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            CreateExpense(formData);
            closePopup();
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
