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
/**
 * Pesquisa backup por nome
 */
export const _pesquisarBackupPorNome = ({
    commit,
    dispatch
}, nome) => {
    backupService.pesquisarPorNome(nome)
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
/**
 * Pesquisa backup por id
 */
export const _pesquisarBackupPorId = ({
    commit,
    dispatch
}, id) => {
    return new Promise((resolve, reject) => {
        backupService.pesquisarPorId(id)
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
                console.error('Módulo Backup: ' + erro);
            })
    })
}
/**
 * Salvar backup
 */
//REVIEW: É realizado um novo carregamento de todos os backup ao salvar, isso é necessário?
export const _salvarBackup = ({
    commit,
    dispatch
}, backup) => {
    return new Promise((resolve, reject) => {
        backupService.salvar(backup)
            .then((response, erro) => {
                let resultado = response.data;
                if (resultado.execucao == 'sucesso') {
                    notyf.confirm(resultado.mensagem);
                    //commit('SALVAR_BACKUP', backup);
                    //dispatch('_obterTodosBackups');
                    resolve();
                } else if (resultado.execucao == 'erro') {
                    notyf.alert(resultado.mensagem);
                    console.error(resultado.log);
                    reject(resultado.mensagem)
                }
            })
            .catch((erro) => {
                notyf.alert('Ocorreu um erro desconchecido!');
                console.error('Módulo Backup: ' + erro);
            })
    })
}









/**
 * Pesquisa backup por municipio
 */
export const _pesquisarBackupPorMunicipio = ({
    commit,
    dispatch
}, id) => {
    backupService.pesquisarPorMunicipio(id)
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
