// v2.0
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/src/styles/main.sass'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

new Vue({
  vuetify: new Vuetify(opts)
}).$mount('#app')