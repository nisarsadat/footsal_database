<script setup>
defineProps(["mainTitle", "subTitle"]);
</script>
<template>
    <div class="flex items-center gap-2 border-dotted border-b-2 min-h-[80px]">
        <h1 class="menu-item text-[12px]">{{mainTitle }}</h1>
        <span class="h-[15px] border-l-2 pl-2"></span>
        <span class="roboto text-[24px] font-[400]">{{ subTitle}}</span>
    </div>
</template>
