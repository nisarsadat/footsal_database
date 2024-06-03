// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import Booking from '../pages/booking/booking.vue';
import Expense from '../pages/expenses/expense/epense.vue';
import Hall from '../pages/seting/hall.vue';
import Home from '../pages/dashbord/dashbord.vue';
import Report from '../pages/report/report.vue';
import Payment from '../pages/expenses/payment/payment.vue';
import People from '../pages/people/customer/people.vue';
import OwenerPickUp from '../pages/expenses/owener/owenerpickup.vue';
import Expensecatagory  from '../pages/expenses/expensecatagory/expensecatagory.vue';
import CreateExpense from '../pages/expenses/createexpense.vue';
import Gemnasyom from '../pages/seting/gemnasyom.vue';


const routes = [
  { path: '/', component: Home },
  { path: '/booking', component: Booking },
  { path: '/expense', component: Expense },
  { path: '/report', component: Report },
  { path: '/hall', component: Hall },
  { path: '/payment', component: Payment },
  { path: '/people', component: People },
  { path: '/owenerpickup', component: OwenerPickUp },
  { path: '/expensecatagory', component: Expensecatagory },
  { path: '/createexpense', component: CreateExpense },
  { path: '/gemnasyom', component: Gemnasyom },



];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
