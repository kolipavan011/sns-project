/**
 * All route file for vidmin
 */

import DashBoard from '../view/Dashboard.vue';
import PostsList from '../view/PostsList.vue';
import TagsList from '../view/TagsList.vue';
import CategoryList from '../view/CategoryList.vue';
import MediaList from '../view/MediaList.vue';
import VidBot from '../view/VidBot.vue';
import Login from '../view/Login.vue';


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
    path: '/login',
    name : 'login',
    component: Login,
    meta: { auth: false}
  },
  {
    path: '/dash',
    name : 'dashboard',
    component: DashBoard,
    meta: { auth: true}
  },
  {
    path: '/tags',
    name : 'tags',
    component: TagsList,
    meta: { auth: true}

  },
  {
    path: '/posts',
    name : 'posts',
    component: PostsList,
    meta: { auth: true}
  },
  {
    path: '/category',
    name : 'category',
    component: CategoryList,
    meta: { auth: true}
  },
  {
    path: '/media',
    name : 'media',
    component: MediaList,
    meta: { auth: true}
  },
  {
    path: '/vidbot',
    name : 'vidbot',
    component: VidBot,
    meta: { auth: true}
  },
  {
    path: '/user',
    name : 'users',
    component: PostsList,
    meta: { auth: true}
  },
  {
    path: '/setting',
    name : 'setting',
    component: PostsList,
    meta: { auth: true}
  },
  { path: '/:pathMatch(.*)*', name: 'not-found', redirect: '/dash' },
]

export default routes;