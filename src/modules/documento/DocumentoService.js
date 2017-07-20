/* ========================================================================
 * Documento API
 * ========================================================================
 * Descrição: Serviço de interface do "documento" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api';

const URL_DOCUMENTO = '/documento/interface';

export const todos = () => {
  return api.get(URL_DOCUMENTO + '/pesquisar.php?por=todos');
}
export const pesquisarPorId = (id) => {
  return api.get(URL_DOCUMENTO + '/pesquisar.php?por=id&id=' + id);
}
export const pesquisarPorNome = (nome) => {
  return api.get(URL_DOCUMENTO + '/pesquisar.php?por=nome&nome=' + nome);
}
export const pesquisarPorMunicipio = (id) => {
  return api.get(URL_DOCUMENTO + '/pesquisar.php?por=municipio&id=' + id);
}
export const salvar = (documento) => {
  return api.post(URL_DOCUMENTO + '/salvar.php', documento);
}
