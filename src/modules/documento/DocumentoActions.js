/**
 * Módulo: Documento
 */
import * as normaService from './DocumentoService';

//TODO: Criar busca paginada
/**
 *
 * @param {type} commit
 */
export const _limparDocumento = ({
  commit
}) => {
  commit('LIMPAR_DOCUMENTO')
}
/**
 * Obtém todos os normas
 */
export const _obterTodasDocumentos = ({
  commit,
  dispatch
}) => {
  normaService.todos()
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_DOCUMENTOS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Documento: ' + erro);
    })
}
/**
 * Pesquisa documento por nome
 */
export const _pesquisarDocumentoPorNome = ({
  commit,
  dispatch
}, nome) => {
  normaService.pesquisarPorNome(nome)
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_DOCUMENTOS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Documento: ' + erro);
    })
}
/**
 * Pesquisa documento por id
 */
export const _pesquisarDocumentoPorId = ({
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
        console.error('Módulo Documento: ' + erro);
      })
  })
}
/**
 * Salvar documento
 */
//REVIEW: É realizado um novo carregamento de todos os documento ao salvar, isso é necessário?
export const _salvarDocumento = ({
  commit,
  dispatch
}, documento) => {
  return new Promise((resolve, reject) => {
    normaService.salvar(documento)
      .then((response, erro) => {
        let resultado = response.data;
        if (resultado.execucao == 'sucesso') {
          notyf.confirm(resultado.mensagem);
          //commit('SALVAR_DOCUMENTO', documento);
          //dispatch('_obterTodosDocumentos');
          resolve();
        } else if (resultado.execucao == 'erro') {
          notyf.alert(resultado.mensagem);
          console.error(resultado.log);
          reject(resultado.mensagem)
        }
      })
      .catch((erro) => {
        notyf.alert('Ocorreu um erro desconchecido!');
        console.error('Módulo Documento: ' + erro);
      })
  })
}









/**
 * Pesquisa documento por municipio
 */
export const _pesquisarDocumentoPorMunicipio = ({
  commit,
  dispatch
}, id) => {
  normaService.pesquisarPorMunicipio(id)
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_DOCUMENTOS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Documento: ' + erro);
    })
}
