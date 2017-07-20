<?php

namespace root\server\sys\srv\tipo_documento\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\tipo_documento\model\TipoDocumento;

/**
 * Trecho de código responsável por encontrar os dados na tabela tipo_documento e que
 * compõe o controller TipoDocumentoCtrl.
 *
 * @package sys/srv/tipo_documento
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait pesquisar {
  
    /**
     * Método responsável retornar todos os registros da tabela
     *
     * @access public
     * @static
     * @return mixed Retorna todos os registros da tabela
     */
    public static function todos() {
        DBTransaction::open('siged');
        $resultado = TipoDocumento::todos();
        DBTransaction::commit();
        return $resultado;
    }
}
