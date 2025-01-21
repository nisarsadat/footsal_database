<template>
    <v-card :elevation="0" class="rounded-xl">
        <template v-slot:prepend>
            <v-btn
                icon="mdi mdi-drag"
                flat
                fluid
                class="drag"
                size="small"
            ></v-btn>
            <div class="text-[12px]">
                {{ pageTitle }}
                <span class="text-[18px]">{{ pageSubtitle }}</span>
            </div>
        </template>

        <template v-slot:append>
            <div class="d-flex justify-center text-center mt-6 pr-1">
                <v-autocomplete
                    variant="outlined"
                    label="Language"
                    density="compact"
                    :items="local"
                    item-title="name"
                    item-value="id"
                    :return-object="false"
                    class="w-40 text-red-700"
                    @change="changeLanguage"
                ></v-autocomplete>
            </div>
            <v-btn
                icon="mdi-crop-free"
                flat
                fluid
                class="icon bgjan"
                size="small"
            ></v-btn>

            <v-btn
                icon="mdi-bell-ring-outline"
                flat
                fluid
                class="icon bgjan"
                size="small"
            ></v-btn>
        </template>
    </v-card>
</template>

<script setup>
import { ref, reactive, watchEffect } from "vue";  // Added watchEffect here

const pageTitle = ref("");
const pageSubtitle = ref("");

const props = defineProps({
    title: String,
    subtitle: String,
});

watchEffect(() => {
    pageTitle.value = props.title;
    pageSubtitle.value = props.subtitle;
});

const local = reactive([
    { id: "Dari", name: "Dari" },
    { id: "Pashto", name: "Pashto" },
    { id: "English", name: "English" }
]);

const locale = ref(local[0].id); // Initialize with the default language

function changeLanguage(lang) {
    console.log("Changing language to:", lang);
    locale.value = lang;
    console.log("Current locale:", locale.value);
}
</script>

<style scoped>
.drag, .icon {
    background-color: inherit;
    padding: 12px;
    border-radius: 12px;
    margin: 4px;
}
.bgjan
{
    background-color: #ffcdcdf3 !important;

}
</style>
