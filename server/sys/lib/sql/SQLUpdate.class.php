<?php

namespace root\server\sys\lib\sql;

/**
 * Classe responsável por provê meios para manipulação de uma instrução
 * sql UPDATE no banco de dados
 * 
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class SQLUpdate extends SQLBase {

    /**
     * Método responsável por montar e retornar uma instrução sql UPDATE 
     * em forma de string.
     * 
     * @access public          
     * @return string Retorna uma instrução sql UPDATE
     */    
    public function getSQL() {       
        # Monta a string de UPDATE recuperando nome da tabela
        $this->sql = "UPDATE {$this->table}";
        
        # Monta os pares: coluna=valor,...
        if ($this->columnValue) {
            foreach ($this->columnValue as $column => $value) {
                $box[] = "{$column} = {$value}";
            }
        }
        $this->sql .= ' SET ' . implode(', ', $box);

        # Recupera a cláusula WHERE do objeto criterio da classe SQLCriteria
        if ($this->criteria) {
            $this->sql .= ' WHERE ' . $this->criteria->dump();
        }
        # Retorna instrução sql
        return $this->sql;
    }

}
