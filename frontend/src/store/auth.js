import axios from 'axios'
import * as types from './mutation-types'

export default {

state: {
  user: null,
  isLoggedIn: localStorage.getItem('isLoggedIn')
},

	// getters
getters: {
  user: state => state.user,
  token: state => state.isLoggedIn,
  check: state => state.user !== null,
},



// mutations
mutations: {
  [types.SET_LOGIN] (state) {
    localStorage.setItem('isLoggedIn', 'true')
  },

  [types.FETCH_USER_SUCCESS] (state, { user }) {
    state.user = user
  },

  [types.FETCH_USER_FAILURE] (state) {
    state.token = null
    localStorage.removeItem('isLoggedIn')
  },

  [types.LOGOUT] (state) {
    state.user = null
    localStorage.removeItem('isLoggedIn')
  },

  [types.UPDATE_USER] (state, { user }) {
    state.user = user
  }
},


  actions: {
    async signIn ({ dispatch }, credentials) {
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/api/auth/login', credentials)
      await dispatch('setLogin');

      return dispatch('fetchUser');
      //return dispatch('me');
    },

/*
		async register ({ dispatch }, data) {
				await axios.post('/api/auth/register', data)
				await dispatch('setLogin');
				return dispatch('fetchUser');
		},
*/
		//copied from a github repo - laravel-sanctum-vue-spa
		setLogin ({ commit, dispatch }) {
    		commit(types.SET_LOGIN)
		  },

		  async fetchUser ({ commit }) {
		    try {
		      const { data } = await axios.get('/api/user')

		      commit(types.FETCH_USER_SUCCESS, { user: data })
		    } catch (e) {
		      commit(types.FETCH_USER_FAILURE)
		    }
		  },
			  updateUser ({ commit }, payload) {
			    commit(types.UPDATE_USER, payload)
			  },

        async signOut ({ commit }) {
          try {
            await axios.post('/api/auth/logout')
          } catch (e) { }

          commit(types.LOGOUT)
          //return dispatch('unset_user')
        },

			//


    async signOut_ ({ dispatch }) {
      await axios.get('/api/auth/logout')

      return dispatch('me')
    },
/*
    me_bkp ({ commit }) {
      return axios.get('/api/user').then((response) => {
        commit('SET_AUTHENTICATED', true)
        commit('SET_USER', response.data)
      }).catch(() => {
        commit('SET_AUTHENTICATED', false)
        commit('SET_USER', null)
      })
    },
*/
  unset_user ({ commit }) {
    return axios.get('/api/user').then((response) => {
      commit('SET_AUTHENTICATED', true)
      commit('SET_USER', response.data)
    }).catch(() => {
      commit('SET_AUTHENTICATED', false)
      commit('SET_USER', null)
    })
  },

		async me ({commit}){
			   try {
 		      const { data } = await axios.get('/api/user')
 		      commit(types.FETCH_USER_SUCCESS, { user: data })
					//commit(types.SET_LOGIN)
 		    } catch (e) {
 		      commit(types.FETCH_USER_FAILURE)
 		    }
		}
  }
}
