import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home'
import Checkout from "../views/Checkout";


Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/product-category/:category',
            name: 'productsByCategory',
            component: Home
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout

        }
    ],
    linkActiveClass: 'active'
})

export default router
