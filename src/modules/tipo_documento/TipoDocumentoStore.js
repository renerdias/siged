/**
 * Módulo: TipoDocumento
 */
import * as actions from './TipoDocumentoActions'

const state = {
  tipos_normas: []
}

const mutations = {
  /**
   *
   * @param {type} state
   */
  LIMPAR(state) {
    state.tipos_normas = [];
    //localStorage.removeItem("usuario");
    //Esvazia todas a keys da storage.
    //localStorage.clear();
  },
  /**
   *
   * @param {type} state
   * @param {type} tipos_normas
   * @returns {undefined}
   */
  DEFINIR_TIPOS_DOCUMENTOS(state, tipos_normas) {
    state.tipos_normas = tipos_normas;
  }
}
const getters = {
  /**
   *
   * @returns {String}
   */
  __listaTiposDocumentos() {
    return state.tipos_normas
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
