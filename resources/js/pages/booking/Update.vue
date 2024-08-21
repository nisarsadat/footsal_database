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
                            v-model="formData.hallId"
                            clearable
                            variant="outlined"
                            label="Hall Name*"
                            density="compact"
                            :items="Halls"
                            :return--object="false"
                            item-title="name"
                            item-value="id"
                            :rules="[rules.required]"
                            :return-object="false"
                        ></v-autocomplete>
                        <v-autocomplete
                            v-model="formData.customerId"
                            clearable
                            variant="outlined"
                            label="Customer Id*"
                            density="compact"
                            :items="Customers"
                            :return--object="false"
                            item-title="name"
                            item-value="id"
                            :rules="[rules.required]"
                            :return-object="false"
                        ></v-autocomplete>
                        <v-text-field
                            v-model="formData.bookingName"
                            variant="outlined"
                            density="compact"
                            label="Booking Name*"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.payed"
                            variant="outlined"
                            density="compact"
                            label="Payed *"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.from"
                            variant="outlined"
                            density="compact"
                            label="FROM *"
                            type="time"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.to"
                            variant="outlined"
                            density="compact"
                            label="TO*"
                            type="time"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.price"
                            variant="outlined"
                            density="compact"
                            label="Price*"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.discount"
                            variant="outlined"
                            density="compact"
                            label="Discount*"
                            type="number"
                            class="pb-4"
                        ></v-text-field>
                        <v-text-field
                            v-model="formData.stuffsRent"
                            variant="outlined"
                            density="compact"
                            label="STUFF RENT*"
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
  booking: {
    type: Object,
    default: () => ({})
  }
});
// console.log(this.owner ,'m' )/
import { data } from "autoprefixer";
const formRef = ref(null);
const formData = reactive({
    hallId:"",
    customerId:"",
    bookingName:"",
    FROM:"",
    TO:"",
    PRICE:"",
    Date:"",
    discount:"",
    total:"",
    due:"",

});
const newBooking = reactive({
    name:"",
});

const emit = defineEmits(['closePopup', 'updateOwner']);


// Watch for changes in props.owner and update formData accordingly
watch(() => props.booking, (newBooking) => {
  formData.hallId = newBooking.hallId || '';
  formData.customerId = newBooking.customerId || '';
  formData.bookingName = newBooking.bookingName || '';
  formData.from = newBooking.from || '';
  formData.to = newBooking.to || '';
  formData.price = newBooking.price || '';
  formData.discount = newBooking.discount || '';
  formData.total = newBooking.total || '';
  formData.due = newBooking.due || '';
  formData.date = newBooking.date || '';
  formData.stuffsRent = newBooking.stuffsRent || '';
  formData.payed = newBooking.payed || '';
}, { immediate: true });

const closePopup = () => {
  emit('closePopup');
};
let Halls = reactive([]);
let Customers = reactive([]);
const FetchHalls = async () => {
    const response = await axios.get(`halls`);
    Halls = response.data.data;
};
FetchHalls();

const FetchCustomers = async () => {
    const response = await axios.get(`customers`);
    Customers = response.data.data;
};
FetchCustomers();

const updateCatagory = async (newBooking) => {
    console.log(newBooking);

    const config = {
        method: "POST",
        url: "/owners",
        data: newBooking,
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
            updateCatagory(newBooking);
            closePopup();
        }
    });
}

const rules = {
    required: (value) => !!value || "Category Name is Required.",
    counter: (value) => value.length >= 3 || "Min 3 characters",
};
</script>
