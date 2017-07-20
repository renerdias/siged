/**
 * Módulo: Documento
 */
import * as actions from './DocumentoActions'

const state = {
    normas: []
}

const mutations = {
    /**
     *
     * @param {type} state
     * @param {type} documento
     * @returns {undefined}
     */
    LIMPAR_DOCUMENTO (state) {
        state.normas = [];
    },
    /**
     *
     * @param {type} state
     * @param {type} normas
     * @returns {undefined}
     */
    CARREGAR_DOCUMENTOS (state, normas) {
        state.normas = normas;
    },
    /**
     *
     * @param {type} state
     * @param {type} documento
     * @returns {undefined}
     */
    SALVAR_DOCUMENTO (state, documento) {
        state.normas.push(documento);
    }
}

const getters = {
    /**
     *
     * @returns {String}
     */
    __listaDocumentos() {
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
