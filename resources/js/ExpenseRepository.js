import { defineStore } from "pinia";
import { reactive, ref } from "vue";
// Import Axios
import { axios, setContentType } from "../axios";
import { toast } from "vue3-toastify";
import { useRouter } from "vue-router";
export let useExpenseRepository = defineStore("ExpenseRepository", {
    state() {
        return {
            expensePeoples: reactive([]),

            generalExpenseData: reactive([]),
            allExpenses: reactive([]),
            expenseCategories: [],
            ExpenseCategory: {},
            expense: {},
            dailog: false,
            createDailog: false,
            updateDailog: false,
            loading: true,
            isLoading: false,
            itemsPerPage: 10,
            selectedItems: [],
            selectAll: false,
            showSelect: true,
            totalItems: 0,
            router: useRouter(),
            itemKey: "id",
            symbol: ref(null),
            allExpenseSearch: "",
            expenseCategorySearch: "",
        };
    },
    actions: {
        // Today Date
        getCurrentDate() {
            const today = new Date();
            const year = today.getFullYear();
            const month = (today.getMonth() + 1).toString().padStart(2, "0");
            const day = today.getDate().toString().padStart(2, "0");
            return `${year}-${month}-${day}`;
        },
        getCurrencySymbol(account, id) {
            // const array = account.filter((acc) => acc.id === id);
            // const symbolFromAccount = array[0].currency.symbol;
            // this.symbol = symbolFromAccount;
            // console.log(array[0].currency.symbol);
            console.log(account, id);
        },
        updateCurrencySymbol(account, id) {
            const array = account.filter((acc) => acc.currency.id === id);
            const symbolFromAccount = array[0].currency.symbol;
            this.symbol = symbolFromAccount;
            console.log(array[0].currency.symbol);
            // console.log(account, id);
        },

        async ExpensePeople() {
            this.loading = true;
            const response = await axios.get(`expensePeoples`);
            this.expensePeoples = response.data.data;
            this.loading = false;
        },

        //All Expenses ApI

        async fetchGeneralExpensesDataForAllExpense() {
            this.loading = true;

            setContentType("application/json");
            const response = await axios.get(`generalExpenseData`);
            this.generalExpenseData = response.data.data;
            console.log(this.generalExpenseData);
            this.loading = false;
        },







        async fetchExpenses({ page, itemsPerPage }) {
            this.loading=true;
            setContentType("application/json");
            const response = await axios.get(
                `expenses?page=${page}&perPage=${itemsPerPage}&search=${this.allExpenseSearch}`
            );
            this.allExpenses = response.data.data;
            this.totalItems = response.data.meta.total;
            this.loading = false;
        },
        async fetchExpense(id) {
            setContentType("application/json");
            const response = await axios.get(`expenses/${id}`);

            this.expense = response.data.data; // Assign the fetched data directly to this.people

            // Reset error in case it was previously set
        },
        async UpdateExpense(id, data) {
            setContentType("application/json");
            console.log(data);
            const config = {
                method: "PUT",
                url: "expenses/" + id,

                data: data,
            };

            // Using Axios to make a post request with async/await and custom headers
            const response = await axios(config);
            toast.success("Expense Succesfully Updated", {
                autoClose: 1000,
            });
            this.router.push("/allExpenses");
            this.symbol = null;
            this.fetchExpenses({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },
        async CreateExpense(formData) {
            console.log(formData);
            // Adding a custom header to the Axios request
            setContentType("application/json");
            const config = {
                method: "POST",
                url: "expenses",

                data: JSON.stringify(formData),
            };

            // Using Axios to make a GET request with async/await and custom headers
            const response = await axios(config);
            this.symbol = null;
            toast.success("Expense Succesfully Created", {
                autoClose: 1000,
            });
            this.router.push("/allExpenses");
            this.fetchExpenses({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },
        async DeleteExpense(id) {

            setContentType("application/json");
            const config = {
                method: "DELETE",
                url: "expenses/" + id,
            };

            const response = await axios(config);
            toast.success("Expense Succesfully Deleted", {
                autoClose: 1000,
            });
            this.fetchExpenses({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },






        // Expense Category API

       
        async fetchExpenseCategory(id) {
            setContentType("application/json");

            const response = await axios.get(`expenseCategories/${id}`);

            this.ExpenseCategory = response.data.data; // Assign the fetched data directly to this.people

            // Reset error in case it was previously set
        },
        async UpdateCateogory(id, data) {
            setContentType("application/json");
            console.log(data);
            // Adding a custom header to the Axios request
            const config = {
                method: "PUT",
                url: "expenseCategories/" + id,

                data: data,
            };

            // Using Axios to make a post request with async/await and custom headers
            const response = await axios(config);

            toast.success("Category Succesfully Updated", {
                autoClose: 1000,
            });
            this.updateDailog = false;
            this.symbol = null;
            this.fetchExpenseCategories({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },
       
       
        

        // Export Functions
        async ExportExpenses() {
            try {
                const response = await fetch("api/v1/expense/export");
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                toast.success("Excel File is Downloading...", {
                    autoClose: 1000,
                });
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement("a");
                a.href = url;
                a.download = "Expenses.xlsx";
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            } catch (error) {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
                // Handle errors
            }
        },
    },
});
