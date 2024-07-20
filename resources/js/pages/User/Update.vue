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
                        <v-text-field
                            v-model="formData.name"
                            variant="outlined"
                            :rules="[rules.required, rules.counter]"
                            label="Name *"
                            class="pb-4"
                            density="compact"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.email"
                            variant="outlined"
                            :rules="[rules.required, rules.counter]"
                            label="Email*"
                            class="pb-4"
                            density="compact"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.password"
                            variant="outlined"
                            :rules="[rules.required, rules.counter]"
                            label="New Password *"
                            class="pb-4"
                            density="compact"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.password_confirmation"
                            variant="outlined"
                            :rules="[rules.required, rules.counter]"
                            label="New Password Confamation*"
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
                    <v-btn color="light-blue-darken-1" @click="UpdateCatagory"
                        >Submit</v-btn
                    >
                </div>
            </v-card>
        </template>
    </v-dialog>
</template>
<script setup>
import { ref, reactive, watch, defineProps, defineEmits } from "vue";
const props = defineProps({
    dailog: Boolean, // Assuming dailog is of Boolean type
    user: {
        type: Object,
        default: () => ({}),
    },
});
// console.log(this.owner ,'m' )/
const formRef = ref(null);
const formData = reactive({
    name:"",
    email:"",
    password:"",
    password_confirmation:"",
});

const emit = defineEmits(["closePopup", "updateOwner"]);

// Watch for changes in props.user and update formData accordingly
watch(
    () => props.user,
    (newUser) => {
        formData.name = newUser.name || "";
        formData.email = newUser.email || "";
        formData.password = newUser.password || "";
        formData.password_confirmation = newUser.password_confirmation || "";
    },
    { immediate: true }
);
console.log(formData);


const closePopup = () => {
    emit("closePopup");
};

const updateCatagory = async (newUser) => {
    console.log(newUser);

    const config = {
        method: "POST",
        url: "/users",
        data: newUser,
    };

    const response = await axios(config);

    this.FetchRegisters({
        page: this.page,
        itemsPerPage: this.itemsPerPage,
    });
};
function UpdateCatagory() {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            updateCatagory(newUser);
            closePopup();
        }
    });
}

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
