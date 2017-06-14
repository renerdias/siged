/**
 * Módulo: Backup
 */
import * as actions from './BackupActions'

const state = {
    backups: []
}

const mutations = {
    /**
     *
     * @param {type} state
     * @param {type} backup
     * @returns {undefined}
     */
    LIMPAR_BACKUP (state) {
        state.backups = [];
    },
    /**
     *
     * @param {type} state
     * @param {type} backups
     * @returns {undefined}
     */
    CARREGAR_BACKUPS (state, backups) {
        state.backups = backups;
    },
    /**
     *
     * @param {type} state
     * @param {type} backup
     * @returns {undefined}
     */
    SALVAR_BACKUP (state, backup) {
        state.backups.push(backup);
    }
}

const getters = {
    /**
     *
     * @returns {String}
     */
    __listaBackups() {
        return state.backups
    }
}

export default  {
  namespaced: true,
    state,
    mutations,
    actions,
    getters
}
