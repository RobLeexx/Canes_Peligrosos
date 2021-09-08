import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import one from './components/pages/onePage'
import two from './components/pages/twoPage'

const routes = [
    {
        path: '/uno',
        component: one
    },
    {
        path: '/dos',
        component: two
    }
]

export default new Router({
    mode: 'history',
    routes
})