/**
 * Módulo: Perfil
 */
import * as perfilService from './PerfilService';

//TODO: Criar busca paginada
/**
 *
 * @param {type} commit
 */
export const _limparPerfil = ({
    commit
}) => {
    commit('LIMPAR_PERFIL')
}
/**
 * Obtém todos os perfis
 */
export const _obterTodosPerfis = ({
    commit,
    dispatch
}) => {
    perfilService.todos()
        .then((response, erro) => {
            let resultado = response.data;
            if (resultado.execucao == "sucesso") {
                commit('CARREGAR_PERFILS', resultado.dados);
            } else if (resultado.execucao == "erro") {
                notyf.alert(resultado.mensagem);
                console.error(resultado.log);
            }
        })
        .catch((erro) => {
            notyf.alert('Ocorreu um erro desconchecido!');
            console.error('Módulo Perfil: ' + erro);
        })
}
/**
 * Pesquisa perfil por nome
 */
export const _pesquisarPerfilPorNome = ({
    commit,
    dispatch
}, nome) => {
    perfilService.pesquisarPorNome(nome)
        .then((response, erro) => {
            let resultado = response.data;
            if (resultado.execucao == "sucesso") {
                commit('CARREGAR_PERFILS', resultado.dados);
            } else if (resultado.execucao == "erro") {
                notyf.alert(resultado.mensagem);
                console.error(resultado.log);
            }
        })
        .catch((erro) => {
            notyf.alert('Ocorreu um erro desconchecido!');
            console.error('Módulo Perfil: ' + erro);
        })
}
/**
 * Pesquisa perfil por id
 */
export const _pesquisarPerfilPorId = ({
    commit,
    dispatch
}, id) => {
    return new Promise((resolve, reject) => {
        perfilService.pesquisarPorId(id)
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
                console.error('Módulo Perfil: ' + erro);
            })
    })
}
/**
 * Salvar perfil
 */
//REVIEW: É realizado um novo carregamento de todos os perfil ao salvar, isso é necessário?
export const _salvarPerfil = ({
    commit,
    dispatch
}, perfil) => {
    return new Promise((resolve, reject) => {
        perfilService.salvar(perfil)
            .then((response, erro) => {
                let resultado = response.data;
                if (resultado.execucao == 'sucesso') {
                    notyf.confirm(resultado.mensagem);
                    //commit('SALVAR_PERFIL', perfil);
                    //dispatch('_obterTodosPerfis');
                    resolve();
                } else if (resultado.execucao == 'erro') {
                    notyf.alert(resultado.mensagem);
                    console.error(resultado.log);
                    reject(resultado.mensagem)
                }
            })
            .catch((erro) => {
                notyf.alert('Ocorreu um erro desconchecido!');
                console.error('Módulo Perfil: ' + erro);
            })
    })
}









/**
 * Pesquisa perfil por municipio
 */
export const _pesquisarPerfilPorMunicipio = ({
    commit,
    dispatch
}, id) => {
    perfilService.pesquisarPorMunicipio(id)
        .then((response, erro) => {
            let resultado = response.data;
            if (resultado.execucao == "sucesso") {
                commit('CARREGAR_PERFILS', resultado.dados);
            } else if (resultado.execucao == "erro") {
                notyf.alert(resultado.mensagem);
                console.error(resultado.log);
            }
        })
        .catch((erro) => {
            notyf.alert('Ocorreu um erro desconchecido!');
            console.error('Módulo Perfil: ' + erro);
        })
}
