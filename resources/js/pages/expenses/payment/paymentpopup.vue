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
                            v-model="formData.id"
                            clearable
                            variant="outlined"
                            label="name*"
                            density="compact"
                            :items="Bookings"
                            :return-object="false"
                            item-title="bookingName"
                            item-value="id"
                            :rules="[rules.required]"
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
import { ref, reactive, watch, defineProps, defineEmits } from "vue";
import axios from "axios";

const props = defineProps({
    dialog: Boolean, // Dialog visibility
    user: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(["closePopup", "updateOwner"]);
const formRef = ref(null);
const formData = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

// Watch for changes in props.user and update formData accordingly
watch(
    () => props.user,
    (newUser) => {
        if (newUser) {
            formData.name = newUser.name || "";
            formData.email = newUser.email || "";
            formData.password = newUser.password || "";
            formData.password_confirmation =
                newUser.password_confirmation || "";
        }
    },
    { immediate: true }
);

const closePopup = () => {
    emit("closePopup");
};

const updateCategory = async () => {
    try {
        // Validate the form
        const isValid = await formRef.value.validate();
        if (isValid) {
            // Make the API call
            await axios.post("/users", formData);
            emit("updateOwner"); // Emit updateOwner if needed
            closePopup();
        }
    } catch (error) {
        console.error("Error updating category:", error);
    }
};

const rules = {
    required: (value) => !!value || "Field is required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
