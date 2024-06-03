<template>
  <div class="text-center pa-4">
    <v-dialog v-model="dialog" max-width="600" persistent>
      <template v-slot:activator="{ props: activatorProps }">
        <v-btn v-bind="activatorProps" class="green">
          <span class="mdi mdi-plus"></span>Create
        </v-btn>
      </template>

      <v-card class="boxShadow">
        <v-card-title>
          <span class="headline">Expense Form</span>
        </v-card-title>
        <v-form @submit.prevent="submitForm" ref="form">
          <v-card-text>
            <div class="margin">
              <v-text-field
                v-model="ownerId"
                :rules="ownerIdRules"
                label="Owner ID"
                variant="outlined"
                type="number"
              ></v-text-field>
              <v-text-field
                v-model="amount"
                :rules="amountRules"
                label="Amount"
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
              <v-textarea
                v-model="note"
                :rules="noteRules"
                label="Note"
                variant="outlined"
              ></v-textarea>
            </div>
            <div class="margin">
              <v-btn type="submit" max-width="100">Submit</v-btn>
            </div>
          </v-card-text>
        </v-form>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="dialog = false">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
      ownerId: "",
      amount: "",
      date: "",
      note: "",
      ownerIdRules: [
        (v) => !!v || "Owner ID is required",
        (v) => (v && v > 0) || "Owner ID must be greater than 0",
      ],
      amountRules: [
        (v) => !!v || "Amount is required",
        (v) => (v && v > 0) || "Amount must be greater than 0",
      ],
      dateRules: [
        (v) => !!v || "Date is required",
      ],
      noteRules: [
        (v) => !!v || "Note is required",
        (v) => (v && v.length >= 5) || "Note must be at least 5 characters",
      ],
    };
  },
  methods: {
    submitForm() {
      // Validate the entire form
      this.$refs.form.validate().then(success => {
        if (success) {
          // Form submission logic here
          alert(
            "Form submitted with: " +
            JSON.stringify({
              ownerId: this.ownerId,
              amount: this.amount,
              date: this.date,
              note: this.note,
            })
          );
          this.dialog = false;
        } else {
          // Validation failed
          alert('Please fill in all required fields correctly.');
        }
      });
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

.book {
  font-size: 18px;
  font-weight: bolder;
  letter-spacing: 12px;
  line-height: 3;
}
.alph {
  font-size: 18px;
  font-weight: bolder;
  line-height: 3;
}
.margin {
  width: 90%;
  height: 90%;
  margin: 0 auto;
}
</style>
