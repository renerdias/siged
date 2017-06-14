<?php

namespace root\server\sys\srv\perfil\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\perfil\model\PerfilModel;

/**
 * Trecho de código responsável por excluir dados da tabela tb_perfil e que
 * compõe o controller PerfilCtrl.
 *
 * @package sys/srv/perfil
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait delete {
    
    /**
     * Método responsável por excluir um registro na tabela tb_perfil
     *
     * @access public
     * @param int $_one ID do registro a ser excluído
     * @return bool Retorna true se exclusão ocorrer com sucesso
     */
    public static function deletar($_one) {
        DBTransaction::open('siged');
        $model = new PerfilModel();
        if ($model->deletar($_one)) {
            DBTransaction::commit();
            return true;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    public static function deleteWhere($_one) {

    }    
}
