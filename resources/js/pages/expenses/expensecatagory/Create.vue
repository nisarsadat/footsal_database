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
                        <v-text-field
                            v-model="formData.name"
                            variant="outlined"
                            :rules="[rules.required, rules.counter]"
                            label="Category Name *"
                            class="pb-4"
                            density="compact"
                        ></v-text-field>
                        <!-- <v-textarea
                            v-model="formData.details"
                            variant="outlined"
                            label="Description"
                        ></v-textarea> -->
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
const formRef = ref(null);
const formData = reactive({
    name: "",
});

const emit = defineEmits(["closePopup"]);

const closePopup = () => {
    emit("closePopup");
};

const CreateCategory = async (formData) => {
    const config = {
        method: "POST",
        url: "expenseCatagories",
        data: formData,
    };
    const response = await axios(config);
    toast.success("Expense Succesfully Created", {
        autoClose: 1000,
    });
    // this.router.push("/allExpenses");
    // this.fetchExpenses({
    //     page: this.page,
    //     itemsPerPage: this.itemsPerPage,
    // });
    // Toastify({
    //     text: "Deleted successfully!",
    //     duration: 4000,
    //     close: true,
    //     backgroundColor: "linear-gradient(to right, #F31A1A)",
    //     className: "info",
    //     stopOnFocus: true, // Prevents dismissing of toast on hover
    // }).showToast();
};
function createCategory() {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            CreateCategory(formData);
            closePopup();
        }
    });
};

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
