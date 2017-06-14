/*
 * Importa dependências básicas
 */
import Vue from 'vue';
import Vuex from 'vuex';
Vue.use(Vuex);

/**
 * Importa os modulos
 */
import backup from '../modules/backup/BackupStore';
import funcionalidade from '../modules/funcionalidade/FuncionalidadeStore';
import norma from '../modules/norma/NormaStore';
import perfil from '../modules/perfil/PerfilStore';
import tipo_norma from '../modules/tipo_norma/TipoNormaStore';
import usuario from '../modules/usuario/UsuarioStore';


export default new Vuex.Store({
  modules: {
    backup,
    funcionalidade,
    norma,
    perfil,
    tipo_norma,
    usuario
  }
})
