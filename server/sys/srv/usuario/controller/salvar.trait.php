<?php

namespace root\server\sys\srv\usuario\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\usuario\model\Usuario;

/**
 * Trecho de código responsável por persistir os dados na tabela tb_usuario e que
 * compõe o controller UsuarioCtrl.
 *
 * @package sys/srv/usuario
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait salvar {

    /**
     * Método responsável por inserir novos registros na tabela tb_usuario
     *
     * @access public
     * @param mixed $_arrUsuario Array contendo as colunas e seus respectivos
     * valores para inserção
     * @return int Retorna ID do novo registro inserido
     */
    public static function inserir($_arrUsuario) {
        DBTransaction::open('siged');
        $model = new Usuario();
        $result = $model->insertOne($_arrUsuario);
        if ($result) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    /**
     * Método responsável por atualizar um registro na tabela tb_usuario
     *
     * @access public
     * @param mixed $_arrUsuario Array contendo as colunas e seus respectivos
     * valores para atualização
     * @return bool Retorna true se a atualização ocorrer com sucesso
     */
    public static function atualizar($_arrUsuario) {
        DBTransaction::open('siged');
        $model = new Usuario();
        if ($model->updateOne($_arrUsuario)) {
            DBTransaction::commit();
            return true;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    /**
     * Método responsável por inserir/atualizar dados na tabela tb_usuario
     *
     * @access public
     * @param mixed $_arrUsuario Array contendo as colunas e seus respectivos
     * valores para persistência
     * @return int|bool Retorna ID do novo registro inserido em caso de inserção,
     * e true se for uma atualização e ocorrer com sucesso
     */
    public static function inserirOuAtualizar($_arrUsuario) {
        DBTransaction::open('siged');
        $model = new Usuario();
        $result = $model->insertOrUpdate($_arrUsuario);
        if ($result == true or $result > 0) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
}
