const axios = window.axios;

const state = {
    tenant: null,
};

const getters = {
    tenant: state => state.tenant,
};

const actions = {

    getTenant({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get('/')
                .then(response => {
                    commit('setTenant', response.data.data);
                    resolve(response.data);
                })
                .catch(error => reject(error));
        });
    }

};

const mutations = {

    setTenant(state, tenant) {
        state.tenant = tenant;
    }

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
