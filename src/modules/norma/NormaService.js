/* ========================================================================
 * Norma API
 * ========================================================================
 * Descrição: Serviço de interface do "norma" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api';

const URL_NORMA = '/norma/interface';

export const todos = () => {
  return api.get(URL_NORMA + '/pesquisar.php?por=todos');
}
export const pesquisarPorId = (id) => {
  return api.get(URL_NORMA + '/pesquisar.php?por=id&id=' + id);
}
export const pesquisarPorNome = (nome) => {
  return api.get(URL_NORMA + '/pesquisar.php?por=nome&nome=' + nome);
}
export const pesquisarPorMunicipio = (id) => {
  return api.get(URL_NORMA + '/pesquisar.php?por=municipio&id=' + id);
}
export const salvar = (norma) => {
  return api.post(URL_NORMA + '/salvar.php', norma);
}
