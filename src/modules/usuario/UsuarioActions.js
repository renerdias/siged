/**
 * Módulo: Usuario
 */
import * as usuarioService from './UsuarioService';

/**
 *
 * @param {type} commit
 */
export const _limparUsuario = ({
  commit
}) => {
  commit('LIMPAR_USUARIO')
}
/**
 *
 * @param {type} commit
 */
export const sairSistema = ({
  commit
}) => {
  commit('SAIR_SISTEMA')
}

/**
 * AutenticarUsuario
 * @param {type} credencial
 * @returns {Promise}
 */
export const autenticarUsuario = ({
  commit,
  dispatch
}, credencial) => {
  return new Promise((resolve, reject) => {
    usuarioService.autenticar(credencial)
      .then((response, erro) => {
        let resultado = response.data;
        if (resultado.execucao == "sucesso") {
          let usuario = resultado.dados;
          if (usuario.autenticado) {
            commit('AUTENTICACAO_SUCESSO', usuario);
            notyf.confirm('Olá ' + usuario.nome + ', seja bem-vindo(a)!');
            setTimeout(function() {
              notyf.confirm('Tenha um bom trabalho!');
            }, 3000);
            resolve()
          }
        } else if (resultado.execucao == "erro") {
          commit('FALHA_AUTENTICACAO');
          notyf.alert(resultado.mensagem);
          console.error(resultado.log);
          reject()
        }
      })
      .catch((erro) => {
        commit('ERRO_DESCONHECIDO', erro);
        notyf.alert('Ocorreu um erro desconchecido!');
        reject(erro)
      })
  })
}

/**
 * Obtém todos os usuarios
 */
export const _todosUsuarios = ({
  commit,
  dispatch
}) => {
  usuarioService.todos()
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_USUARIOS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Usuario: ' + erro);
    })
}
/**
 * Pesquisa usuario por nome
 */
export const _pesquisarUsuarioPorNome = ({
  commit,
  dispatch
}, nome) => {
  usuarioService.pesquisarPorNome(nome)
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_USUARIOS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Usuario: ' + erro);
    })
}
/**
 * Pesquisa usuario por id
 */
export const _pesquisarUsuarioPorId = ({
  commit,
  dispatch
}, id) => {

  return new Promise((resolve, reject) => {
    usuarioService.pesquisarPorId(id)
      .then((response, erro) => {
        let resultado = response.data;
        if (resultado.execucao == "sucesso") {
          commit('CARREGAR_USUARIO', resultado.dados);
          resolve(resultado.dados);
        } else if (resultado.execucao == "erro") {
          notyf.alert(resultado.mensagem);
          console.error(resultado.log);
        }
      })
      .catch((erro) => {
        notyf.alert('Ocorreu um erro desconchecido!');
        console.error('Módulo Usuario: ' + erro);
      })
  })
}

/**
 * Salvar usuario
 */
export const _salvarUsuario = ({
  commit,
  dispatch
}, usuario) => {
  return new Promise((resolve, reject) => {
    usuarioService.salvar(usuario)
      .then((response, erro) => {
        let resultado = response.data;
        if (resultado.execucao == 'sucesso') {
          notyf.confirm(resultado.mensagem);
          commit('SALVAR_USUARIO', usuario);
          commit('LIMPAR_USUARIO', '');
          resolve();
        } else if (resultado.execucao == 'erro') {
          notyf.alert(resultado.mensagem);
          console.error(resultado.log);
          reject(resultado.log)
        }
      })
      .catch((erro) => {
        notyf.alert('Ocorreu um erro desconchecido!');
        console.error('Módulo Usuario: ' + erro);
      })
  })
}
