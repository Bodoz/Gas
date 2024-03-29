import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import GasView from "@/views/GasView.vue";
import ContattiView from "@/views/ContattiView.vue";
import AccessoView from "@/views/AccessoView.vue";

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
      path: '/gas',
      name: 'Gas',
      component: GasView
    },
    {
      path: '/contatti',
      name: 'contatti',
      component: ContattiView
    },
    {
      path: '/accesso',
      name: 'Accedi/registrati',
      component: AccessoView
    }
  ]
})

export default router
