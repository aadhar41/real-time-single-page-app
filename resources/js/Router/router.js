import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
import Logout from '../components/login/Logout'
import SignUp from '../components/login/signup'
import Forum from '../components/forum/Forum'
import Read from '../components/forum/read'
import Create from '../components/forum/create'
import CreateCategory from '../components/category/createCategory'

const routes = [{
        path: '/login',
        component: Login
    },
    {
        path: '/logout',
        component: Logout
    },
    {
        path: '/signup',
        component: SignUp
    },
    {
        path: '/category',
        component: CreateCategory,
        name: 'category'
    },
    {
        path: '/forum',
        component: Forum,
        name: 'forum'
    },
    {
        path: '/ask',
        component: Create,
    },
    {
        path: '/question/:slug',
        component: Read,
        name: 'read'
    }
]

const router = new VueRouter({
    routes, // short for `routes: routes`
    hashbang: false,
    mode: "history"
})

export default router
