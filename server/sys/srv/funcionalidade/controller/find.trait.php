<?php

namespace root\server\sys\srv\funcionalidade\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\funcionalidade\model\FuncionalidadeModel;

/**
 * Trecho de código responsável por encontrar os dados na tabela tb_funcionalidade e que 
 * compõe o controller FuncionalidadeCtrl.
 *
 * @package sys/srv/funcionalidade
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait find {

    /**
     * Método responsável por encontrar um registro na tabela tb_funcionalidade
     *
     * @access public
     * @param int $_one ID do registro a ser encontrado
     * @return mixed Retorna um objeto com os dados do registro encontrado
     */
    public static function findOne($_one) {
        DBTransaction::open('siged');
        $model = new FuncionalidadeModel();
        if ($result = $model->findOne($_one)) {
            DBTransaction::commit();
            return $result;
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
     * @return mixed Retorna os registros da tabela que satisfação o nome passado
     */
    public static function pesquisarPorNome($_name) {
        DBTransaction::open('siged');
        $result = FuncionalidadeModel::pesquisarPorNome($_name);
        DBTransaction::commit();
        return $result;
    }
    public function findAll($_arrFuncionalidade) {
    #findAll
    }
    public function findWhere($_arrFuncionalidade) {
    #findWhere
    }

    /**
     * Método responsável retornar todos os registros da tabela
     *
     * @access public
     * @static
     * @return mixed Retorna todos os registros da tabela
     */
    public static function all() {
        DBTransaction::open('siged');
        /*
        $result = FuncionalidadeModel::all();
        DBTransaction::commit();
        return $result;
         *
         */
        $model = new FuncionalidadeModel();
        if ($result = $model->all()) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    public static function getFuncionalidades() {
        DBTransaction::open('siged');
        if ($result = FuncionalidadeModel::getFuncionalidades()) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
}