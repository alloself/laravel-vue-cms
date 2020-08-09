import Vue from 'vue'

export const tableFilters = {
    namespaced: true,
    state: {
        params: {},
        options: {}
    },
    actions: {
        setTableOptions({ commit }, payload) {
            commit('setTableOptions', payload);
        },
        setParam({ commit }, payload) {
            commit('setParam', payload);
        },
        toggleCompare({ commit }, payload) {
            commit('toggleCompare', payload);
        },
    },
    mutations: {
        setTableOptions(state, payload) {
            Vue.set(state.options, payload.module, payload.data)
        },
        setParam(state, payload) {
            if (Array.isArray(payload.value) && payload.value.length === 0) {
                Vue.delete(state.params[payload.module], [payload.key])
            }
            else if (payload.value === null) {
                Vue.delete(state.params[payload.module], [payload.key])
            }
            else {
                Vue.set(state.params, payload.module, { ...state.params[payload.module], [payload.key]: payload.value })
            }
        },
        toggleCompare(state, payload) {
            const value = state.params[payload.module][payload.key].map((item, index) => index === payload.index ? item.toString().indexOf('!') > -1 ? `${item}`.replace(/!/, '') : `!${item}` : item)
            Vue.set(state.params, payload.module, { ...state.params[payload.module], [payload.key]: value })
        },
    }
};


