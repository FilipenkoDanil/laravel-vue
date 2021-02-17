require('./bootstrap');

window.Vue = require('vue').default;


import App from "./components/App";
import Vuelidate from "vuelidate";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import {router, baseURL} from './router'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(Vuelidate)


export const eventEmitter = new Vue()

const app = new Vue({
    el: '#app',
    data() {
        return {
            baseURL: baseURL
        }
    },
    router,
    render: h => h(App)
});
