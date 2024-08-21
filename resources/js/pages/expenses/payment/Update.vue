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
                            v-model="formData.bookingId"
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

const props = defineProps({
  dailog: Boolean, // Assuming dailog is of Boolean type
  payment: {
    type: Object,
    default: () => ({})
  }
});
const FetchBookings = async () => {
    const response = await axios.get(`bookings`);
    Bookings = response.data.data;
};
FetchBookings();
// console.log(this.owner ,'m' )/
import { data } from "autoprefixer";
const formRef = ref(null);
const formData = reactive({

    bookingId:"",
    bookingName:"",
    payed:"",
    date:"",

});
const newBooking = reactive({
    name:"",
});

const emit = defineEmits(['closePopup', 'updateOwner']);

let Bookings = reactive([]);


// Watch for changes in props.owner and update formData accordingly
watch(() => props.payment, (newPayment) => {
  formData.bookingName = newBooking.newPayment || '';
  formData.date = newPayment.date || '';
  formData.payed = newPayment.payed || '';
}, { immediate: true });

const closePopup = () => {
  emit('closePopup');
};

const updateCatagory = async (newPayment) => {
    console.log(newPayment);

    const config = {
        method: "POST",
        url: "/owners",
        data: newPayment,
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
            updateCatagory(newPayment);
            closePopup();
        }
    });
}

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
