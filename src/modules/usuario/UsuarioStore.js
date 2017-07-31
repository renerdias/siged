/**
 * Module: usuario <> usuário
 */
import * as actions from './UsuarioActions'

/*
const novoUsuario = {
  id: '',
  nome: '',
  autenticado: false,
  token: '',
  perfil: {
    id: '',
    nome: ''
  }
}
*/
const novoUsuario = {}
const state = {
  usuarios: [],
  usuario: novoUsuario,
  autenticacao: {},
  falha_autenticacao: 0,
  permissao: []
}

const mutations = {
  /**
   *
   * @param {type} state
   * @returns {undefined}
   */
  SAIR_SISTEMA(state) {
    state.falha_autenticacao = 0;
    state.usuarios = []
    state.usuario = novoUsuario;
    state.autenticacao = {};
    state.permissao = [];
    //localStorage.removeItem("usuario");
    //Esvazia todas a keys da storage.
    localStorage.clear();
  },

  /**
   *
   * @param {type} state
   * @param {type} usuario
   * @returns {undefined}
   */
  LIMPAR_USUARIO(state) {
    state.usuarios = [];
    state.usuario = novoUsuario;
  },
  /**
   *
   * @param {type} state
   * @param {type} usuario
   * @returns {undefined}
   */
  AUTENTICACAO_SUCESSO(state, usuario) {
    state.autenticacao = usuario;
    state.falha_autenticacao = 0;
  },
  /**
   *
   * @param {type} state
   * @returns {undefined}
   */
  FALHA_AUTENTICACAO(state) {
    state.falha_autenticacao++
      state.autenticacao = novoUsuario; //Provsiõrio
    //  state.usuarios = []
  },
  /**
   *
   * @param {type} state
   * @param {type} erro
   * @returns {undefined}
   */
  ERRO_DESCONHECIDO(state, erro) {
    state.falha_autenticacao++
      state.autenticacao = novoUsuario; //Provsiõrio
    //state.usuarios = []
  },
  /**
   *
   * @param {type} state
   * @param {type} usuario
   * @returns {undefined}
   */
  CARREGAR_USUARIO(state, usuario) {
    state.usuario = usuario;
  },
  /**
   *
   * @param {type} state
   * @param {type} usuarios
   * @returns {undefined}
   */
  CARREGAR_USUARIOS(state, usuarios) {
    state.usuarios = usuarios;
  },
  /**
   *
   * @param {type} state
   * @param {type} usuarios
   * @returns {undefined}
   */
  CARREGAR_PERMISSOES(state, permissoes) {
    state.permissao = permissoes;
  },
  /**
   *
   * @param {type} state
   * @param {type} usuario
   * @returns {undefined}
   */
  SALVAR_USUARIO(state, usuario) {
    state.usuarios.push(usuario);
  }
}

const getters = {
  __permissao() {
    return state.permissao
  },
  /**
   *
   * @returns {String}
   */
  __listaUsuarios() {
    return state.usuarios
  },
  /**
   *
   * @returns {String}
   */
  token() {
    return state.autenticacao.token;
  },
  /**
   *
   * @returns {String}
   */
  usuarioAutenticado() {
    return state.autenticacao.nome
  },
  /**
   *
   * @returns {String}
   */
  usuarioAutenticadoPerfil() {
    return state.autenticacao.perfil.nome
  },
  /**
   *
   * @returns {state.usuario|newUser}
   */
  usuario() {
    return state.usuario
  },
  /**
   *
   * @returns {Boolean}
   */
  estaAutenticado() {
    return state.autenticacao.autenticado
  },
  /**
   * totalFalhasAutenticacao
   *
   * @returns {Number} Número de tentativas de autenticar
   */
  totalFalhasAutenticacao() {
    return state.falha_autenticacao;
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
