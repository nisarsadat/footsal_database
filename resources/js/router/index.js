// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Booking from '../pages/booking/booking.vue';
import Expense from '../pages/expenses/expense/Expense.vue';
import Hall from '../pages/seting/hall/hall.vue';
import Home from '../pages/dashbord/dashbord.vue';
import Report from '../pages/report/report.vue';
import Payment from '../pages/expenses/payment/payment.vue';
import People from '../pages/people/customer/people.vue';
import Customer from '../pages/people/customer/Customer1/index.vue';
import OwenerPickUp from '../pages/expenses/owener/owenerpickup.vue';
import Expensecatagory  from '../pages/expenses/expensecatagory/expensecatagory.vue';
import Gemnasyom from '../pages/seting/gemnasyom/gemnasyom.vue';
import User from '../pages/User/user.vue';


const routes = [
  { path: '/', component: Home },
  { path: '/booking', component: Booking },
  { path: '/expense', component: Expense },
  { path: '/report', component: Report },
  { path: '/hall', component: Hall },
  { path: '/payment', component: Payment },
  { path: '/customer', component: Customer },
  { path: '/people', component: People },
  { path: '/owenerpickup', component: OwenerPickUp },
  { path: '/expensecatagory', component: Expensecatagory },
  { path: '/gemnasyom', component: Gemnasyom },
  { path: '/user', component: User },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
