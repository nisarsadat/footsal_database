<template>
    <v-dialog transition="dialog-top-transition" width="600px" v-model="dailog">
        <template v-slot:default="{ isActive }">
            <v-card class="px-3">
                <v-card-title class="px-6 py-4 d-flex justify-space-between">
                    <h2>Create</h2>
                    <v-btn variant="text" @click="closePopup">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-form ref="formRef">
                        <v-text-field
                            v-model="formData.name"
                            variant="outlined"
                            :rules="[rules.required, rules.counter]"
                            label="Gemnasyom Name *"
                            class="pb-4"
                        ></v-text-field>
                        <div class="photo-upload-container">
                            <v-file-input
                                type="file"
                                ref="inputRef"
                                style="display: none"
                                @change="onChangeImage"
                            ></v-file-input>

                            <img
                                :src="imageSrc"
                                class="photo-preview"
                                v-show="imageSrc !== null"
                            />

                            <div class="photo-overlay">
                                <button
                                    v-if="!imageSrc"
                                    type="button"
                                    @click="OpenWindow(inputRef)"
                                    class="overlay-button"
                                >
                                    <v-icon
                                        size="x-large"
                                        color="blue-grey-lighten-2"
                                        >mdi-camera</v-icon
                                    >
                                </button>
                                <button
                                    v-if="imageSrc"
                                    type="button"
                                    @click="CloseWindow()"
                                    class="close-button"
                                >
                                    <v-icon size="small"
                                        >mdi-close</v-icon
                                    >
                                </button>
                                <button
                                    v-if="imageSrc"
                                    type="button"
                                    @click="OpenWindow(inputRef)"
                                    class="edit-button"
                                >
                                    <v-icon size="small"
                                        >mdi-pencil</v-icon
                                    >
                                </button>
                            </div>
                        </div>
                        <v-textarea
                            v-model="formData.note"
                            variant="outlined"
                            label="note *"
                            class="pb-4"
                        ></v-textarea>
                    </v-form>
                </v-card-text>
                <div class="justify-start pl-6 pb-6">
                    <v-btn color="light-blue-darken-1" @click="createCategory">Submit</v-btn>
                </div>
            </v-card>
        </template>
    </v-dialog>
</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';


let imageSrc = ref(null);
const inputRef = ref(null);
const onChangeImage = (e) => {
    const file = e.target.files[0];
    if (file) {
        imageSrc.value = URL.createObjectURL(file);  // Set up for preview
        formData.file = file;  // Store the file for uploading
    }
};
const OpenWindow = () => {
    inputRef.value.click();
};
const CloseWindow = () => {
    if (imageSrc.value) {
        URL.revokeObjectURL(imageSrc.value);  // Clean up object URL to avoid memory leaks
    }
    imageSrc.value = null;
    formData.file = null;
};

let dailog = defineProps("dailog");
const formRef = ref(null);
const formData = reactive({
    name: "",
    file: null,  // Handle the file object directly
    note: "",
});

const emit = defineEmits(["closePopup"]);

const closePopup = () => {
    emit("closePopup");
};



// Function to create a category, including uploading a file
const CreateCategory = async () => {
    if (await formRef.value.validate()) {
        const form = new FormData();
        form.append('name', formData.name);
        form.append('note', formData.note);
        if (formData.file) {
            form.append('file', formData.file);  // Ensure this key matches the backend expectation
        }

        try {
            const response = await axios.post('/gymnasia', form, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            console.log('Upload successful', response.data);
            closePopup();
        } catch (error) {
            console.error('Error uploading file:', error);
        }
    }
};

const createCategory = () => {
    formRef.value.validate().then(async (validate) => {
        if (validate) {
            try {
                const payload = {
                    name: formData.name,
                    path: formData.path,  // Set the path received from the server
                    note: formData.note
                };
                await CreateCategory(payload);
                closePopup();
            } catch (error) {
                console.error('Error creating category:', error);
            }
        }
    });
};

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
