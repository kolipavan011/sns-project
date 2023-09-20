/**
 * All route file for vidmin
 */

import DashBoard from '../view/Dashboard.vue';
import PostsList from '../view/PostsList.vue';


// 2. Define some routes
// Each route should map to a component.
// We'll talk about nested routes later.
const routes = [
  {
    path: '/',
    name: 'home',
    redirect: '/dash'
  },
  {
    path: '/dash',
    name : 'dash',
    component: DashBoard,
  },
  {
    path: '/tags',
    name : 'tags',
    component: PostsList,
  },
  { path: '/:pathMatch(.*)*', name: 'not-found', redirect: '/dash' },
]

export default routes;