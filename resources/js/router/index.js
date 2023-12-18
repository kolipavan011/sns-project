import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';
import NProgress from 'nprogress';

NProgress.configure({
    showSpinner: false,
    easing: 'ease',
    speed: 300,
});

const router = new createRouter({
    history: createWebHistory('vidmin'),
    routes : routes
});

/**
 * Configuration of router for safe state change between routes
 * Check whether user is logged in or not
 * then keep user on login route if unatheticated
 */

export default router;