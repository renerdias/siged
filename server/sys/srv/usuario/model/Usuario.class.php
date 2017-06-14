<?php

namespace root\server\sys\srv\usuario\model;

use root\server\sys\lib\sql\SQL;
use root\server\sys\lib\sql\SQLAll;
use root\server\sys\lib\sql\SQLOne;
use root\server\sys\lib\sql\SQLCriteria;
use root\server\sys\lib\sql\SQLSelect;
use root\server\sys\lib\db\DBTransaction;
use root\server\sys\lib\sql\SQLFilter;

/**
 * Classe responsável pela manipulação de registros da tabela tb_usuario
 *
 * @package sys/srv/usuario
 * @subpackage model
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class Usuario extends SQLOne
{
     const TABLE_NAME = 'public.tb_usuario';
     protected static $PRIMARY_KEY = 'id_usuario';

/*
$usuario->login($user_name, $password);

$usuario->logout();
$usuario->isAuthenticated($user_token);
$usuario->isAuthorized(id_usuario);
$usuario->getCredentials(id_usuario);
$usuario->isAllowed(id_perfil,id_funcionalidade);
$usuario->isAllowed(id_perfil,no_funcionalidade,no_acao);
$usuario->allow(id_perfil,no_funcionalidade,no_acao);
$usuario->deny();
$usuario->getAlowed(id_perfil);
$usuario->cleanAlowed(id_perfil);
$usuario->getPermissions(id_perfil);
$usuario->setPermission(id_perfil);
 */
 /**
  * Lista todos os registros
  *
  * @access public
  * @static
  * @return mixed Retorna uma lista de registros
  */
 public static function todos(){
     # Cria uma instância de um repositório
     $sql = new SQLAll(self::TABLE_NAME);
     # Carrega lista de registros
     $result = $sql->getAll();
     # Retorno
     return $result;
 }
/**
 *
 * @param type $username
 * @param type $password
 * @return type
 */
public static function login($username,$password){
    return SQL::select("SELECT * FROM tb_usuario WHERE lg_usuario = '$username' and pw_usuario = '$password'");
}

    /**
     *
     * @access public
     * @static
     * @return mixed Retorna uma lista de funcionalidades
     */
    public static function getFeatures() {
        # Retorno
        return SQL::select('SELECT distinct on (no_funcionalidade) * FROM sistema.ts_funcionalidade');
    }
    public static function getAllowedByProfile($id_perfil, $_name) {
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable('public.vw_perfil_permissao');
        $sql->setColumn('no_acao');
        $sql->setColumn('ds_acao');
        #$sql->setColumn('st_permitido');
        $sql->setColumn('permissao');
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter('id_perfil', '=', $id_perfil));
        $criteria->set(new SQLFilter('no_funcionalidade', '=', $_name),' AND ');
        # Atribui o critério passado como parâmetro
        $sql->setCriteria($criteria);
        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            $collection= $conn->Query($sql->getSQL());
            $result = array();
            if ($collection) {
                # Percorre os resultados da consulta, retornando um objeto
                while ($line = $collection->fetchObject()) {
                    # Armazena no array $result;
                    $result[] = $line;
                }
            }
            return $result;
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }
}
?>
