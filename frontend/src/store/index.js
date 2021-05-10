import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import createPersistedState from "vuex-persistedstate";


// Modules
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    app,
    appConfig,
    verticalMenu,
		auth,
  },
  strict: process.env.DEV,
  plugins: [createPersistedState()]
})
