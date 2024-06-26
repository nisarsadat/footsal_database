<template>
    <v-card class="mx-auto pa-2" max-width="300" flat>
        <div class="avaatar">
            <v-avatar size="100" class="">
                <div class="ava">
                    <img src="../assets/nisar.jpg" alt="no photo" />
                </div>
            </v-avatar>
            <p class="mdi mdi-account mt-2"><strong>NISAR</strong></p>
        </div>
    </v-card>

    <v-card flat class="" width="400" >
        <v-list v-model:opened="open" >
            <v-list-group value="dashbord" >
                <template v-slot:activator="{ props }">
                    <router-link to="/" class="textD hover">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi mdi-home"
                            title="HOME"
                        ></v-list-item>
                    </router-link>
                </template>
            </v-list-group>
            <v-list-group value="expence" >
                <template v-slot:activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        prepend-icon="mdi mdi-cash-edit"
                        title="EXPENSE"
                        class="hover"
                    ></v-list-item>
                </template>
                <v-list-group value="createexpense" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link to="/createexpense" class="textD">
                            <v-list-item
                                prepend-icon="mdi mdi-expansion-card-variant"
                                v-bind="props"
                                title="Create Expence"
                            ></v-list-item>
                        </router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in admins"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>
                <v-list-group value="allepense" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link to="/expense" class="textD">
                            <v-list-item
                                prepend-icon="mdi mdi-expansion-card-variant"
                                v-bind="props"
                                title="All Expence"
                                class="text-xs"
                            ></v-list-item>
                        </router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in admins"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>
                <v-list-group value="owenerpickup" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link class="textD" to="/owenerpickup">
                            <v-list-item
                                prepend-icon="mdi mdi-account-tie"
                                v-bind="props"
                                title="Owener Pick Up"
                                class="text-xs"
                            ></v-list-item>
                        </router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in admins"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>

                <v-list-group value="expensecatagory" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link to="/expensecatagory" class="textD">
                            <v-list-item
                                prepend-icon="mdi mdi-expansion-card"
                                v-bind="props"
                                title="Expense Catagory"
                            ></v-list-item>
                        </router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in cruds"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>
            </v-list-group>
            <v-list-group value="people" >
                <template v-slot:activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        prepend-icon="mdi mdi-account-group"
                        title="PEOPLE"
                        class="hover"
                    ></v-list-item>
                </template>

                <v-list-group value="customer" class="hover">
                    <template v-slot:activator="{ props }">
                    <router-link to="/people" class="textD">
                        <v-list-item
                            prepend-icon="mdi mdi-face-agent"
                            v-bind="props"
                            title="Customer"
                        ></v-list-item></router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in admins"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>

                <v-list-group value="owener" class="hover">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            prepend-icon="mdi mdi-account-key"
                            v-bind="props"
                            title="Owener"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in cruds"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>

                <v-list-group value="user" class="hover">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            prepend-icon="mdi mdi-account"
                            v-bind="props"
                            title="User"
                        ></v-list-item>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in cruds"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>
            </v-list-group>
            <v-list-group value="booking" >
                <template v-slot:activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        prepend-icon="mdi mdi-book-plus"
                        title="BOOKING"
                        class="hover"
                    ></v-list-item>
                </template>

                <v-list-group value="bookking" class="hover">
                    <template v-slot:activator="{ props }" flat >
                        <router-link to="/booking" class="textD">
                            <v-list-item
                                prepend-icon="mdi mdi-book-plus"
                                v-bind="props"
                                title="Booking"
                            ></v-list-item>
                        </router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in admins"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>
                <v-list-group value="payment" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link to="/payment" class="textD"
                            ><v-list-item
                                prepend-icon="mdi mdi-cash-sync"
                                v-bind="props"
                                title="Payment"
                            ></v-list-item
                        ></router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in cruds"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>
            </v-list-group>
            <v-list-group value="setting" >
                <template v-slot:activator="{ props }">
                    <v-list-item
                        v-bind="props"
                        prepend-icon="mdi mdi-cog"
                        title="SETTING"
                        class="hover"
                    ></v-list-item>
                </template>

                <v-list-group value="hall" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link to="/hall" class="textD">
                            <v-list-item
                                prepend-icon="mdi mdi-town-hall"
                                v-bind="props"
                                title="Hall"
                            ></v-list-item>
                        </router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in admins"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>

                <v-list-group value="gemnasyom" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link to="/gemnasyom" class="textD">
                            <v-list-item
                                prepend-icon="mdi mdi-stadium"
                                v-bind="props"
                                title="Gemnasyom"
                            ></v-list-item>
                        </router-link>
                    </template>

                    <v-list-item
                        v-for="([title, icon], i) in cruds"
                        :key="i"
                        :prepend-icon="icon"
                        :title="title"
                        :value="title"
                    ></v-list-item>
                </v-list-group>
            </v-list-group>
            <v-list-group value="report" class="hover">
                <template v-slot:activator="{ props }">
                    <router-link to="/report" class="textD">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi mdi-chart-areaspline-variant"
                            title="REPORT"
                        ></v-list-item>
                    </router-link>
                </template>
            </v-list-group>
        </v-list>
    </v-card>
</template>
<script>
export default {
    data: () => ({
        name: "NavigationDrawer",
        open: ["Users"],
    }),
};
</script>

<style>
.avaatar {
    width: 40%;
    height: 12rem;
    margin: 0 auto;
    padding-top: 2rem;
    display: flex;
    flex-direction: column;
}
p {
    margin: 0 auto;
    padding-top: 12px;
}
.ava {
    display: inline-block;
    width: 100px;
    height: 100px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}
img {
    max-width: 100%;
    max-height: 100%;
    width: 110%;
    height: 200%;
}
.textD {
    text-decoration: none;
    color: inherit;
}
.hover:hover {
    color: rgb(20, 73, 120);
;}
.textD
{
    text-decoration: none;
}
</style>
