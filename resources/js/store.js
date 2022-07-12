import Vue from 'vue';
import Vuex from 'vuex';
import Api from './api';

Vue.use(Vuex);

export default new Vuex.Store ({
    state: {
        count: 0,
        dicts: null,
    },

    mutations: {
        increment (state) {
            state.count++
        },
        setDicts (state, dicts) {
            state.dicts = { ...state.dicts, ...dicts };
        },
        updateDict: (state, {dict}) => {
            state.dicts = {...state.dicts, ...dict}
        },
    },

    actions: {
        initialize: async ({commit, state}, dictNames) => {
            await Api.initialize(dictNames, (dicts) => {
                commit('setDicts', dicts);
            });
        },
        fetchDict: ({ commit, state }, dictName) => {
            return new Promise((resolve, reject) => {
                Api.dict(dictName).then(({ data }) => {
                    commit('updateDict', { dict: data })
                    resolve()
                })
            })
        },

    },

    getters: {
        getDict: (state) => (dictName) => state.dicts[dictName] || [],

        getDictItemById: (state) => (dictName, id) => {
            const dict = state.dicts[dictName] || [];
            for (const i in dict) {
                if (dict[i].id === id) return dict[i];
            }
            return null;
        },
    }
});