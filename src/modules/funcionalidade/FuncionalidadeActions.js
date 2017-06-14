/**
 * Módulo: Funcionalidade
 */
import * as funcionalidadeService from './FuncionalidadeService';

//TODO: Criar busca paginada
/**
 *
 * @param {type} commit
 */
export const _limparFuncionalidade = ({
    commit
}) => {
    commit('LIMPAR_FUNCIONALIDADE')
}
/**
 * Obtém todos os funcionalidades
 */
export const _obterTodosFuncionalidades = ({
    commit,
    dispatch
}) => {
    funcionalidadeService.todos()
        .then((response, erro) => {
            let resultado = response.data;
            if (resultado.execucao == "sucesso") {
                commit('CARREGAR_FUNCIONALIDADES', resultado.dados);
            } else if (resultado.execucao == "erro") {
                notyf.alert(resultado.mensagem);
                console.error(resultado.log);
            }
        })
        .catch((erro) => {
            notyf.alert('Ocorreu um erro desconchecido!');
            console.error('Módulo Funcionalidade: ' + erro);
        })
}
/**
 * Pesquisa funcionalidade por nome
 */
export const _pesquisarFuncionalidadePorNome = ({
    commit,
    dispatch
}, nome) => {
    funcionalidadeService.pesquisarPorNome(nome)
        .then((response, erro) => {
            let resultado = response.data;
            if (resultado.execucao == "sucesso") {
                commit('CARREGAR_FUNCIONALIDADES', resultado.dados);
            } else if (resultado.execucao == "erro") {
                notyf.alert(resultado.mensagem);
                console.error(resultado.log);
            }
        })
        .catch((erro) => {
            notyf.alert('Ocorreu um erro desconchecido!');
            console.error('Módulo Funcionalidade: ' + erro);
        })
}
/**
 * Pesquisa funcionalidade por id
 */
export const _pesquisarFuncionalidadePorId = ({
    commit,
    dispatch
}, id) => {
    return new Promise((resolve, reject) => {
        funcionalidadeService.pesquisarPorId(id)
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
                console.error('Módulo Funcionalidade: ' + erro);
            })
    })
}
/**
 * Salvar funcionalidade
 */
//REVIEW: É realizado um novo carregamento de todos os funcionalidade ao salvar, isso é necessário?
export const _salvarFuncionalidade = ({
    commit,
    dispatch
}, funcionalidade) => {
    return new Promise((resolve, reject) => {
        funcionalidadeService.salvar(funcionalidade)
            .then((response, erro) => {
                let resultado = response.data;
                if (resultado.execucao == 'sucesso') {
                    notyf.confirm(resultado.mensagem);
                    //commit('SALVAR_BAIRRO', funcionalidade);
                    dispatch('_obterTodosFuncionalidades');
                    resolve();
                } else if (resultado.execucao == 'erro') {
                    notyf.alert(resultado.mensagem);
                    console.error(resultado.log);
                    reject(resultado.mensagem)
                }
            })
            .catch((erro) => {
                notyf.alert('Ocorreu um erro desconchecido!');
                console.error('Módulo Funcionalidade: ' + erro);
            })
    })
}









/**
 * Pesquisa funcionalidade por municipio
 */
export const _pesquisarFuncionalidadePorMunicipio = ({
    commit,
    dispatch
}, id) => {
    funcionalidadeService.pesquisarPorMunicipio(id)
        .then((response, erro) => {
            let resultado = response.data;
            if (resultado.execucao == "sucesso") {
                commit('CARREGAR_FUNCIONALIDADES', resultado.dados);
            } else if (resultado.execucao == "erro") {
                notyf.alert(resultado.mensagem);
                console.error(resultado.log);
            }
        })
        .catch((erro) => {
            notyf.alert('Ocorreu um erro desconchecido!');
            console.error('Módulo Funcionalidade: ' + erro);
        })
}
