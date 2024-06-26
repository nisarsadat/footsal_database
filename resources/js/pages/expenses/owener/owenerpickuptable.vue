<template>
    <v-dialog transition="dialog-top-transition" width="600px" v-model="dailog">
        <template v-slot:default="{ isActive }">
            <v-card class="px-3">
                <v-card-title class="px-6 py-4 d-flex justify-space-between">
                    <h2>Create</h2>

                    <v-btn variant="text" @click="isActive.value = false"
                        ><v-icon> mdi-close </v-icon></v-btn
                    >
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-form ref="formRef">
                        <v-autocomplete
                            v-model="formData.owenerId"
                            clearable
                            variant="outlined"
                            label="Owener Id*"
                            density="compact"
                            :items="owenerAllId"
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
                        
                    </v-form>
                </v-card-text>
                <div class="justify-start pl-6 pb-6">
                    <v-btn color="light-blue-darken-1" @click="createOwener"
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

const formRef = ref(null);
let owenerAllId = reactive([]);
const formData = reactive({
    owenerId: "",
    note: "",
    amount: "",
    date: "",
});
const FetchOwenerAllId = async () => {
    const response = await axios.get(`owenerAllId`);
    owenerAllId = response.data.data;
    

};
console.log(owenerAllId)
FetchOwenerAllId();

const CreateOwener = async (formData) => {
    console.log(formData);
    // Adding a custom header to the Axios request
    // setContentType("application/json");
    const config = {
        method: "POST",
        url: "owners",

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


const createOwener = async () => {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            CreateOwener(formData);
        }
    });
};

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};

</script>
