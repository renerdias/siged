<?php

namespace root\server\sys\lib\sql;

use root\server\sys\lib\db\DBTransaction;

/**
 * Classe responsável por provê os métodos necessários para manipular uma
 * coleção de registros da base de dados
 *
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class SQLAll {

    /**
     * @var $table Recebe nome da tabela a ser manipulada
     * @access private
     */
    private $table;

    /**
     * Método executado no momento de criação da classe
     *
     * @access public
     * @param $_table Recebe nome da tabela a ser manipulada
     * @return void
     */
    public function __construct($_table) {
        $this->table = $_table;
    }

    /**
     * Método responsável por encontrar um conjunto de objetos (collection) da base de dados
     * através de um critério de seleção, e instanciá-los em memória
     *
     * @access public
     * @param object $_criteria Recebe um objeto do tipo SQLCriteria
     * @return mixed $result Retorna resultado em forma de array
     */
    public function findAll($_criteria) {
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable($this->table);
        $sql->setColumn('*');
        # Atribui o critério passado como parâmetro
        $sql->setCriteria($_criteria);
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

    /**
     * Método responsável por atualizar uma coleção de registros na base de dados
     *
     * @access public
     * @param array $_data Recebe as colunas/conteudo a serem atualizados
     * @param object $_criteria Recebe um objeto do tipo SQLCriteria
     * @return int Retorna o número de registros alterados
     */
    public function updateAll($_data, SQLCriteria $_criteria = null) {
        # Cria uma instância de SQLUpdate
        $sql = new SQLUpdate;
        $sql->setTable($this->table);

        # Atribui o critério passado como parâmetro
        if (!is_null($_criteria)){
            $sql->setCriteria($_criteria);
        }
        # Percorre os dados do objeto
        foreach ($_data as $key => $value) {
            # O ID não precisa ir no UPDATE
            if ($key !== 'id') {
                # Passa os dados do objeto para o SQL
                $sql->setColumnValue($key, $value);
            }
        }
        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            # Retorna o resultado
            return $conn->exec($sql->getSQL());
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }

    /**
     * Método responsável por excluir um conjunto de registros (collection) da tabela
     * através de um critério de seleção.
     *
     * @access public
     * @param object $_criteria Recebe um objeto do tipo SQLCriteria
     * @return int Retorna o número de registros excluídos
     */
    public function deleteAll(SQLCriteria $_criteria) {
        # Cria uma instância de SQLDelete
        $sql = new SQLDelete;
        $sql->setTable($this->table);
        # Atribui o critério passado como parâmetro
        $sql->setCriteria($_criteria);
        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            # Executa instrução de DELETE
            return $conn->exec($sql->getSQL());
        } else {
            # se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }

    /**
     * Método responsável por retornar a quantidade de registros da tabela
     * que satisfazem um determinado critério de seleção.
     *
     * @access public
     * @param object $_criteria Recebe um objeto do tipo SQLCriteria
     * @return int Retorna o número de registros que satisfazem o criterio SQL
     */
    public function count(SQLCriteria $_criteria) {
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable($this->table);
        $sql->setColumn('count(1)');
        # Atribui o critério passado como parâmetro
        $sql->setCriteria($_criteria);
        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            # Executa instrução de SELECT
            $obj = $conn->Query($sql->getSQL());
            if ($obj) {
                $result = $obj->fetch();
            }
            # Retorna o resultado
            return $result[0];
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }

    /**
     * Método responsável por obter todos os registros da tabela
     *
     * @access public
     * @return array $_result Retorna resultado em forma de array
     */
    public function getAll() {
        # Cria uma instância de SQLSelect
        $sql = new SQLSelect;
        $sql->setTable($this->table);
        $sql->setColumn('*');
        # Obtém uma transação ativa, caso haja
        if ($conn = DBTransaction::get()) {
            # Executa a consulta no banco de dados
            $collection= $conn->Query($sql->getSQL());
            $result = array();

            if ($collection) {
                # Percorre os resultados da consulta, retornando um objeto
                while ($line = $collection->fetchObject()) {
                    # Armazena no array
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
