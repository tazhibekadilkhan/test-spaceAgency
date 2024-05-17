import { createRouter, createWebHistory } from 'vue-router'

import CategoryIndex from './components/Category/Index.vue'
import CategoryCreate from './components/Category/Create.vue'
import CategoryUpdate from './components/Category/Update.vue'

import PostIndex from './components/Post/Index.vue'
import PostCreate from './components/Post/Create.vue'
import PostUpdate from './components/Post/Update.vue'
import PostShow from './components/Post/Show.vue'


import Login from './components/Login.vue'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/categories',
        name: 'categoryIndex',
        component: CategoryIndex
    },
    {
        path: '/categories/create',
        name: 'categoryCreate',
        component: CategoryCreate
    },
    {
        path: '/categories/edit/:id',
        name: 'categoryUpdate',
        component: CategoryUpdate
    },
    {
        path: '/posts',
        name: 'postIndex',
        component: PostIndex
    },
    {
        path: '/posts/create',
        name: 'postCreate',
        component: PostCreate
    },
    {
        path: '/posts/edit/:id',
        name: 'postUpdate',
        component: PostUpdate
    },
    {
        path: '/posts/show/:id',
        name: 'postShow',
        component: PostShow
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
