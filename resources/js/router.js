import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import home from './Pages/test'
import one from './Pages/one'
import two from './Pages/two'
import three from './Pages/three'
import four from './Pages/four'

const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/uno',
        component: one
    },
    {
        path: '/dos',
        component: two
    },
    {
        path: '/tres',
        component: three
    },
    {
        path: '/cuatro',
        component: four
    }
]

export default new Router({
    mode: 'history',
    routes
})