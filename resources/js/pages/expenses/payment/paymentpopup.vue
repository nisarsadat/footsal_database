<template>
    <div class="text-center pa-4">
        <v-dialog v-model="dialog" persistent max-width="600px">
            <template v-slot:activator="{ props: activatorProps }">
                <v-btn v-bind="activatorProps" class="green">
                    <span class="mdi mdi-plus"></span>Create
                </v-btn>
            </template>
            <v-card class="boxShadow">
                <v-card-title>
                    <span class="headline"
                        >||     <strong
                            ><span class="mdi mdi-cash-sync"></span>
                            Payment</strong
                        >
                    </span>
                </v-card-title>
                <v-form @submit.prevent="submitForm">
                    <v-card-text class="margin">
                        <v-text-field
                            v-model="bookingid"
                            :rules="nameRules"
                            label="Booking ID"
                            variant="outlined"
                            type="number"
                        ></v-text-field>
                        <v-text-field
                            v-model="paid"
                            :rules="amountRules"
                            label="Paid"
                            variant="outlined"
                            type="number"
                        ></v-text-field>
                        <v-text-field
                            v-model="date"
                            :rules="dateRules"
                            label="Date"
                            variant="outlined"
                            type="date"
                        ></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" type="submit">Submit</v-btn>
                        <v-btn text @click="dialog = false">Cancel</v-btn>
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dialog: false,
            bookingid: "",
            paid: "",
            date: "",
            nameRules: [
                (v) => !!v || "Name is required",
                (v) => v.length >= 2 || "Name must be at least 2 characters",
            ],
            amountRules: [
                (v) => !!v || "Amount is required",
                (v) => v > 0 || "Amount must be greater than zero",
            ],
            dateRules: [(v) => !!v || "Date is required"],
            noteRules: [
                (v) => !!v || "Note is required",
                (v) => v.length >= 10 || "Note must be at least 10 characters",
            ],
        };
    },
    methods: {
        submitForm() {
            if (this.$refs.form.validate()) {
                // Form is valid, perform submit actions
                alert("Form submitted");
                this.dialog = false;
            } else {
                // Form is invalid, display error messages
                alert("Please fill out all required fields correctly.");
            }
        },
    },
};
</script>

<style>
.boxShadow {
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    padding: 20px;
    margin: 20px;
}
.margin {
    width: 100%;
}
.green {
    background-color: rgb(2, 167, 2);
}
</style>
