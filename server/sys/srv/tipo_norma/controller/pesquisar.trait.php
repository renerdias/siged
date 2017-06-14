<?php

namespace root\server\sys\srv\tipo_norma\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\tipo_norma\model\TipoNorma;

/**
 * Trecho de código responsável por encontrar os dados na tabela tipo_norma e que
 * compõe o controller TipoNormaCtrl.
 *
 * @package sys/srv/tipo_norma
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
        $resultado = TipoNorma::todos();
        DBTransaction::commit();
        return $resultado;
    }
}
