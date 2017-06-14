/**
 * Módulo: Perfil
 */
import * as actions from './PerfilActions'

const state = {
    perfis: []
}

const mutations = {
    /**
     *
     * @param {type} state
     * @param {type} perfil
     * @returns {undefined}
     */
    LIMPAR_PERFIL (state) {
        state.perfis = [];
    },
    /**
     *
     * @param {type} state
     * @param {type} perfis
     * @returns {undefined}
     */
    CARREGAR_PERFILS (state, perfis) {
        state.perfis = perfis;
    },
    /**
     *
     * @param {type} state
     * @param {type} perfil
     * @returns {undefined}
     */
    SALVAR_PERFIL (state, perfil) {
        state.perfis.push(perfil);
    }
}

const getters = {
    /**
     *
     * @returns {String}
     */
    __listaPerfis() {
        return state.perfis
    }
}

export default  {
  namespaced: true,
    state,
    mutations,
    actions,
    getters
}
