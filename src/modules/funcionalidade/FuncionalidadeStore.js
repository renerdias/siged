/**
 * Módulo: Funcionalidade
 */
import * as actions from './FuncionalidadeActions'

const state = {
    funcionalidades: []
}

const mutations = {
    /**
     *
     * @param {type} state
     * @param {type} funcionalidade
     * @returns {undefined}
     */
    LIMPAR_FUNCIONALIDADE(state) {
        state.funcionalidades = [];
    },
    /**
     *
     * @param {type} state
     * @param {type} funcionalidades
     * @returns {undefined}
     */
    CARREGAR_FUNCIONALIDADES(state, funcionalidades) {
        state.funcionalidades = funcionalidades;
    },
    /**
     *
     * @param {type} state
     * @param {type} funcionalidade
     * @returns {undefined}
     */
    SALVAR_FUNCIONALIDADE(state, funcionalidade) {
        state.funcionalidades.push(funcionalidade);
    }
}

const getters = {
    /**
     *
     * @returns {String}
     */
    __listaFuncionalidades() {
        return state.funcionalidades
    }
}

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
}
