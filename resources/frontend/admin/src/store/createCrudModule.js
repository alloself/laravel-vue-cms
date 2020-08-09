import merge from 'lodash/fp/merge';


export function createCrudModule(
    ns,
    options,
) {
    const route = options && options.url ? options.url : ns;
    const module = {
        namespaced: true,
        state: {
            loading: true,
            paginator: {
                results: []
            }
        },
        actions: {
            async getEntities({ commit, rootState }) {
                commit('SET_LOADING', true)
                const params = {};
                if (rootState.tableFilters.params[ns]) {
                    for (const [key, value] of Object.entries(rootState.tableFilters.params[ns])) {
                        if (value && value.length) {
                            params[key] = Array.isArray(value) ? value.join(',') : value
                        }
                    }
                }
                const sort = rootState.tableFilters.options[ns].sortBy.map((item, index) => {
                    return [item, rootState.tableFilters.options[ns].sortDesc[index] ? 'desc' : 'asc']
                })
                const { data } = await rootState.client.get(`/${route}`, { params: { ...params, per_page: rootState.tableFilters.options[ns].itemsPerPage, page: rootState.tableFilters.options[ns].page, sort } })
                commit('SET_ENTITIES', data)
                commit('SET_LOADING', false)
            },
            async getEntity({ rootState }, id) {
                const { data } = await rootState.client.get(`/${route}/${id}`)
                return data
            },
            async createEntity({ rootState }, entity) {
                return await rootState.client.post(route, entity).then(({ data }) => {
                    return data;
                });
            },
            async deleteEntity({ commit, rootState }, entity) {
                commit('SET_LOADING', true);
                await rootState.client.delete(`${route}/${entity.id}`)
                commit('SET_LOADING', false);
                return;
            },
            async updateEntity({ commit, rootState }, entity) {
                commit('SET_LOADING', true);
                const { data } = await rootState.client.put(`${route}/${entity.id}`, entity)
                commit('SET_LOADING', false);
                return data;
            },
        },
        mutations: {
            SET_LOADING(state, loading) {
                state.loading = loading;
            },
            SET_ENTITIES(state, payload) {
                state.paginator = payload
            }
        },
        getters: {
            items(state) {
                return state.paginator.data
            },
            total(state) {
                return state.paginator.total
            }
        },
    };
    return merge(module)(options);
}
