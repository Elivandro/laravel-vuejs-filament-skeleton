import { createRouter, createWebHistory } from 'vue-router';

import HomeView from '@/pages/HomeView.vue'
import AboutView from '@/pages/AboutView.vue'
import ContactView from '@/pages/ContactView.vue'

const routes = [
    { path: '/', name: 'home', component: HomeView },
    { path: '/about', name: 'about', component: AboutView },
    { path: '/contact', name: 'contact', component: ContactView },
]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})

