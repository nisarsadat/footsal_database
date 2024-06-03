<template>
    <v-data-table
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items="serverItems"
        :items-length="totalItems"
        :loading="loading"
        item-value="name"
        @update:options="loadItems"
    >
        <template v-slot:item.actions="{ item }">
            <v-btn color="green" @click="editItem(item)" small><span class="mdi mdi-pencil black"></span></v-btn>
            <v-btn color="red" @click="deleteItem(item)" small><span class="mdi mdi-delete black"></span></v-btn>
        </template>
    </v-data-table>
</template>
<script>
const items = [
    {
        name: "Item 1",
        amount: 100,
        date: "2024-05-01",
        note: "Note 1",
    },
    {
        name: "Item 2",
        amount: 200,
        date: "2024-05-02",
        note: "Note 2",
    },
    // Add more items as needed
];

const FakeAPI = {
    async fetch({ page, itemsPerPage, sortBy }) {
        return new Promise((resolve) => {
            setTimeout(() => {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const paginated = items.slice(start, end);
                resolve({ items: paginated, total: items.length });
            }, 500);
        });
    },
};

export default {
    data: () => ({
        itemsPerPage: 5,
        headers: [
            { title: "Name", key: "name", align: "start", sortable: true },
            { title: "Amount", key: "amount", align: "end", sortable: true },
            { title: "Date", key: "date", align: "end", sortable: true },
            { title: "Note", key: "note", align: "end", sortable: false },
            { title: "Actions", key: "actions", align: "end", sortable: false },
        ],
        serverItems: [],
        loading: true,
        totalItems: 0,
    }),
    methods: {
        loadItems({ page, itemsPerPage, sortBy }) {
            this.loading = true;
            FakeAPI.fetch({ page, itemsPerPage, sortBy }).then(
                ({ items, total }) => {
                    this.serverItems = items;
                    this.totalItems = total;
                    this.loading = false;
                }
            );
        },
        editItem(item) {
            alert(`Edit item: ${item.name}`);
            // Add your edit logic here
        },
        deleteItem(item) {
            alert(`Delete item: ${item.name}`);
            // Add your delete logic here
        },
    },
    mounted() {
        this.loadItems({
            page: 1,
            itemsPerPage: this.itemsPerPage,
            sortBy: [],
        });
    },
};
</script>
<style>
.black
{
    color: rgb(0, 0, 0);
}
</style>
