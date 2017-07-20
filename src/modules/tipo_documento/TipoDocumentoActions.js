/**
 * Módulo: TipoDocumento
 */
import * as tipo_documentoService from './TipoDocumentoService';
/**
 *
 * @param {type} commit
 */
export const _limpar = ({
  commit
}) => {
  commit('LIMPAR')
}
/**
 * Obtém todos os tipos_normas
 */
export const _todosTiposDocumentos = ({
  commit,
  dispatch
}) => {
  return new Promise((resolve, reject) => {
    tipo_documentoService.todos()
      .then((response, erro) => {
        let resultado = response.data;
        if (resultado.execucao == "sucesso") {
          resolve(true);
          /*
          Esse reject é capturado pelo catch logo abaixo
          return Promise.reject('2');
          */
          commit('DEFINIR_TIPOS_DOCUMENTOS', resultado.dados);
        } else if (resultado.execucao == "erro") {
          resolve(false);
          notyf.alert(resultado.mensagem);
          console.error(resultado.log);
        }
      })
      .catch((erro) => {
        notyf.alert('Ocorreu um erro desconchecido!');
        console.error('Módulo TipoDocumento: ' + erro);
      })
  })
}
