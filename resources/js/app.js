require('./bootstrap')

import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";

import App from './app/views/App'
import Queue from './app/views/Queue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'index',
            component: Queue,
            meta: {
                title: 'Queue',
            }
        },
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');



