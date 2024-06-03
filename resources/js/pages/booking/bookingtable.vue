<template>
    <div class="bgg">
        <v-data-table
            class="margin"
            :headers="headers"
            :items="items"
            item-key="name"
            items-per-page="5"
        >
            <template v-slot:[`item.actions`]="{ item }">
                <v-btn small color="green" @click="editItem(item)">
                    <span class="mdi mdi-pencil black"></span>
                </v-btn>
                <v-btn small color="red" @click="deleteItem(item)">
                    <span class="mdi mdi-delete black"></span>
                </v-btn>
            </template>
        </v-data-table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            headers: [
                { text: "Name", value: "name" },
                { text: "Phone Number", value: "phone" },
                { text: "Actions", value: "actions", sortable: false },
            ],
            items: [
                { name: "Nisar", phone: "0782606740" },
                // Add more items here
            ],
        };
    },
    methods: {
        editItem(item) {
            // Handle edit logic here
            console.log("Edit item:", item);
        },
        deleteItem(item) {
            // Handle delete logic here
            console.log("Delete item:", item);
        },
    },
};
</script>

<style scoped>
.margin {
    width: 90%;
    height: 90%;
    margin: 0 auto;
}
v-btn {
    padding: 2px;
    margin-right: 2px;
}
.black {
    color: black;
}
</style>
