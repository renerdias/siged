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
import documento from '../modules/documento/DocumentoStore';
import perfil from '../modules/perfil/PerfilStore';
import tipo_documento from '../modules/tipo_documento/TipoDocumentoStore';
import usuario from '../modules/usuario/UsuarioStore';


export default new Vuex.Store({
  modules: {
    backup,
    funcionalidade,
    documento,
    perfil,
    tipo_documento,
    usuario
  }
})
