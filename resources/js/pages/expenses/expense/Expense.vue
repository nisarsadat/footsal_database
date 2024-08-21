z
<template>
    <Popup v-if="createDailog" :dailog="createDailog" @closePopup="closebtn" />
    <Update
        v-if="updateDailog"
        :dailog="updateDailog"
        @closePopup="closeupdate"
        :expens="expens"
    />
    <Head />
    <div class="relative sm:rounded-lg p-12">
        <!-- in this part i import header for breadcrumbs  -->
        <Header mainTitle="Expenses" subTitle="All Expense" />
        <v-layout class="py-5">
            <v-row class="justify-space-between">
                <v-col cols="12" sm="3"> </v-col>
                <v-col cols="12" sm="2">
                    <v-btn
                        color="light-blue-darken-1"
                        size="large"
                        @click="createPopUp"
                    >
                        <span>Create</span>
                        <v-icon right large>mdi-plus</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </v-layout>

        <div class="overflow-x-auto pb-10">
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
                                    class="right"
                                >
                                    <v-menu>
                                        <template v-slot:activator="{ props }">
                                            <v-btn
                                                icon="mdi-dots-vertical"
                                                v-bind="props"
                                                variant="text"
                                            ></v-btn>
                                        </template>

                                        <v-list>
                                            <v-list-item>
                                                <v-list-item-title
                                                    @click="edit(item)"
                                                    class="cursor-pointer d-flex gap-3 justify-left pb-3"
                                                >
                                                    <v-icon color="gray"
                                                        >mdi-square-edit-outline</v-icon
                                                    >
                                                    Edit
                                                </v-list-item-title>

                                                <v-list-item-title
                                                    class="cursor-pointer d-flex gap-3"
                                                    @click="
                                                        Deleteexpenses(item.id)
                                                    "
                                                >
                                                    <v-icon color="gray"
                                                        >mdi-delete-outline</v-icon
                                                    >
                                                    Delete
                                                </v-list-item-title>
                                            </v-list-item>
                                        </v-list>
                                    </v-menu>
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
import Head from "../../../components/head.vue";
import Update from "./Update.vue";
export default {
    components: {
        Header,
        Popup,
        Head,
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
