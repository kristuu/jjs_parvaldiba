import './assets/main.css';

import { createApp } from 'vue';
import App from './App.vue';
import axios from 'axios';
import router from './router';
import Auth from '@/services/Auth.js';

const app = createApp(App);

app.config.globalProperties.$axios = axios;
app.config.globalProperties.$auth = Auth;

app.use(router);
app.mount('#app');
