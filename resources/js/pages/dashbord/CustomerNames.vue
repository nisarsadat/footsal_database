<template>

    <v-data-table
        v-model:page="page"
        :headers="headers"
        :items="owners"
        :items-per-page="itemsPerPage"
    >
        <template v-slot:top>
            <!-- Optional content above the table -->
        </template>
        <template v-slot:bottom>
            <div class="text-center pt-2">
                <v-pagination v-model="page" :length="pageCount"></v-pagination>
            </div>
        </template>
    </v-data-table>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            page: 1,
            itemsPerPage: 5,
            headers: [
    {
        text: "Owner Name", // Display text for the header
        value: "name", // Key from the data objects to link to this column
        align: "start",
        sortable: false,
    }
]
,
            owners: [], // This will hold the fetched data
            pageCount: 0, // Total pages
        };
    },
    mounted() {
        this.fetchOwners();
    },
    methods: {
        async fetchOwners() {
            this.loading = true;
            try {
                const response = await axios.get("owners"); // Adjust this URL as needed
                // Access the nested array of owners correctly
                if (response.data && Array.isArray(response.data.data)) {
                    this.owners = response.data.data; // Assign the correct part of the response
                    this.pageCount = Math.ceil(
                        this.owners.length / this.itemsPerPage
                    ); // Calculate total pages based on the actual data length
                } else {
                    throw new Error("Received data is not in expected format");
                }
            } catch (error) {
                console.error("There was an error fetching the owners:", error);
                this.error =
                    error.message || "An error occurred while fetching data.";
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>
