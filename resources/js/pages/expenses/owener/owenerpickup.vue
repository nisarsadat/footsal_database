
<template>
    <Popup v-if="createDailog" :dailog="createDailog" @closePopup="closebtn" />
    <div class="relative sm:rounded-lg mt-20 p-12">
        <!-- in this part i import header for breadcrumbs  -->
        <Header mainTitle="Expenses" subTitle="Owner Pick Up" />
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
                                :items="ownerPickups"
                                :loading="loading"
                                item-value="ownerPickupsId"
                                @update:options="FetchownerPickups"
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
                                                    @click="editItem(item)"
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
                                                        DeleteownerPickups(item.id)
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
import Popup from "./owenerpickuptable.vue";
export default {
    components: {
        Header,
        Popup,
    },
    data: () => ({
        headers: [
            { title: "Owner Name", key: "owner.name", sortable: false },
            { title: "note", key: "note", sortable: false },
            { title: "date", key: "date", sortable: false },
            { title: "Action", key: "actions", sortable: false, align: "end" },
        ],
        createDailog: false,
        itemsPerPage: 5,
        page: 1,
        loading: false,
        totalItems: 0,
        ownerPickups: [],
    }),
    methods: {
        async FetchownerPickups({ page, itemsPerPage }) {
            this.loading = true;

            const response = await axios.get(
                `ownerPickups?page=${page}&perPage=${itemsPerPage}&search=${this.search}`

            );
            this.ownerPickups = response.data.data;
            this.totalItems = response.data.meta.total;
            this.loading = false;
        },
        async DeleteownerPickups(id) {
            const config = {
                method: "DELETE",
                url: "ownerPickups/" + id,
            };

            const response = await axios(config);
            this.FetchownerPickups({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },

        // Temaplate Function
        createPopUp() {
            this.createDailog = true;
        },

        closebtn() {
            this.createDailog = false;
        },
    },

    mounted() {},
};
</script>
<style></style>
