/* ========================================================================
 * TipoNorma API
 * ========================================================================
 * Descrição: Serviço de interface do "tipo_norma" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api';

const URL_TIPO_NORMA = '/tipo_norma/interface';

export const todos = () => {
  return api.get(URL_TIPO_NORMA + '/pesquisar.php?por=todos');
}
