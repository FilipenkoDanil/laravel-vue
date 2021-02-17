import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const baseURL = location.protocol + '//' + location.host

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../views/Home')
        },
        {
            path: '/product-category/:category',
            name: 'productsByCategory',
            component: () => import('../views/Home')
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: () => import('../views/Checkout')
        },
        {
            path: '/login',
            name: 'login',
            component: () => import('../views/Login')

        },
        {
            path: '/admin',
            name: 'admin-index',
            component: () => import('../views/AdminPanel'),
            beforeEnter: (to, from, next) => {
                axios.get(`${baseURL}/api/authenticated`).then(() => {
                    next()
                }).catch(() => {
                    return next({name: 'login'})
                })
            }
        },
        {
            path: '/order/:id',
            name: 'order-info',
            component: () => import('../views/OrderInfo'),
            beforeEnter: (to, from, next) => {
                axios.get(`${baseURL}/api/authenticated`).then(() => {
                    next()
                }).catch(() => {
                    return next({name: 'login'})
                })
            }
        }

    ],
    linkActiveClass: 'active'
})

export {
    router,
    baseURL
}
