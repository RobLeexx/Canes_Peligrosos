require('./bootstrap');
window.Vue = require('vue')
import Vue from 'vue';
import router from './router';

Vue.config.productionTip = false
Vue.component('mainapp', require('./components/mainapp.vue').default)

const app = new Vue({
    el: "#app",
    router
})