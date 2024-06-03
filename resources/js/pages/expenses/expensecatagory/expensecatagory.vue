<template>
    <div class="boxShadow">
        <div
            class="d-flex pb-6 text-3xl font-semibold leading-snug font-serif margin"
            flat
        >
            <v-card-text class="alph">
                ||<strong class="book">
                    <span class="mdi mdi-expansion-card"></span>
                    EXPENSE CATEGORY
                </strong>
            </v-card-text>
            <catagorypopup />
        </div>
        <div class="margin">
            <ExpenseTable />
        </div>
    </div>
</template>

<script>
import ExpenseTable from "../expensecatagory/catagorytable.vue";
import catagorypopup from "../expensecatagory/catagorypopup.vue";
import axios from "axios";

export default {
    components: {
        ExpenseTable,
        catagorypopup,
    },

    data() {
        return {
            expenseCategories: [],
        };
    },
    
    methods: {
        getAllExpenseCategory() {
            axios
                .get("http://127.0.0.1:8000/api/expenseCatagories")
                .then((response) => {
                    console.log(response.data);
                    this.expenseCategories = response.data.data;
                })
                .catch((error) => {
                    console.error(
                        "There was an error fetching the data:",
                        error
                    );
                    // this.message = "Failed to load data.";
                });
        },
    },
    created() {

        this.getAllExpenseCategory();
    },
};
</script>

<style>
.boxShadow {
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    width: 100%;
    height: 100%;
    padding-bottom: 20px;
    margin-top: 30px;
}
.margin {
    width: 90%;
    height: 90%;
    margin: 0 auto;
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
</style>
