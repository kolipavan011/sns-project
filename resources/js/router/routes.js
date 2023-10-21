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
import TagEdit from '../view/TagEdit.vue';
import CategoryEdit from '../view/CategoryEdit.vue';
import PostView from '../view/PostView.vue';
import Profile from '../view/Profile.vue';


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
    path: '/tags/create',
    name : 'tag-create',
    component: TagEdit,
  },
  {
    path: '/tags/:id/edit',
    name : 'tag-edit',
    component: TagEdit,
  },
  {
    path: '/posts',
    name : 'posts',
    component: PostsList,
  },
  {
    path: '/posts/create',
    name : 'post-create',
    component: PostEdit,
  },
  {
    path: '/posts/:id/edit',
    name : 'post-edit',
    component: PostEdit,
  },
  {
    path: '/posts/:id/view',
    name : 'post-view',
    component: PostView,
  },
  {
    path: '/category',
    name : 'category',
    component: CategoryList,
  },
  {
    path: '/category/:id/edit',
    name : 'category-edit',
    component: CategoryEdit,
  },
  {
    path: '/category/create',
    name : 'category-create',
    component: CategoryEdit,
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
  {
    path: '/profile',
    name : 'profile',
    component: Profile,
  },
  { path: '/:pathMatch(.*)*', name: 'not-found', redirect: '/dash' },
]

export default routes;