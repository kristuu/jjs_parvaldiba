import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegionView from '../views/Regions/View.vue'
import RegionCreate from '../views/Regions/Create.vue'
import RegionEdit from '../views/Regions/Edit.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    {
      path: '/regions',
      name: 'regions',
      component: RegionView
    },
    {
      path: '/regions/create',
      name: 'regionCreate',
      component: RegionCreate
    },
    {
      path: '/region/:id/edit',
      name: 'regionEdit',
      component: RegionEdit
    }
  ]
})

export default router
