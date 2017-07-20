<?php

namespace root\server\sys\srv\norma\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\norma\model\Norma;

/**
 * Trecho de código responsável por encontrar os dados na tabela norma e que
 * compõe o controller NormaCtrl.
 *
 * @package sys/srv/norma
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait pesquisar {

    /**
     * Método responsável por encontrar um registro na tabela norma
     *
     * @access public
     * @param int $_id ID do registro a ser encontrado
     * @return mixed Retorna um objeto com os dados do registro encontrado
     */
    public static function pesquisarPorId($_id) {
        DBTransaction::open('siged');
        $norma = new Norma();
        if ($resultado = $norma->findOne($_id)) {
            DBTransaction::commit();
            return $resultado;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    /**
     * Método responsável por encontrar registros pelos nome
     *
     * @access public
     * @static
     * @param string $_nome Nome do norma a ser encontrado
     * @return mixed Retorna os registros da tabela que satisfação o nome passado
     */
    public static function pesquisarPorNome($_nome) {
        DBTransaction::open('siged');
        $resultado = Norma::pesquisarPorNome($_nome);
        DBTransaction::commit();
        return $resultado;
    }
    /**
     * Método responsável retornar todos os registros da tabela
     *
     * @access public
     * @static
     * @return mixed Retorna todos os registros da tabela
     */
    public static function todos() {
        DBTransaction::open('siged');
        $resultado = Norma::todos();
        DBTransaction::commit();
        return $resultado;
    }
}
