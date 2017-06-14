/* ========================================================================
 * Funcionalidade API
 * ========================================================================
 * Descrição: Serviço de interface do "funcionalidade" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api'; // não precisa de .js

const URL_FUNCIONALIDADE = '/funcionalidade/interface';

export const todos = () => {
  return api.get(URL_FUNCIONALIDADE + '/pesquisar.php?por=todos');
}
export const pesquisarPorId = (id) => {
  return api.get(URL_FUNCIONALIDADE + '/pesquisar.php?por=id&id=' + id);
}
export const pesquisarPorNome = (nome) => {
  return api.get(URL_FUNCIONALIDADE + '/pesquisar.php?por=nome&nome=' + nome);
}
export const pesquisarPorMunicipio = (id) => {
  return api.get(URL_FUNCIONALIDADE + '/pesquisar.php?por=municipio&id=' + id);
}
export const salvar = (funcionalidade) => {
  return api.post(URL_FUNCIONALIDADE + '/salvar.php', funcionalidade);
}
