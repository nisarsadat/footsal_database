<template>
    <div class="boxShadow">
        <div
        class="d-flex pb-6 text-3xl font-semibold leading-snug font-serif margin"
        flat
    >
        <v-card-text class="alph"
            >||<strong class="book">
                <span class="mdi mdi-expansion-card-variant "></span>
               CREATE EXPENSE</strong
            ></v-card-text
        >
    </div>
    <v-form @submit.prevent class="margin">
        <div class="" width="50%">
            <v-text-field
                v-model="firstName"
                :rules="rules"
                label="Name"
                variant="outlined"
            ></v-text-field>
            <v-text-field
                v-model="amount"
                :rules="rules"
                label="amount"
                variant="outlined"
                type="number"
            ></v-text-field>
            <v-text-field
                v-model="date"
                :rules="rules"
                label="Date"
                variant="outlined"
                type="date"
            ></v-text-field>
            <v-textarea
                v-model="note"
                :rules="rules"
                label="Note"
                variant="outlined"
            ></v-textarea>
        </div>
        <v-btn class="mt-2 w-1/2" type="submit" block>Submit</v-btn>
    </v-form>
    </div>
</template>
<script>
export default {
    data: () => ({
        firstName: "",
        amount: "",
        date: "",
        note: "",

        rules: [
            (value) => {
                if (value) return true;

                return "You must enter a first name.";
            },
        ],
    }),
};
</script>
<style>
.book {
    font-size: 18px;
    font-weight: bolder;
    letter-spacing: 12px;
    line-height: 3;
}
.alph {
    font-size: 18px;
    font-weight: bolder;
    line-height: 3;
}
.boxShadow
{
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    width: 100%;
    height: 100%;
    padding-bottom: 20px;
    margin-top: 30px;

}
.margin
{
    width: 90%;
    height: 90%;
    margin: 0 auto;
}
</style>
