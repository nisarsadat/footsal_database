<template>
    <div class="relative sm:rounded-lg mt-20 p-12">
        <Header mainTitle="Expenses" subTitle="Create Expense" />

        <v-form ref="formRef">
            <v-autocomplete
                v-model="formData.expenseCatagoryId"
                clearable
                variant="outlined"
                label="Expense Category*"
                density="compact"
                :items="expenseCategories"
                item-title="name"
                item-value="id"
                :rules="[rules.required]"
                :return-object="false"
            ></v-autocomplete>

            <v-text-field
                v-model="formData.amount"
                label="Amount *"
                :rules="rules.required"
                required
                type="number"
                variant="outlined"
                density="compact"
                class="pb-4"
                clearable
            ></v-text-field>

            <v-text-field
                v-model="formData.date"
                label="Date *"
                :rules="rules.required"
                required
                type="date"
                variant="outlined"
                density="compact"
                class="pb-4"
                clearable
            ></v-text-field>

            <v-textarea
                v-model="formData.note"
                label="Note *"
                :rules="rules.required"
                required
                variant="outlined"
                density="compact"
                class="pb-4"
                clearable
            ></v-textarea>

            <v-btn class="me-4" @click="createCategory">Submit</v-btn>
            <v-btn @click="clear">Clear</v-btn>
        </v-form>
    </div>
</template>
<script setup>
import Header from "../../components/Header.vue";
import { ref, reactive } from "vue";
import axios from "axios";

let expenseCategories = reactive([]);

const formRef = ref(null);
const formData = reactive({
    expenseCatagoryId: "",
    amount: "",
    date: "",
    note: "",
});

const rules = {
    required: [(value) => !!value || "This field is required"],
    name: [
        (v) => !!v || "Name is required",
        (v) => (v && v.length >= 3) || "Name must be at least 3 characters",
    ],
};

function clear() {
    if (formRef.value) {
        formRef.value.resetValidation();
    }
    Object.keys(formData).forEach((key) => {
        formData[key] = "";
    });
}


const FetchExpenseCategories = async () => {
    const response = await axios.get(`expenseCatagories`);
    expenseCategories = response.data.data;

    console.log(expenseCategories);

};
FetchExpenseCategories();

const CreateExpense = async () => {
    console.log("Form Data:", formData);
    try {
        const response = await axios.post("expenses", formData);
        console.log("Expense Successfully Created:", response);
        clear();
        // Optionally, add a toast message or similar notification
    } catch (error) {
        console.error("Failed to create expense:", error);
    }
};

const createCategory = async () => {
    if (formRef.value) {
        const isValid = await formRef.value.validate();
        if (isValid) {
            CreateExpense();
        }
    } else {
        console.error(
            "Form reference is null or validate method is not available"
        );
        
    }
};



</script>
