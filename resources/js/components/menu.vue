<template>
    <div class="side h-full">
        <div class="mx-auto pa-2 side">
            <div class="avaatar">
                <v-card flat fluid class="">
                    <div class="ava side">
                        <img
                            class="h-20 rounded-xl w-20 side"
                            src="../assets/nisar.jpg"
                            alt="no photo"
                        />
                    </div>
                </v-card>
            </div>
        </div>

        <div flat class="scrollable-content side">
            <v-list v-model:opened="open">
                <v-list-group value="dashbord">
                    <template v-slot:activator="{ props }">
                        <router-link to="/" class="textD hover">
                            <v-list-item
                                v-bind="props"
                                :append-icon="null"
                                active-class="bg-[#cb0101af ] text-black "
                                prepend-icon="mdi mdi-graph-outline"
                                title="Dashboard"
                            ></v-list-item>
                        </router-link>
                    </template>
                </v-list-group>
                <v-list-group value="expence">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            :append-icon="null"
                            prepend-icon="mdi mdi-cash-edit"
                            title="EXPENSE"
                            active-class="bg-[#cb0101af ] text-black "
                            class="hover"
                        ></v-list-item>
                    </template>

                    <v-list-group value="allepense" class="hover mgleft">
                        <template v-slot:activator="{ props }">
                            <router-link to="/expense" class="textD">
                                <v-list-item
                                    prepend-icon="mdi mdi-expansion-card-variant"
                                    v-bind="props"
                                    :append-icon="null"
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
                    <v-list-group value="owenerpickup" class="hover mgleft">
                        <template v-slot:activator="{ props }">
                            <router-link class="textD" to="/owenerpickup">
                                <v-list-item
                                    prepend-icon="mdi mdi-account-tie"
                                    v-bind="props"
                                    :append-icon="null"
                                    title="Owner Pick Up"
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

                    <v-list-group value="expensecatagory" class="hover mgleft">
                        <template v-slot:activator="{ props }">
                            <router-link to="/expensecatagory" class="textD">
                                <v-list-item
                                    prepend-icon="mdi mdi-expansion-card"
                                    v-bind="props"
                                    :append-icon="null"
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
                <v-list-group value="people">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            prepend-icon="mdi mdi-account-group"
                            title="PEOPLE"
                            :append-icon="null"
                            active-class="bg-[#cb0101af ] text-black "
                            class="hover"
                        ></v-list-item>
                    </template>

                    <v-list-group value="customer" class="hover mgleft">
                        <template v-slot:activator="{ props }">
                            <router-link to="/customer" class="textD">
                                <v-list-item
                                    prepend-icon="mdi mdi-face-agent"
                                    v-bind="props"
                                    :append-icon="null"
                                    title="Customer"
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

                    <v-list-group value="owener" class="hover mgleft">
                        <template v-slot:activator="{ props }">
                            <router-link to="/people" class="textD">
                                <v-list-item
                                    prepend-icon="mdi mdi-account-key"
                                    v-bind="props"
                                    :append-icon="null"
                                    title="Owner"
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

                    <v-list-group value="user" class="hover mgleft">
                        <template v-slot:activator="{ props }">
                            <router-link to="/user">
                                <v-list-item
                                    :append-icon="null"
                                    prepend-icon="mdi mdi-account"
                                    v-bind="props"
                                    title="User"
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
                <v-list-group value="booking">
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            :append-icon="null"
                            prepend-icon="mdi mdi-book-plus"
                            active-class="bg-[#cb0101af ] text-black "
                            title="BOOKING"
                            class="hover"
                        ></v-list-item>
                    </template>

                    <v-list-group value="bookking" class="hover mgleft">
                        <template v-slot:activator="{ props }" flat>
                            <router-link to="/booking" class="textD">
                                <v-list-item
                                    prepend-icon="mdi mdi-book-plus"
                                    v-bind="props"
                                    :append-icon="null"
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
                    <v-list-group value="payment" class="hover mgleft">
                        <template v-slot:activator="{ props }">
                            <router-link to="/payment" class="textD"
                                ><v-list-item
                                    prepend-icon="mdi mdi-cash-sync"
                                    v-bind="props"
                                    :append-icon="null"
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
                <v-list v-model:opened="open">
                    <v-list-group value="setting">
                        <template v-slot:activator="{ props }">
                            <v-list-item
                                v-bind="props"
                                prepend-icon="mdi mdi-cog"
                                :append-icon="null"
                                title="SETTING"
                                class="hover"
                                active-class="bg-[#cb0101af ] text-black "
                            ></v-list-item>
                        </template>

                        <v-list-group value="hall" class="hover mgleft">
                            <template v-slot:activator="{ props }">
                                <router-link to="/hall" class="textD">
                                    <v-list-item
                                        prepend-icon="mdi mdi-town-hall"
                                        v-bind="props"
                                        :append-icon="null"
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

                        <v-list-group value="gemnasyom" class="hover mgleft">
                            <template v-slot:activator="{ props }">
                                <router-link to="/gemnasyom" class="textD">
                                    <v-list-item
                                        prepend-icon="mdi mdi-stadium"
                                        v-bind="props"
                                        :append-icon="null"
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
                </v-list>

                <v-list-group value="report" class="hover">
                    <template v-slot:activator="{ props }">
                        <router-link to="/report" class="textD">
                            <v-list-item
                                v-bind="props"
                                prepend-icon="mdi mdi-chart-areaspline-variant"
                                title="REPORT"
                                :append-icon="null"
                                active-class="bg-[#cb0101af ] text-black "
                            ></v-list-item>
                        </router-link>
                    </template>
                </v-list-group>
            </v-list>
        </div>
        <div class="d-flex person text-gray-600 side">
            <span class="imageBorder"
                ><img
                    src="../assets/nisar.jpg"
                    alt="Company Logo"
                    class="rounded-xl w-10 h-10 ml-2 bb"
                    cover
                    @click="logOUt"
                />
            </span>

            <div class="text">
                <span>Sayed Nisar Sadat</span>
                <span>nisarjo@gmail.com</span>
            </div>
        </div>
    </div>
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
.side {
    background-color: #f6f4f4;
}
.avaatar {
    width: 40%;
    height: 8rem;
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
    border-radius: 12px !important;
}
.textD {
    text-decoration: none;
    color: inherit;
}
.mgleft {
    margin-left: -30px;
}
.hover:hover {
    color: rgb(73, 3, 3);
}
.side {
    background-color: #f6f4f4;
}
.textD {
    text-decoration: none;
}
.scrollable-content {
    height: 70vh !important;
    overflow-y: auto;
}
.scrollable-content::-webkit-scrollbar {
    width: 4px;
}

.scrollable-content::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.scrollable-content::-webkit-scrollbar-thumb {
    background: #b1b1b1;
    border-radius: 4px;
}

.scrollable-content::-webkit-scrollbar-thumb:hover {
    background: #a6a5a5;
}
/* ======== */
/* Add smooth transition effect */
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(-10px);
    opacity: 1;
}
.person {
    border-top: 2px solid #cb0101af;
    padding-top: 12px;
}
.imageBorder {
    padding-right: 18px;
}
.text {
    display: flex;
    flex-direction: column;
    font-size: 12px;
}
.bb {
    border: 2px solid rgb(116, 115, 115);
    cursor: pointer;
}
</style>
