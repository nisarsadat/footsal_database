<template>
    <v-dialog transition="dialog-top-transition" width="600px" v-model="props">
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
                            v-model="formData.expenseCatagoryId"
                            clearable
                            variant="outlined"
                            label="Expense Category*"
                            density="compact"
                            :items="expenseCategories"
                            item-title="name"
                            item-value="name"
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
                        <v-text-field
                            v-model="formData.date"
                            variant="outlined"
                            density="compact"

                            label="Date *"
                            type="date"
                            class="pb-4"
                        ></v-text-field>
                        <v-textarea
                            v-model="formData.note"
                            variant="outlined"
                            density="compact"

                            label="Description *"
                            class="pb-4"
                        ></v-textarea>
                        <!-- <v-textarea
                            v-model="formData.details"
                            variant="outlined"
                            label="Description"
                        ></v-textarea> -->
                    </v-form>
                </v-card-text>
                <div class="justify-start pl-6 pb-6">
                    <v-btn color="light-blue-darken-1" @click="UpdateCatagory"
                        >Update</v-btn
                    >
                </div>
            </v-card>
        </template>
    </v-dialog>
</template>
<script setup>
import { ref, reactive, watch, defineProps, defineEmits } from 'vue';
let expenseCategories = reactive([]);

const FetchExpenseCategories = async () => {
    const response = await axios.get(`expenseCategories`);
    expenseCategories = response.data.data;
};
FetchExpenseCategories();
const props = defineProps({
  dailog: Boolean, // Assuming dailog is of Boolean type
  expens: {
    type: Object,
    default: () => ({})
  }
});
// console.log(this.owner ,'m' )/
import { data } from "autoprefixer";
const formRef = ref(null);
const formData = reactive({
    date:"",
    note:"",
    expenseCatagoryId:"",
    amount:"",
});
const newExpense = reactive({
    date:"",
    note:"",
    expenseCatagoryId:"",
    amount:"",
});

const emit = defineEmits(['closePopup', 'updateOwner']);


// Watch for changes in props.owner and update formData accordingly
watch(() => props.expens, (newExpense) => {
  formData.expenseCatagoryId = newExpense.expenseCatagoryId || '';
  formData.amount = newExpense.amount || '';
  formData.date = newExpense.date || '';
  formData.note = newExpense.note || '';

}, { immediate: true });

const closePopup = () => {
  emit('closePopup');
};

const updateCatagory = async (newExpense) => {
    console.log(newExpense);

    const config = {
        method: "POST",
        url: "/expenses",
        data: newExpense,
    };

    const response = await axios(config);

    this.fetchBookings({
        page: this.page,
        itemsPerPage: this.itemsPerPage,
    });
};
function UpdateCatagory() {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            updateCatagory(newExpense);
            closePopup();
        }
    });
}

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
