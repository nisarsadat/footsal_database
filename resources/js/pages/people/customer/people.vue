<template>
    <Create v-if="createDailog" :dailog="createDailog" @closePopup="closebtn" />
    <Update v-if="updateDailog" :dailog="updateDailog" @closePopup="closeupdate" :owner="owner"/>

    <div class="relative sm:rounded-lg mt-20 p-12">
        <!-- in this part i import header for breadcrumbs  -->
        <Header mainTitle="People" subTitle="Owner" />
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
                                :items="owners"
                                :loading="loading"
                                item-value="id"
                                @update:options="FetchOwners"
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
                                                        DeleteOwners(item.id)
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
import Header from "../../../components/Header.vue";
import Create from "./peoplepopup.vue";
import Update from "./Update.vue";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

export default {
    components: {
        Header,
        Create,
        Update,
    },
    data: () => ({
        headers: [
            { title: "Name", key: "name", sortable: false },
            { title: "Action", key: "actions", sortable: false, align: "end" },
        ],
        createDailog: false,
        updateDailog: false,
        itemsPerPage: 5,
        page: 1,
        loading: false,
        dailog: false,
        totalItems: 0,
        owners: [],
        owner: [],
    }),
    methods: {
        async FetchOwners({ page, itemsPerPage }) {
            this.loading = true;

            const response = await axios.get(
                `owners?page=${page}&perPage=${itemsPerPage}&search=${this.search}`
            );
            this.owners = response.data.data;
            this.totalItems = response.data.meta.total;
            this.loading = false;
            this.dailog = false;
        },
        async FetchOwner(id) {

            const response = await axios.get(
                `owners/${id}`
            );
            this.owner = response.data.data;
        },
        async DeleteOwners(id) {
            const config = {
                method: "DELETE",
                url: "owners/" + id,
            };
            Toastify({
                text: "Deleted successfully!",
                duration: 4000,
                close: true,
                className: "info",
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();

            const response = await axios(config);
            this.FetchOwners({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },

        // Temaplate Function
        createPopUp() {
            this.createDailog = true;
        },
        edit(item) {
           console.log(item)

           this.FetchOwner(item.id);
            this.updateDailog = true;

        },
        closeupdate(){
            this.updateDailog= false;
        },
        closebtn() {
            this.createDailog = false;
            Toastify({
                text: "Action completed successfully!",
                duration: 3000,
                close: true,
                backgroundColor: "#089",
                className: "info",
                stopOnFocus: true, // Prevents dismissing of toast on hover

            }).showToast();
            this.FetchOwners({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },
    },

    mounted() {},
};
</script>
<style></style>
