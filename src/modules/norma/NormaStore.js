/**
 * Módulo: Norma
 */
import * as actions from './NormaActions'

const state = {
    normas: []
}

const mutations = {
    /**
     *
     * @param {type} state
     * @param {type} norma
     * @returns {undefined}
     */
    LIMPAR_NORMA (state) {
        state.normas = [];
    },
    /**
     *
     * @param {type} state
     * @param {type} normas
     * @returns {undefined}
     */
    CARREGAR_NORMAS (state, normas) {
        state.normas = normas;
    },
    /**
     *
     * @param {type} state
     * @param {type} norma
     * @returns {undefined}
     */
    SALVAR_NORMA (state, norma) {
        state.normas.push(norma);
    }
}

const getters = {
    /**
     *
     * @returns {String}
     */
    __listaNormas() {
        return state.normas
    }
}

export default  {
  namespaced: true,
    state,
    mutations,
    actions,
    getters
}
