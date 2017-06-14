<?php

namespace root\server\sys\srv\perfil\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\perfil\model\PerfilModel;

/**
 * Trecho de código responsável por encontrar os dados na tabela tb_perfil e que 
 * compõe o controller PerfilCtrl.
 *
 * @package sys/srv/perfil
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait find {

    /**
     * Método responsável por encontrar um registro na tabela tb_perfil
     *
     * @access public
     * @param int $_one ID do registro a ser encontrado
     * @return mixed Retorna um objeto com os dados do registro encontrado
     */
    public static function findOne($_one) {
        DBTransaction::open('siged');
        $model = new PerfilModel();
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
        $result = PerfilModel::pesquisarPorNome();
        DBTransaction::commit();
        return $result;
    }
    public function findAll($_arrPerfil) {
    #findAll
    }
    public function findWhere($_arrPerfil) {
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
        $result = PerfilModel::all();
        DBTransaction::commit();
        return $result;
         *
         */
        $model = new PerfilModel();
        if ($result = $model->all()) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
}