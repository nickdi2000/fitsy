import Vue from 'vue'
import { ToastPlugin, ModalPlugin } from 'bootstrap-vue'
import VueCompositionAPI from '@vue/composition-api'

import store from '@/store'
import { mapGetters } from 'vuex'

import router from './router'
//import store from './store'
import App from './App.vue'

// Global Components
import './global-components'

//nickdi
import axios from 'axios'
axios.defaults.withCredentials = true;
axios.defaults.baseURL = process.env.APP_URL; //'http://fitsy.local:89/';
window.axios = require('axios');

import { showToast } from '@core/mixins/showToast'
Vue.mixin(showToast);

import { showModal } from '@/mixins/showModal'
Vue.mixin(showModal);

//end nickdi



// 3rd party plugins
import '@/libs/portal-vue'
import '@/libs/toastification'

// BSV Plugin Registration
Vue.use(ToastPlugin)
Vue.use(ModalPlugin)

// Composition API
Vue.use(VueCompositionAPI)

// import core styles
require('@core/scss/core.scss')

// import assets styles
require('@/assets/scss/style.scss')

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
