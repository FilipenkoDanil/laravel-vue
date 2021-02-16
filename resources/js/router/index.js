import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home'
import Checkout from "../views/Checkout";
import Login from "../views/Login";
import AdminPanel from "../views/AdminPanel";
import OrderInfo from "../views/OrderInfo";


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
        },
        {
            path: '/login',
            name: 'login',
            component: Login

        },
        {
            path: '/admin',
            name: 'admin-index',
            component: AdminPanel,
            beforeEnter: (to, from, next) => {
                axios.get('http://localhost:8000/api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({name: 'login'})
                })
            }
        },
        {
            path: '/order/:id',
            name: 'order-info',
            component: OrderInfo,
            beforeEnter: (to, from, next) => {
                axios.get('http://localhost:8000/api/authenticated').then(() => {
                    next()
                }).catch(() => {
                    return next({name: 'login'})
                })
            }
        }

    ],
    linkActiveClass: 'active'
})

export default router
