<?php

namespace root\server\sys\lib\sql;

/**
 * Classe responsável por provê meios para manipulação de uma instrução
 * sql INSERT no banco de dados
 * 
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class SQLInsert extends SQLBase {

    /**
     * Método extendido, porém não deverá ser usado nesta classe, sendo assim
     * é lançada uma exeção caso alguem tente usá-la
     *
     * @access public
     * @throws Lança uma exeção caso seja usada
     * @return void
     */     
    public function setCriteria(SQLCriteria $_criteria) {
        # Lança o erro
        throw new Exception("Não é possível chamar setCriteria de " . __CLASS__);
    }

    /**
     * Método responsável por montar e retornar uma instrução sql INSERT 
     * em forma de string.
     * 
     * @access public          
     * @return string Retorna uma instrução sql insert
     */      
    public function getSQL() {
        # Monta sql recuperando o nome da tabela
        $this->sql = "INSERT INTO {$this->table} (";

        # Monta uma string contendo os nomes de colunas
        $columns = implode(', ', array_keys($this->columnValue));
        $this->sql .= $columns . ')';

        # Monta uma string contendo os valores
        $values = implode(', ', array_values($this->columnValue));
        # Adiciona valores e define o retorno do id
        //$this->sql .= " VALUES ({$values}) RETURNING id";
        $this->sql .= " VALUES ({$values})";
        # Retorna instrução sql
        return $this->sql;
    }
}
