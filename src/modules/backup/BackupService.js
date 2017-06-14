/* ========================================================================
 * Backup API
 * ========================================================================
 * Descrição: Serviço de interface do "backup" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api';

const URL_BACKUP = '/backup/interface';


export const executar = () => {
  return api.get(URL_BACKUP + '/exec.php');
}

export const todos = () => {
  return api.get(URL_BACKUP + '/pesquisar.php?por=todos');
}
export const pesquisarPorId = (id) => {
  return api.get(URL_BACKUP + '/pesquisar.php?por=id&id=' + id);
}
export const pesquisarPorNome = (nome) => {
  return api.get(URL_BACKUP + '/pesquisar.php?por=nome&nome=' + nome);
}
export const pesquisarPorMunicipio = (id) => {
  return api.get(URL_BACKUP + '/pesquisar.php?por=municipio&id=' + id);
}
export const salvar = (backup) => {
  return api.post(URL_BACKUP + '/salvar.php', backup);
}
