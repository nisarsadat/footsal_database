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
let imageSrc = ref(null);
const inputRef = ref(null);
const onChangeImage = (e) => {
    imageSrc.value = URL.createObjectURL(e.target.files[0]);
    formData.path = e.target.files[0];
};
const OpenWindow = (action) => {
    if (action) {
        ref(action).value.click();
    }
};
const CloseWindow = () => {
    imageSrc.value = null;
    formData.path = null;
};

const formRef = ref(null);
const formData = reactive({
    name: "",
    path: "",  // Changed to 'file' to capture the File object
    note: "",
});

const props = defineProps({
  dailog: Boolean, // Assuming dailog is of Boolean type
  gem: {
    type: Object,
    default: () => ({})
  }
});
// console.log(this.owner ,'m' )/
const newGem = reactive({
    name:"",
    path:"",
    note:"",
});

const emit = defineEmits(['closePopup', 'updateOwner']);



// Watch for changes in props.owner and update formData accordingly
watch(() => props.gem, (newGem) => {
  formData.name = newGem.name || '';
  formData.path = newGem.path || '';
  formData.note = newGem.note || '';
}, { immediate: true });

const closePopup = () => {
  emit('closePopup');
};

const updateCatagory = async (newGem) => {
    console.log(newGem);

    const config = {
        method: "POST",
        url: "/gymnasia",
        data: newGem,
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
            updateCatagory(newGem);
            closePopup();
        }
    });
}

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
