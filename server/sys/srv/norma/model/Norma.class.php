<?php

namespace root\server\sys\srv\norma\model;

use root\server\sys\lib\sql\SQLAll;
use root\server\sys\lib\sql\SQLOne;
use root\server\sys\lib\sql\SQLCriteria;
use root\server\sys\lib\sql\SQLSelect;
use root\server\sys\lib\db\DBTransaction;
use root\server\sys\lib\sql\SQLFilter;
use root\server\sys\lib\util\TUtil;

/**
 * Classe responsável pela manipulação de registros da tabela norma
 *
 * @package sys/srv/norma
 * @subpackage model
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class Norma extends SQLOne
{
     const TABLE_NAME = 'public.tb_norma';
     protected static $PRIMARY_KEY = 'id_norma';

    /**
     * Pesquisa registros pelo nome
     *
     * @access public
     * @static
     * @return mixed Retorna uma lista de normas
     */
    public static function pesquisarPorNome($_nome) {
      # Cria uma instância de SQLSelect
      $sql = new SQLSelect;
      $sql->setTable(self::TABLE_NAME);
      $sql->setColumn('tb_norma.*');
      $sql->setColumn('ts_municipio.no_municipio');
      $sql->setColumn('ts_municipio.sg_uf');
      $sql->setJoin('LEFT JOIN', 'sistema.ts_municipio', 'tb_norma.id_municipio','ts_municipio.id_municipio');
      $criteria = new SQLCriteria;
      $nome = TUtil::fonetizar($_nome);
      $criteria->set(new SQLFilter('no_norma_fn', 'ilike', "%{$nome}%"));
      $criteria->setProperty('order', 'no_norma asc');
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

        # Cria uma instância de um repositório
        $sql = new SQLAll(self::TABLE_NAME);
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter('no_norma', 'ilike', "%{$_nome}%"));
        $criteria->setProperty('order', 'no_norma asc');
        # Carrega lista de registros
        $result = $sql->findAll($criteria);
        # Retorno
        return $result;
    }
    public static function pesquisarPorMunicipio($_id) {
        # Cria uma instância de um repositório
        $sql = new SQLAll(self::TABLE_NAME);
        $criteria = new SQLCriteria;
        $criteria->set(new SQLFilter('id_municipio', '=', "{$_id}"));
        $criteria->setProperty('order', 'no_norma asc');
        # Carrega lista de registros
        $result = $sql->findAll($criteria);
        # Retorno
        return $result;
    }
    public function todos(){
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable(self::TABLE_NAME);
        $sql->setColumn('tb_norma.*');
        $sql->setColumn('ts_municipio.no_municipio');
        $sql->setColumn('ts_municipio.sg_uf');
        $sql->setJoin('LEFT JOIN', 'sistema.ts_municipio', 'tb_norma.id_municipio','ts_municipio.id_municipio');
        $criteria = new SQLCriteria;
        $criteria->setProperty('order', 'no_norma asc');
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
