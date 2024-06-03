// resources/js/app.js
import '../css/app.css';

import './bootstrap';
import { createApp } from 'vue';
import App from './app.vue';
import '@mdi/font/css/materialdesignicons.min.css';
import axios from 'axios'

import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

import router from './router'; // Ensure the router import path is correct

const vuetify = createVuetify({
  components,
  directives,
});

const app = createApp(App);

app.config.globalProperties.$axios = axios; // This makes Axios available on all components via this.$axios
app.use(vuetify);
app.use(router); // Use the router
app.mount('#app');
