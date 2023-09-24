/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';
import { createApp } from 'vue';
import Toaster from "@meforma/vue-toaster";
import router from './router';
import request from './mixins/request';
import App from './view/App.vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp(App)
    .use(router)
    .use(Toaster, { duration: 2000, position: 'top'})
    .mixin(request)
    .mount('#app');