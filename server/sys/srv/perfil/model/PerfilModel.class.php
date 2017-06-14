<?php

namespace root\server\sys\srv\perfil\model;

use root\server\sys\lib\sql\SQLAll;
use root\server\sys\lib\sql\SQLOne;
use root\server\sys\lib\sql\SQLCriteria;
use root\server\sys\lib\sql\SQLSelect;
use root\server\sys\lib\db\DBTransaction;
use root\server\sys\lib\sql\SQLFilter;

/**
 * Classe responsável pela manipulação de registros da tabela tb_perfil
 *
 * @package sys/srv/perfil
 * @subpackage model
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class PerfilModel extends SQLOne
{
     const TABLE_NAME = 'public.tb_perfil';
     protected static $PRIMARY_KEY = 'id_perfil';

    /**
     * Lista todos os registros
     *
     * @access public
     * @static
     * @return mixed Retorna uma lista de registros
     */
    public static function all(){
        # Cria uma instância de um repositório
        $sql = new SQLAll(self::TABLE_NAME);
        # Carrega lista de registros
        $result = $sql->getAll();
        # Retorno
        return $result;
    }
    /**
     * Pesquisa registros pelo nome
     *
     * @access public
     * @static
     * @return mixed Retorna uma lista de perfis
     */
    public static function pesquisarPorNome($_name) {
        # Cria uma instância de um repositório
        $sql = new SQLAll(self::TABLE_NAME);
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter('ds_perfil', 'ilike', "%{$_name}%"));
        $criteria->setProperty('order', 'ds_perfil asc');
        # Carrega lista de registros
        $result = $sql->findAll($criteria);
        # Retorno
        return $result;
    }
}
?>
