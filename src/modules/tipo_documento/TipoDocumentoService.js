/* ========================================================================
 * TipoDocumento API
 * ========================================================================
 * Descrição: Serviço de interface do "tipo_documento" no servidor
 * ========================================================================
 * Author Rener Dias renerdias@msn.com
 * Copyright 2017-2017 R2 Informática.
 * ======================================================================== */

import api from '../../utils/api';

const URL_TIPO_DOCUMENTO = '/tipo_documento/interface';

export const todos = () => {
  return api.get(URL_TIPO_DOCUMENTO + '/pesquisar.php?por=todos');
}
