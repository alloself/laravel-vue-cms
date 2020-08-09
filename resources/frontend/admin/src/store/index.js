import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import { BASE_URL } from '@/const.js';
import * as modules from '@/store/modules';
import router from "@/router"
Vue.use(Vuex)

export default new Vuex.Store({
  strict: true,
  modules,
  state: {
    client: null,
    errorInterceptor: null
  },
  mutations: {
    SET_CLIENT(state, payload) {
      state.client = payload
    },
    SET_ERROR_INTERCEPTOR(state, payload) {
      if (state.errorInterceptor) {
        state.client.interceptors.response.eject(state.errorInterceptor);
      }
      state.errorInterceptor = payload
    },
  },
  actions: {
    initClient({ state, commit }) {
      commit('SET_CLIENT', axios.create({
        baseURL: `${BASE_URL}/auth/`,
        headers: { Authorization: `Bearer ${state.user.token}` },
        withCredentials: true
      }))
      commit('SET_ERROR_INTERCEPTOR', state.client.interceptors.response.use(
        (config) => config,
        (error) => {
          if (error.response.status === 401) {
            commit('user/SET_TOKEN', null);
            if (router.app.$route.name !== 'Login') router.push({ name: 'Login' })
          }
          return Promise.reject(error.response);
        },
      ))
    },
  }
})
