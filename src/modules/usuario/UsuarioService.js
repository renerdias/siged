/* ========================================================================
 * Usuario API
 * ========================================================================
 * Descrição: Serviço de interface do "usuario" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api';

const URL_USUARIO = '/usuario/interface';

export const todos = () => {
  return api.get(URL_USUARIO + '/pesquisar.php?por=todos');
}
export const autenticar = (credencial) => {
  return api.get(URL_USUARIO + '/pesquisar.php?por=autenticacao&nome=' + credencial.nome + '&senha=' + credencial.senha);
}
export const pesquisarPorId = (id) => {
  return api.get(URL_USUARIO + '/pesquisar.php?por=id&id=' + id);
}
export const pesquisarPorNome = (nome) => {
  return api.get(URL_USUARIO + '/pesquisar.php?por=nome&nome=' + nome);
}
export const pesquisarPorMunicipio = (id) => {
  return api.get(URL_USUARIO + '/pesquisar.php?por=municipio&id=' + id);
}
const options = {
  headers: {
    'Access-Control-Expose-Headers': '*', // all of your headers,
    'Access-Control-Allow-Origin': '*'
  }
}
export const salvar = (usuario) => {
  return api.post(URL_USUARIO + '/salvar.php', usuario);
}
