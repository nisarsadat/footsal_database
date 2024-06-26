<script setup>
import Header from "@/components/UI/Header.vue";
import { useExpenseRepository } from "@/store/ExpenseRepository";
import { reactive, ref, computed } from "vue";

let ExpenseRepository = useExpenseRepository();
ExpenseRepository.fetchGeneralExpensesDataForAllExpense();
const formRef = ref(null);
const formData = reactive({
    date: "",
    expensePeople: "",
    flightGroup: "",
    expenseCategory: "",
    amount: "",
    details: "",
});
formData.date = ExpenseRepository.getCurrentDate();

// validation rules -------------------------------------------------------
const rules = {
    required: (value) => !!value || "Field is Required.",
    number: (value) => value.length >= 10 || "Max 10 characters",
};
// Date
// create Booking --------------------------------------------------------------

async function createExpense() {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            ExpenseRepository.CreateExpense(formData);
        }
    });
}
</script>
<template>
    <div class="relative sm:rounded-lg pt-16 px-6">
        <Header mainTitle="Expenses" subTitle="Create Expenses" class="my-4" />
        <div class="pt-8">
            <v-form ref="formRef">
                <!-- Information Section code  -->
                <v-card
                    class="rounded shadow-[0_3px_10px_rgb(0,0,0,0.2)] px-5 py-4 mb-12 w-[85vw]"
                >
                    <div class="px-5 py-4 pt-6">
                        <v-row no-gutters class="justify-space-between">
                            <v-col cols="12" sm="6" md="6" class="pr-2">
                                <v-text-field
                                    v-model="formData.date"
                                    variant="outlined"
                                    label="Data *"
                                    density="compact"
                                    type="date"
                                    :rules="[rules.required]"
                                ></v-text-field>
                                <div class="flex gap-1">
                                    <div class="w-[20vw]">
                                        <v-autocomplete
                                            v-model="formData.expenseCategory"
                                            clearable
                                            variant="outlined"
                                            label="Expense Category*"
                                            density="compact"
                                            :items="
                                                ExpenseRepository
                                                    .generalExpenseData
                                                    .expenseCategories
                                            "
                                            item-title="name"
                                            item-value="id"
                                            :rules="[rules.required]"
                                            :return-object="false"
                                        ></v-autocomplete>
                                    </div>
                                    <div class="relative w-[20vw]">
                                        <v-text-field
                                            v-model="formData.amount"
                                            variant="outlined"
                                            label="Amount *"
                                            :rules="[rules.required]"
                                            density="compact"
                                        ></v-text-field>
                                        <div
                                            v-if="
                                                ExpenseRepository.symbol !==
                                                null
                                            "
                                            class="absolute top-0 right-0 w-[60px] text-center bg-gray-300 py-2 px-2 rounded-r"
                                        >
                                            {{ ExpenseRepository.symbol }}
                                        </div>
                                    </div>
                                </div>
                            </v-col>
                            <v-col cols="12" sm="6" md="6" class="pr-2">
                                <v-autocomplete
                                    v-model="formData.expensePeople"
                                    variant="outlined"
                                    label="Person *"
                                    density="compact"
                                    @update:modelValue="
                                        ExpenseRepository.getCurrencySymbol(
                                            ExpenseRepository.generalExpenseData
                                                .expensePeoples,
                                            formData.expensePeople
                                        )
                                    "
                                    :items="
                                        ExpenseRepository.generalExpenseData
                                            .expensePeoples
                                    "
                                    item-title="name"
                                    item-value="id"
                                    :rules="[rules.required]"
                                    :return-object="false"
                                ></v-autocomplete>
                                <v-autocomplete
                                    v-model="formData.flightGroup"
                                    clearable
                                    variant="outlined"
                                    label="Flight Group*"
                                    density="compact"
                                    :items="
                                        ExpenseRepository.generalExpenseData
                                            .flightGroups
                                    "
                                    item-title="name"
                                    item-value="id"
                                    :return-object="false"
                                ></v-autocomplete>
                            </v-col>

                            <v-col cols="12" sm="12" md="12" class="pr-2">
                                <v-textarea
                                    v-model="formData.details"
                                    variant="outlined"
                                    density="compact"
                                    label="Details"
                                ></v-textarea>
                            </v-col>
                            <v-col cols="3" sm="3" class="mb-4">
                                <v-btn
                                    color="light-blue-darken-1"
                                    @click="createExpense"
                                    >Submit</v-btn
                                >
                            </v-col>
                        </v-row>
                    </div>
                </v-card>
            </v-form>
        </div>
    </div>
</template>
