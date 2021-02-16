require('./bootstrap');

window.Vue = require('vue').default;


import App from "./components/App";
import Vuelidate from "vuelidate";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import router from './router'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(Vuelidate)

Vue.prototype.$baseURL = location.protocol + '//' + location.host

export const eventEmitter = new Vue()

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
