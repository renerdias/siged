<?php

namespace root\server\sys\lib\sql;

/**
 * Classe responsável por provê meios para manipulação de uma instrução
 * sql DELETE no banco de dados
 * 
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class SQLDelete extends SQLBase {

    /**
     * Método responsável por montar e retornar uma instrução sql DELETE 
     * em forma de string.
     * 
     * @access public          
     * @return string Retorna uma instrução sql delete
     */    
    public function getSQL() {
        # Monta a string de DELETE recuperando o nome da tabela
        $this->sql = "DELETE FROM {$this->table}";

        # Recupera a cláusula WHERE do objeto criteria da classe SQLCriteria
        if ($this->criteria) {
             $expression = $this->criteria->dump();
             if ($expression) {
                    $this->sql .= ' WHERE ' . $expression;
             }
        }
        # Retorna instrução sql
        return $this->sql;
    }
}
