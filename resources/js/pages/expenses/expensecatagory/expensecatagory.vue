<template>
    <Create v-if="createDailog" :dailog="createDailog" @closePopup="closebtn" />
    <Update
        v-if="updateDailog"
        :dailog="updateDailog"
        @closePopup="closeupdate"
        :catagory="catagory"
    />
    <div class="relative sm:rounded-lg bg-white">
    <Header title="Expenses" subtitle="Expense Category" />

        <!-- in this part i import header for breadcrumbs  -->
        <v-layout class="py-4 px-4">
            <v-row class="justify-space-between">
                <v-col dir="rtl">
                    <v-btn
                    color="#99162e"
                    @click="createPopUp"
                    >
                        <span>Create</span>
                        <v-icon >mdi-plus</v-icon>
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
                                :items="expenseCatagories"
                                :loading="loading"
                                item-value="id"
                                @update:options="FetchExpenseCategories"
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
                                                        DeleteExpenseCategory(
                                                            item.id
                                                        )
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
import Create from "./Create.vue";
import Head from "../../../components/head.vue";
import Update from "./Update.vue";
export default {
    components: {
        Header,
        Create,
        Head,
        Update,
    },
    data: () => ({
        headers: [
            { title: "CATEGORY", key: "name", sortable: false },
            { title: "Action", key: "actions", sortable: false, align: "end" },
        ],
        createDailog: false,
        itemsPerPage: 5,
        page: 1,
        loading: false,
        totalItems: 0,
        dailog: false,
        expenseCatagories: [],
        catagory: [],
        updateDailog: false,
    }),
    methods: {
        async FetchExpenseCategories({ page, itemsPerPage }) {
            this.loading = true;

            const response = await axios.get(
                `expenseCategories?page=${page}&perPage=${itemsPerPage}&search=${this.search}`
            );
            this.expenseCatagories = response.data.data;
            this.totalItems = response.data.meta.total;
            this.loading = false;
        },
        async FetchExpenseCategorie(id) {
            const response = await axios.get(`expenseCategories/${id}`);
            this.catagory = response.data.data;
        },
        async DeleteExpenseCategory(id) {
            const config = {
                method: "DELETE",
                url: "expenseCategories/" + id,
            };

            const response = await axios(config);
            this.FetchExpenseCategories({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
            Toastify({
                text: "Delleted successfully!",
                duration: 4000,
                close: true,
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();
        },
        edit(item) {
            console.log(item);

            this.FetchExpenseCategorie(item.id);
            this.updateDailog = true;
        },
        closeupdate() {
            this.updateDailog = false;
        },

        // Temaplate Function
        createPopUp() {
            this.createDailog = true;
        },
        closebtn() {
            this.createDailog = false;
            this.FetchExpenseCategories({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },
    },

    mounted() {},
};
</script>
<style></style>
