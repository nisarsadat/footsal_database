<script setup>
import Header from "@/components/UI/Header.vue";
import { useExpenseRepository } from "@/store/ExpenseRepository";
import { useAuthRepository } from "@/store/AuthRepository";

import CreateExpenseCategory from "./CreateExpenseCategory.vue";
import UpdateExpenseCategory from "./UpdateExpenseCategory.vue";
import { ref } from "vue";
let ExpenseRepository = useExpenseRepository();
ExpenseRepository.fetchExpenseCategories();
let AuthRepository = useAuthRepository();

const selectedIds = ref([]);
const selectAll = false;
const showSelect = true;
const headers = [
    { title: "CATEGORY", key: "name", sortable: false },
    { title: "DETAILS", key: "details", sortable: false },
    { title: "Action", key: "actions", sortable: false, align: "end" },
];
const editItem = (item) => {
    ExpenseRepository.ExpenseCategory = {};
    if (Object.keys(ExpenseRepository.ExpenseCategory).length === 0) {
        ExpenseRepository.fetchExpenseCategory(item.id)
            .then(() => {
                // Data has been fetched successfully, now set dialog to true
                ExpenseRepository.updateDailog = true;
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
                // Display  message
            });
    }
};
const deleteItems = async () => {
    const idsToDelete = selectedIds._rawValue;
    const idsObject = {
        expenseCategoryIds: idsToDelete,
    };
    // Convert the object to a JSON string
    const ids = idsObject;
    if (ids.length === 0) {
        return;
    }
    await ExpenseRepository.DeleteExpenseCategories(ids);
    // Clear the selected items after deletion
    selectedIds.value = [];
};
const deleteItem = async (item) => {
    await ExpenseRepository.DeleteExpenseCategory(item.id);
};
const createPopUp = (item) => {
    ExpenseRepository.createDailog = true;
};
</script>
<template>
    <UpdateExpenseCategory v-if="ExpenseRepository.updateDailog" />
    <CreateExpenseCategory v-if="ExpenseRepository.createDailog" />
    <div class="relative sm:rounded-lg pt-20 pr-8">
        <!-- in this part i import header for breadcrumbs  -->
        <Header mainTitle="Expenses" subTitle="Expense Category" />
        <v-layout class="py-5">
            <v-row class="justify-space-between">
                <v-col cols="12" sm="3">
                    <v-text-field
                        v-model="ExpenseRepository.expenseCategorySearch"
                        label="Search"
                        prepend-inner-icon="mdi-magnify"
                        variant="outlined"
                        name="search"
                        density="compact"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" sm="2">
                    <v-btn
                        v-if="
                            AuthRepository.permissions &&
                            AuthRepository.permissions.includes(
                                'createExpenseCategory'
                            )
                        "
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
                                v-model:items-per-page="
                                    ExpenseRepository.itemsPerPage
                                "
                                :headers="headers"
                                :items-length="ExpenseRepository.totalItems"
                                :items="ExpenseRepository.expenseCategories"
                                :loading="ExpenseRepository.loading"
                                :search="
                                    ExpenseRepository.expenseCategorySearch
                                "
                                item-value="id"
                                @update:options="
                                    ExpenseRepository.fetchExpenseCategories
                                "
                                :item-key="ExpenseRepository.expenseCategories"
                                itemKey="id"
                                :select-all="selectAll"
                                :show-select="showSelect"
                                v-model="selectedIds"
                                hover
                            >
                                <template
                                    v-slot:top
                                    v-if="
                                        AuthRepository.permissions &&
                                        AuthRepository.permissions.includes(
                                            'deleteAllExpenseCategory'
                                        )
                                    "
                                >
                                    <v-toolbar v-if="selectedIds.length !== 0">
                                        <v-toolbar-title class="text-red"
                                            >{{ selectedIds.length }} Row
                                            Selected</v-toolbar-title
                                        >
                                        <v-divider
                                            class="mx-4"
                                            inset
                                            vertical
                                        ></v-divider>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            @click="deleteItems"
                                            :disabled="selectedIds.length === 0"
                                            class="bg-red-darken-1 text-white"
                                        >
                                            Delete Selected
                                        </v-btn>
                                    </v-toolbar>
                                </template>
                                <template
                                    v-slot:item.actions="{ item }"
                                    class="right"
                                    v-if="
                                        AuthRepository.permissions &&
                                        (AuthRepository.permissions.includes(
                                            'editExpenseCategory'
                                        ) ||
                                            AuthRepository.permissions.includes(
                                                'deleteExpenseCategory'
                                            ))
                                    "
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
                                                    v-if="
                                                        AuthRepository.permissions &&
                                                        AuthRepository.permissions.includes(
                                                            'editExpenseCategory'
                                                        )
                                                    "
                                                    @click="editItem(item)"
                                                    class="cursor-pointer d-flex gap-3 justify-left pb-3"
                                                >
                                                    <v-icon color="gray"
                                                        >mdi-square-edit-outline</v-icon
                                                    >
                                                    Edit
                                                </v-list-item-title>

                                                <v-list-item-title
                                                    v-if="
                                                        AuthRepository.permissions &&
                                                        AuthRepository.permissions.includes(
                                                            'deleteExpenseCategory'
                                                        )
                                                    "
                                                    class="cursor-pointer d-flex gap-3"
                                                    @click="deleteItem(item)"
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
