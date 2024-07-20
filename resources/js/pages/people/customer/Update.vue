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
                            label="Owener Name *"
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
import { ref, reactive, watch, defineProps, defineEmits } from 'vue';
const props = defineProps({
  dailog: Boolean, // Assuming dailog is of Boolean type
  owner: {
    type: Object,
    default: () => ({})
  }
});
// console.log(this.owner ,'m' )/
import { data } from "autoprefixer";
const formRef = ref(null);
const formData = reactive({
    name:"",
});
const newOwner = reactive({
    name:"",
});

const emit = defineEmits(['closePopup', 'updateOwner']);


// Watch for changes in props.owner and update formData accordingly
watch(() => props.owner, (newOwner) => {
  formData.name = newOwner.name || '';
}, { immediate: true });

const closePopup = () => {
  emit('closePopup');
};

const updateCatagory = async (newOwner) => {
    console.log(newOwner);

    const config = {
        method: "POST",
        url: "/owners",
        data: newOwner,
    };

    const response = await axios(config);

    this.fetchOwners({
        page: this.page,
        itemsPerPage: this.itemsPerPage,
    });
};
function UpdateCatagory() {
    formRef.value.validate().then((validate) => {
        if (validate.valid) {
            updateCatagory(newOwner);
            closePopup();
        }
    });
}

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
