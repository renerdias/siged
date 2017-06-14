<?php

namespace root\server\sys\srv\funcionalidade\model;

use root\server\sys\lib\sql\SQL;
use root\server\sys\lib\sql\SQLAll;
use root\server\sys\lib\sql\SQLOne;
use root\server\sys\lib\sql\SQLCriteria;
use root\server\sys\lib\sql\SQLSelect;
use root\server\sys\lib\db\DBTransaction;
use root\server\sys\lib\sql\SQLFilter;

/**
 * Classe responsável pela manipulação de registros da tabela tb_funcionalidade
 *
 * @package sys/srv/funcionalidade
 * @subpackage model
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class FuncionalidadeModel extends SQLOne
{
     const TABLE_NAME = 'sistema.ts_funcionalidade';
     protected static $PRIMARY_KEY = 'id_funcionalidade';

    /**
     * Lista todos os registros
     *
     * @access public
     * @static
     * @return mixed Retorna uma lista de registros
     */
    public static function all(){
        /*
        # Cria uma instância de um repositório
        $sql = new SQLAll(self::TABLE_NAME);
        # Carrega lista de registros
        $result = $sql->getAll();
        # Retorno
        return $result;
        */
        # Cria uma instância de um repositório
        $sql = new SQLAll(self::TABLE_NAME);
        $criteria = new SQLCriteria;
        $criteria->setProperty('group by', 'no_funcionalidade');
        # Carrega lista de registros
        $result = $sql->findAll($criteria);
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
    public static function pesquisarPorNome2($_name) {
        # Cria uma instância de um repositório
        $sql = new SQLAll(self::TABLE_NAME);
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter('no_funcionalidade', '=', $_name));
        # Carrega lista de registros
        $result = $sql->findAll($criteria);
        # Retorno
        return $result;
    }
    /**
     *
     * @access public
     * @static
     * @return mixed Retorna uma lista de funcionalidades
     */
    public static function getFuncionalidades() {
        # Retorno
        return SQL::select('SELECT distinct on (no_funcionalidade) * FROM ' . self::TABLE_NAME);
        /*
        return SQL::select(
                '
            SELECT
                func.*,
                CASE rl_funcionalidade_perfil.id_funcionalidade
                    WHEN 1 THEN false
                    WHEN null THEN true
                    ELSE (true) END AS permissao
            FROM
                public.rl_funcionalidade_perfil
                FULL JOIN
                (
                    SELECT
                        public.tb_perfil.*,
                        sistema.ts_funcionalidade.*
                    FROM public.tb_perfil
                        CROSS JOIN sistema.ts_funcionalidade
                )
                func  ON public.rl_funcionalidade_perfil.id_funcionalidade = func.id_funcionalidade
                WHERE func.id_perfil = 1
                order by func.no_funcionalidade, func.id_funcionalidade
            '
        );
         */
    }
    public static function pesquisarPorNome($_name) {
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable(self::TABLE_NAME);
        $sql->setColumn('no_acao');
        $sql->setColumn('ds_acao');
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter('no_funcionalidade', '=', $_name));
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
