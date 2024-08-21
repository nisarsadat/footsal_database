<template>
    <div class="Animation">
        <Head />
        <Animation />
    </div>

    <div class="hama">
        <div class="container">
            <div class="grid-item" @update:options="FetchownerPickups">
                <CustomerNames />
            </div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
        </div>
    </div>
</template>

<script>
import Animation from "../../components/Animation.vue";
import AnimationGoalVue from "../../components/AnimationGoal.vue";
import Head from "../../components/head.vue";
import CustomerNames from "./CustomerNames.vue";
export default {
    name: "MiddlePart",
    components: {
        Head,
        Animation,
        AnimationGoalVue,
        CustomerNames
    },
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
    },
};
</script>

<style scoped>
/* CSS for MiddlePart */
.hama {
    width: 100%;
    height: 600px;
    margin-left: 120px;
    padding-top: 100px;
}

.container {
    display: grid;
    grid-template-columns: repeat(5, 1fr); /* 5 columns for the first row */
    grid-template-rows: auto; /* Three rows, height adjusts automatically */
    gap: 30px; /* Space between grid items */
    width: 100%;
    max-width: 100%; /* Fixed width */
    height: 100%;
    max-height: 100%; /* Fixed height */ /* Light grey background */
    padding-top: 30px;
    padding-bottom: 10px;
}

.grid-item {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 20px;
    width: 100%;
    height: 100%;
    border-radius: 6px;
    box-shadow: 0 0 10px 0 rgba(76, 76, 76, 0.27);
}
.Second {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 5 columns for the first row */
    grid-template-rows: auto; /* Three rows, height adjusts automatically */
    gap: 20px; /* Space between grid items */
    width: 100%;
    max-width: 100%; /* Fixed width */
    height: 120px;
    max-height: 120px; /* Fixed height */ /* Light grey background */
    padding-top: 12px;
}
.first {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    width: 335px;
    height: 120px;
    /* Default background color */
    font-size: 20px;
    border-radius: 6px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.27);
}
.third {
    display: grid;
    grid-template-columns: 2fr 1fr;
    /* 5 columns for the first row */
    grid-template-rows: auto; /* Three rows, height adjusts automatically */
    gap: 20px; /* Space between grid items */
    width: 100%;
    max-width: 100%; /* Fixed width */
    height: 100px; /* Fixed height */
    padding-top: 20px;
    /* Two fractions for the first div, one fraction for the second */ /* Adjust the width as needed */
}
.tow {
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    /* Default background color */
    font-size: 20px;
    width: 100%;
    border-radius: 6px;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.27);
}
.styled-div {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border-left: 10px solid #3498db; /* Blue border, 80% of total width */
    border-right: 8px dotted #e74c3c; /* Red border, 20% of total width */
    border-top: 10px solid #3498db; /* Blue border, 80% of total width */
    border-bottom: 8px dotted #e74c3c;
    color: #333;
    font-family: Arial, sans-serif;
    text-align: center;
    position: relative;
    margin-bottom: 20px;
}
.Animation {
    display: flex;
    flex-direction: row;
    margin: 0 auto;
    height: 200px;
    width: 900px;
    padding-top: 80px;
}
</style>
