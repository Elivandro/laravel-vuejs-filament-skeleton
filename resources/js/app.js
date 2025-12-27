import './bootstrap';
import { createApp, ref, h } from 'vue'
import { router } from '@/router'
import store from './store/index.js';
import App from '@/App.vue';

createApp(App)
    .use(store)
    .use(router)
    .mount('#app');