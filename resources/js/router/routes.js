/**
 * All route file for vidmin
 */

import DashBoard from '../view/Dashboard.vue';
import PostsList from '../view/PostsList.vue';
import TagsList from '../view/TagsList.vue';
import CategoryList from '../view/CategoryList.vue';
import MediaList from '../view/MediaList.vue';
import VidBot from '../view/VidBot.vue';
import PostEdit from '../view/PostEdit.vue';


// 2. Define some routes
// Each route should map to a component.
// We'll talk about nested routes later.
const routes = [
  {
    path: '/',
    name: 'home',
    redirect: '/dash',
  },
  {
    path: '/dash',
    name : 'dashboard',
    component: DashBoard,
  },
  {
    path: '/tags',
    name : 'tags',
    component: TagsList,
  },
  {
    path: '/posts',
    name : 'posts',
    component: PostsList,
  },
  {
    path: '/posts/:id/edit',
    name : 'post-edit',
    component: PostEdit,
  },
  {
    path: '/category',
    name : 'category',
    component: CategoryList,
  },
  {
    path: '/media',
    name : 'media',
    component: MediaList,
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
  },
  {
    path: '/setting',
    name : 'setting',
    component: PostsList,
  },
  { path: '/:pathMatch(.*)*', name: 'not-found', redirect: '/dash' },
]

export default routes;