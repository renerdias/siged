/* ========================================================================
 * Perfil API
 * ========================================================================
 * Descrição: Serviço de interface do "perfil" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api';

const URL_PERFIL = '/perfil/interface';

export const todos = () => {
  return api.get(URL_PERFIL + '/pesquisar.php?por=todos');
}
export const pesquisarPorId = (id) => {
  return api.get(URL_PERFIL + '/pesquisar.php?por=id&id=' + id);
}
export const pesquisarPorNome = (nome) => {
  return api.get(URL_PERFIL + '/pesquisar.php?por=nome&nome=' + nome);
}
export const pesquisarPorMunicipio = (id) => {
  return api.get(URL_PERFIL + '/pesquisar.php?por=municipio&id=' + id);
}
export const salvar = (perfil) => {
  return api.post(URL_PERFIL + '/salvar.php', perfil);
}
