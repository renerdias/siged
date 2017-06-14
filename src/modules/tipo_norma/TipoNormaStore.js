/**
 * Módulo: TipoNorma
 */
import * as actions from './TipoNormaActions'

const state = {
    tipos_normas: []
}

const mutations = {
    /**
     *
     * @param {type} state
     */
    LIMPAR (state) {
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
    DEFINIR_TIPO_NORMAS (state, tipos_normas) {
        state.tipos_normas = tipos_normas;
    }
}

const getters = {
    /**
     *
     * @returns {String}
     */
    __listaTiposNormas() {
        return state.tipos_normas
    }
}

export default  {
  namespaced: true,
    state,
    mutations,
    actions,
    getters
}
