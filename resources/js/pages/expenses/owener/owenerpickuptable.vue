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
                            v-model="formData.ownerId"
                            clearable
                            variant="outlined"
                            label="Owner Name*"
                            density="compact"
                            :items="ownerPickupsId"
                            item-title="name"
                            item-value="id"
                            :rules="[rules.required]"
                            :return-object="false"
                        ></v-autocomplete>
                        <v-text-field
                            v-model="formData.amount"
                            variant="outlined"
                            density="compact"
                            label="Amount *"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-textarea
                            v-model="formData.note"
                            variant="outlined"
                            density="compact"
                            label="Description *"
                            class="pb-4"
                            type="string"
                        ></v-textarea>
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
                    <v-btn
                        color="light-blue-darken-1"
                        @click="createOwnerPickups"
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

const emit = defineEmits(["closePopup"]);

const closePopup = () => {
    emit("closePopup");
};

const formRef = ref(null);
let ownerPickupsId = reactive([]);
const formData = reactive({
    ownerId: "",
    note: "",
    amount: "",
    date: "",
});
const FetchOwnerPickupsId = async () => {
    const response = await axios.get(`owners`);
    ownerPickupsId = response.data.data;
};
FetchOwnerPickupsId();

const CreateownerPickups = async (formData) => {
    console.log(formData);
    // Adding a custom header to the Axios request
    // setContentType("application/json");
    const config = {
        method: "POST",
        url: "ownerPickups",

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
                text: "Added OwnerPickUp successfully!",
                duration: 4000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor:
                    "linear-gradient(to right, #F31A1A)",
                className: "info",
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background:
                        "linear-gradient(to right, #F31A1A)",
                    color: "black",
                    fontSize: "16px",
                    borderRadius: "8px",
                    boxShadow: "0 4px 8px rgba(0, 0, 0, 0.1)",
                    border: "1px solid #ffffff50",
                },
            }).showToast();
};







const createOwnerPickups = async () => {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            CreateownerPickups(formData);
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
