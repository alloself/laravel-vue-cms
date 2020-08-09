import Vue from 'vue'
import VueRouter from 'vue-router'
import { createCrudRoute } from './createCrudRoute';

Vue.use(VueRouter)

export const routes = [
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/pages/Login.vue')
  },
  {
    path: '/',
    name: "Auth",
    component: () => import('@/layouts/Auth.vue'),
    children: [
      ...createCrudRoute({
        title: "Страницы",
        basePath: 'page',
        icon: 'mdi-file'
      }),
      ...createCrudRoute({
        title: "Меню",
        basePath: 'menu',
        icon: 'mdi-menu-open'
      }),
      ...createCrudRoute({
        title: "Текст",
        basePath: 'text-block'
      }),
      ...createCrudRoute({
        title: "Wysiwyg",
        basePath: 'wysiwyg-block'
      }),
      ...createCrudRoute({
        title: "Карусель",
        basePath: 'carousel-block'
      }),
      ...createCrudRoute({
        title: "Карточка",
        basePath: 'card-block'
      }),
      {
        path: '*',
        redirect: '/page'
      }
    ]
  }
]

const router = new VueRouter({
  mode: 'history',
  base: '/admin/',
  routes
})

export default router
