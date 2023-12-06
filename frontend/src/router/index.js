import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import UserView from '../views/Users/View.vue'
import UserCreate from '../views/Users/Create.vue'
import UserEdit from '../views/Users/Edit.vue'
import Login from '../views/Auth/login.vue'
import Register from '../views/Auth/register.vue'
import Dashboard from '../components/dashboard.vue'
import Auth from "@/services/Auth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/users',
      name: 'users',
      component: UserView,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/users/create',
      name: 'userCreate',
      component: UserCreate,
      meta: {
        requiresAuth: true
      }
    },
    {
      path: '/user/:id/edit',
      name: 'userEdit',
      component: UserEdit,
      meta: {
        requiresAuth: true
      }
    }
  ]
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth) ) {
    if (Auth.check()) {
      next();
      return;
    } else {
      router.push('/login');
    }
  } else {
    next();
  }
});

export default router
