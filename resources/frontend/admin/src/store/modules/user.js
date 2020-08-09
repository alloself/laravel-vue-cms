import { setValue, removeValue } from '@/utils';
import { TOKEN, BASE_URL } from '@/const';
export const user = {
  namespaced: true,
  state: {
    user: null,
    token: null
  },
  actions: {
    async getUser({ commit, rootState }) {
      const { data } = await rootState.client.get('user')
      commit('SET_USER', data.user)
    },
    async login({ commit, dispatch, rootState,state }, { email, password }) {
      const { data: { token } } = await rootState.client.post(`${BASE_URL}/login`, {
        email,
        password
      })
      commit('SET_TOKEN', token)
      setValue(TOKEN, token)
      await dispatch('initClient', null, { root: true });
      if (!state.user)
        await dispatch('getUser');
    },
    async logout({ commit, state, rootState }, router) {
      router.push({ name: "Login" })
      await rootState.client.post('/logout', {
        id: state.user.id
      })
      removeValue(TOKEN);
      commit('SET_TOKEN', null)
    }
  },
  mutations: {
    SET_USER(state, data) {
      state.user = data
    },
    SET_TOKEN(state, data) {
      state.token = data
    },
  }
}