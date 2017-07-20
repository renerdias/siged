/**
 * Módulo: Backup
 */
import * as backupService from './BackupService';

//TODO: Criar busca paginada
/**
 *
 * @param {type} commit
 */
export const _limparBackup = ({
  commit
}) => {
  commit('LIMPAR_BACKUP')
}
/**
 * Obtém todos os backups
 */
export const _obterTodosBackups = ({
  commit,
  dispatch
}) => {
  backupService.todos()
    .then((response, erro) => {
      let resultado = response.data;
      if (resultado.execucao == "sucesso") {
        commit('CARREGAR_BACKUPS', resultado.dados);
      } else if (resultado.execucao == "erro") {
        notyf.alert(resultado.mensagem);
        console.error(resultado.log);
      }
    })
    .catch((erro) => {
      notyf.alert('Ocorreu um erro desconchecido!');
      console.error('Módulo Backup: ' + erro);
    })
}
