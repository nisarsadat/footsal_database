<template>
    <Popup v-if="createDailog" :dailog="createDailog" @closePopup="closebtn" />
    <Update
        v-if="updateDailog"
        :dailog="updateDailog"
        @closePopup="closeupdate"
        :expens="expens"
    />

    <div class="relative sm:rounded-lg bg-white">
        <Header title="Expenses_" subtitle="All Expense" />

        <!-- in this part i import header for breadcrumbs  -->
        <v-layout class="py-4 px-4 bg-white">
            <v-row class="justify-space-between">
                <v-col dir="rtl">
                    <v-btn color="#99162e" @click="createPopUp">
                        <span>Create</span>
                        <v-icon right large>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </v-layout>

        <div class="overflow-x-auto pb-10 px-4">
            <v-app>
                <v-main>
                    <v-row>
                        <v-col>
                            <v-data-table-server
                                v-model:items-per-page="itemsPerPage"
                                :headers="headers"
                                :items-length="totalItems"
                                :items="expenses"
                                :loading="loading"
                                item-value="expenseCatagoryId"
                                @update:options="Fetchexpenses"
                                hover
                            >
                                <template
                                    v-slot:item.actions="{ item }"
                                >
                                    <!-- <v-menu>
                                        <template v-slot:activator="{ props }">
                                            <v-btn
                                                icon="mdi-dots-vertical"
                                                v-bind="props"
                                                variant="text"
                                            ></v-btn>
                                        </template>

                                        <v-list> -->
                                            <v-list-item class="d-flex ">
                                                <v-list-item-title
                                                    @click="edit(item)"
                                                    class="cursor-pointer gap-12 "
                                                >
                                                    <v-icon color="gray"
                                                        >mdi-square-edit-outline</v-icon
                                                    >
                                                </v-list-item-title>

                                                <v-list-item-title
                                                    class="cursor-pointer gap-12"
                                                    @click="
                                                        Deleteexpenses(item.id)
                                                    "
                                                >
                                                    <v-icon color="gray"
                                                        >mdi-delete-outline</v-icon
                                                    >
                                                </v-list-item-title>
                                            </v-list-item>
                                        <!-- </v-list>
                                    </v-menu> -->
                                </template>
                            </v-data-table-server>
                        </v-col>
                    </v-row>
                </v-main>
            </v-app>
        </div>
    </div>
</template>
<script>
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import Header from "../../../components/Header.vue";
import Popup from "./expensetable.vue";
import Update from "./Update.vue";
export default {
    components: {
        Header,
        Popup,
        Update,
    },
    data: () => ({
        headers: [
            {
                title: "Expense Category",
                key: "expenseCatagory.name",
                sortable: false,
            },
            { title: "Amount", key: "amount", sortable: false },
            { title: "Date", key: "date", sortable: false },
            { title: "Action", key: "actions", sortable: false, align: "end" },
        ],
        createDailog: false,
        updateDailog: false,
        itemsPerPage: 5,
        page: 1,
        loading: false,
        totalItems: 0,
        expenses: [],
        expens: [],
        expenseCategories: [],
    }),
    methods: {
        async Fetchexpenses({ page, itemsPerPage }) {
            this.loading = true;

            const response = await axios.get(
                `expenses?page=${page}&perPage=${itemsPerPage}&search=${this.search}`
            );
            this.FetchExpenseCategories();
            this.expenses = response.data.data;
            this.totalItems = response.data.meta.total;
            this.loading = false;
        },
        async Fetchexpense(id) {
            const response = await axios.get(`expenses/${id}`);
            this.expens = response.data.data;
        },

        async FetchExpenseCategories() {
            const response = await axios.get(`expenseCategories`);
            expenseCategories = response.data.data;
        },
        async Deleteexpenses(id) {
            const config = {
                method: "DELETE",
                url: "expenses/" + id,
            };

            const response = await axios(config);
            this.Fetchexpenses({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
            Toastify({
                text: "Deleted successfully!",
                duration: 4000,
                close: true,
                backgroundColor: "linear-gradient(to right, #F31A1A)",
                className: "info",
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();
        },
        edit(item) {
            console.log(item);

            this.Fetchexpense(item.id);
            this.updateDailog = true;
        },
        closeupdate() {
            this.updateDailog = false;
        },

        // Temaplate Function
        createPopUp() {
            this.createDailog = true;
            this.FetchExpenseCategories();
        },

        closebtn() {
            this.createDailog = false;
            this.Fetchexpenses({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },
    },

    mounted() {},
};
</script>
