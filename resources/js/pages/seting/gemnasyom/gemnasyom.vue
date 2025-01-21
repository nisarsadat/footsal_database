<template>
    <Create v-if="createDailog" :dailog="createDailog" @closePopup="closebtn" />
    <Update
        v-if="updateDailog"
        :dailog="updateDailog"
        @closePopup="closeupdate"
        :gem="gem"
    />

    <div class="relative sm:rounded-lg  bg-white">
        <Header title="Setting_" subtitle="Gemnasyom" />

        <!-- in this part i import header for breadcrumbs  -->
        <v-layout class="py-4 px-4">
            <v-row class="justify-space-between">
                <v-col dir="rtl">
                    <v-btn color="#99162e" @click="createPopUp">
                        <span>Create</span>
                        <v-icon>mdi-plus</v-icon>
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
                                :items="gymnasia"
                                :loading="loading"
                                item-value="id"
                                @update:options="FetchGymnasia"
                                hover
                            >
                                <template v-slot:item.path="{ item }">
                                    <v-img
                                        :src="item.path"
                                        width="50"
                                        height="50"
                                        cover
                                        class="rounded-xl border-2 border-gray-300"
                                    ></v-img>
                                </template>
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
                                                        DeleteGymnasia(item.id)
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
import Create from "./popup.vue";
import Update from "./Update.vue";
export default {
    components: {
        Header,
        Create,
        Update,
    },
    data: () => ({
        headers: [
            { title: "Path", key: "path", sortable: false },
            { title: "Name", key: "name", sortable: false },
            { title: "Note", key: "note", sortable: false },
            { title: "Action", key: "actions", sortable: false, align: "end" },
        ],
        createDailog: false,
        updateDailog: false,
        itemsPerPage: 5,
        page: 1,
        loading: false,
        totalItems: 0,
        gymnasia: [],
        gem: [],
    }),
    methods: {
        async FetchGymnasia({ page, itemsPerPage }) {
            this.loading = true;

            const response = await axios.get(
                `gymnasia?page=${page}&perPage=${itemsPerPage}&search=${this.search}`
            );
            this.gymnasia = response.data.data;
            this.totalItems = response.data.meta.total;
            this.loading = false;
        },
        async FetchGymnasi(id) {
            const response = await axios.get(`gymnasia/${id}`);
            this.gem = response.data.data;
        },
        async DeleteGymnasia(id) {
            const config = {
                method: "DELETE",
                url: "gymnasia/" + id,
            };

            const response = await axios(config);
            this.FetchGymnasia({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },

        edit(item) {
            this.updateDailog = true;

            console.log(item);
            this.FetchGymnasi(item.id);
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
            this.FetchGymnasia({
                page: this.page,
                itemsPerPage: this.itemsPerPage,
            });
        },
    },

    mounted() {},
};
</script>
<style></style>
