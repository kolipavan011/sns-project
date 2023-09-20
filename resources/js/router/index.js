import { createRouter, createWebHistory } from 'vue-router';
import routes from './routes';

const router = new createRouter({
        history: createWebHistory('vidmin'),
        routes : routes
    });

export default router;