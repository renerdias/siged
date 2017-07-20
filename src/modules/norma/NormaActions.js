/**
 * Módulo: Norma
 */
import * as normaService from './NormaService';

//TODO: Criar busca paginada
/**
 *
 * @param {type} commit
 */
export const _limparNorma = ({
  commit
}) => {
  commit('LIMPAR_NORMA')
}
/**
 * Obtém todos os normas
 */
export const _obterTodasNormas = ({
  commit,
  dispatch
}) => {
  normaService.todos()
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_NORMAS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Norma: ' + erro);
    })
}
/**
 * Pesquisa norma por nome
 */
export const _pesquisarNormaPorNome = ({
  commit,
  dispatch
}, nome) => {
  normaService.pesquisarPorNome(nome)
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_NORMAS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Norma: ' + erro);
    })
}
/**
 * Pesquisa norma por id
 */
export const _pesquisarNormaPorId = ({
  commit,
  dispatch
}, id) => {
  return new Promise((resolve, reject) => {
    normaService.pesquisarPorId(id)
      .then((response, erro) => {
        let resultado = response.data;
        if (resultado.execucao == "sucesso") {
          resolve(resultado.dados);
        } else if (resultado.execucao == "erro") {
          notyf.alert(resultado.mensagem);
          console.error(resultado.log);
        }
      })
      .catch((erro) => {
        notyf.alert('Ocorreu um erro desconchecido!');
        console.error('Módulo Norma: ' + erro);
      })
  })
}
/**
 * Salvar norma
 */
//REVIEW: É realizado um novo carregamento de todos os norma ao salvar, isso é necessário?
export const _salvarNorma = ({
  commit,
  dispatch
}, norma) => {
  return new Promise((resolve, reject) => {
    normaService.salvar(norma)
      .then((response, erro) => {
        let resultado = response.data;
        if (resultado.execucao == 'sucesso') {
          notyf.confirm(resultado.mensagem);
          //commit('SALVAR_NORMA', norma);
          //dispatch('_obterTodosNormas');
          resolve();
        } else if (resultado.execucao == 'erro') {
          notyf.alert(resultado.mensagem);
          console.error(resultado.log);
          reject(resultado.mensagem)
        }
      })
      .catch((erro) => {
        notyf.alert('Ocorreu um erro desconchecido!');
        console.error('Módulo Norma: ' + erro);
      })
  })
}









/**
 * Pesquisa norma por municipio
 */
export const _pesquisarNormaPorMunicipio = ({
  commit,
  dispatch
}, id) => {
  normaService.pesquisarPorMunicipio(id)
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_NORMAS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Norma: ' + erro);
    })
}
