<?php

namespace root\server\sys\srv\perfil\controller;

use root\server\sys\lib\db\DBTransaction;
use root\server\sys\srv\perfil\model\PerfilModel;

/**
 * Trecho de código responsável por persistir os dados na tabela tb_perfil e que 
 * compõe o controller PerfilCtrl.
 *
 * @package sys/srv/perfil
 * @subpackage controller
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait save {
    
    /**
     * Método responsável por inserir novos registros na tabela tb_perfil
     * 
     * @access public
     * @param mixed $_arrPerfil Array contendo as colunas e seus respectivos
     * valores para inserção
     * @return int Retorna ID do novo registro inserido
     */    
    public static function inserir($_arrPerfil) {
        DBTransaction::open('siged');
        $model = new PerfilModel();
        $result = $model->inserir($_arrPerfil);
        if ($result) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }
    }
    /**
     * Método responsável por atualizar um registro na tabela tb_perfil
     * 
     * @access public
     * @param mixed $_arrPerfil Array contendo as colunas e seus respectivos
     * valores para atualização
     * @return bool Retorna true se a atualização ocorrer com sucesso
     */    
    public static function atualizar($_arrPerfil) {
        DBTransaction::open('siged');
        $model = new PerfilModel();
        if ($model->atualizar($_arrPerfil)) {
            DBTransaction::commit();
            return true;
        } else {
            DBTransaction::rollback();
            return;
        }        
    }
    /**
     * Método responsável por inserir/atualizar dados na tabela tb_perfil
     * 
     * @access public
     * @param mixed $_arrPerfil Array contendo as colunas e seus respectivos
     * valores para persistência
     * @return int|bool Retorna ID do novo registro inserido em caso de inserção,
     * e true se for uma atualização e ocorrer com sucesso
     */    
    public static function inserirOuAtualizar($_arrPerfil) {
        DBTransaction::open('siged');
        $model = new PerfilModel();
        $result = $model->inserirOuAtualizar($_arrPerfil);
        if ($result == true or $result > 0) {
            DBTransaction::commit();
            return $result;
        } else {
            DBTransaction::rollback();
            return;
        }        
    }    
}
