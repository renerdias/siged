<?php

namespace root\server\sys\srv\backup\model;

use root\server\sys\lib\sql\SQLAll;
use root\server\sys\lib\sql\SQLOne;
use root\server\sys\lib\sql\SQLCriteria;
use root\server\sys\lib\sql\SQLSelect;
use root\server\sys\lib\db\DBTransaction;
use root\server\sys\lib\sql\SQLFilter;
use root\server\sys\lib\util\TUtil;

/**
 * Classe responsável pela manipulação de registros da tabela backup
 *
 * @package sys/srv/backup
 * @subpackage model
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class Backup extends SQLOne
{
     const TABLE_NAME = 'public.tb_backup';
     protected static $PRIMARY_KEY = 'id_backup';


    public function todos(){
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable(self::TABLE_NAME);
        $sql->setColumn('tb_backup.*');
        $sql->setColumn('tb_usuario.nu_cpf');
        $sql->setColumn('tb_usuario.no_usuario');
        $sql->setJoin('LEFT JOIN', 'tb_usuario', 'tb_backup.id_usuario','tb_usuario.id_usuario');
        $criteria = new SQLCriteria;
        $criteria->setProperty('order', 'dt_modificacao asc');
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
