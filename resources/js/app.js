require('./bootstrap');

import { createApp } from "vue";

import App from './vue/App.vue';
import router from './vue/router'
import store from './vue/store'

createApp(App).use(store).use(router).mount('#app');
