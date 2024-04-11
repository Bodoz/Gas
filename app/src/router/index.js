import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue')
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
      component: () => import('../views/GasView.vue')
    },
    {
      path: '/contatti',
      name: 'contatti',
      component: () => import('../views/ContattiView.vue')
    },
    {
      path: '/VisualizzaGas',
      name: 'visualizzaGas',
      component: () => import('../views/SingleGas.vue')
    },
    {
      path: '/registrati',
      name: 'Registrati',
      component: () => import('../views/RegistratiView.vue')
    }
  ]
})

export default router
