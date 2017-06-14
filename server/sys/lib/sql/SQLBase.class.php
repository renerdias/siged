<?php

namespace root\server\sys\lib\sql;

/**
 * Classe responsável por provê os métodos base em comum entre todas instruções
 * SQL (SELECT, INSERT, DELETE e UPDATE)
 * 
 * @abstract
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
abstract class SQLBase {

    /**
     * @var $sql Armazena a instrução SQL
     * @access protected
     */
    protected $sql;

    /**
     * @var $criteria Armazena o objeto do tipo SQLCriteria
     * @access protected
     */
    protected $criteria;
    
    /**
     * Método reponsável por definir o nome da tabela a ser manipulada 
     * pela instrução SQL
     * 
     * @final
     * @access public
     * @param string $_table Recebe o nome da tabela a ser usada na instrução
     * @return void
     */    
    final public function setTable($_table) {
        $this->table = $_table;
    }

    /**
     * Método reponsável por retornar com o nome da tabela a ser manipulada 
     * pela instrução SQL
     * 
     * @final
     * @access public     
     * @return string $_table Retorna o nome da tabela
     */      
    final public function getTable() {
        return $this->table;
    }
    
    /**
     * Método responsável por preparar a coluna/valor para serem persistidos no
     * banco de dados
     * 
     * @access public
     * @param string $_column Recebe o nome de uma coluna de uma tabela
     * @param mixed $_value Recebe o valor a ser armazenado (tipo indefinido)
     * @return void
     */
    public function setColumnValue($_column, $_value) {
        # Verifica se é um dado escalar (string, inteiro,...)
        if (is_scalar($_value)) {
            if (is_string($_value) and (!empty($_value))) {
                                # Adiciona \ em aspas
                $_value = str_replace("'", "''",$_value);
                # Adiciona \ em aspas
                //$_value = addslashes($_value);
                # Caso seja uma string
                $this->columnValue[$_column] = "'$_value'";
            } else if (is_bool($_value)) {
                # Caso seja um boolean
                $this->columnValue[$_column] = $_value ? 'TRUE' : 'FALSE';
            } else if ($_value !== '') {
                # Caso seja outro tipo de dado
                $this->columnValue[$_column] = $_value;
            } else {
                # Caso seja NULL
                $this->columnValue[$_column] = "NULL";
            }
        }
    }

    /**     
     * Método reponsável por definir um critério de seleção dos dados através da composição de um objeto
     * do tipo SQLCriteria, que oferece uma interface para definição de critérios
     * 
     * @param $_criteria = objeto do tipo SQLCriteria
     * @return void
     */
    public function setCriteria(SQLCriteria $_criteria) {
        $this->criteria = $_criteria;
    }

    /**
     * Declarando-a como <abstract> obrigamos sua declaração nas classes filhas,
     * uma vez que seu comportamento será distinto em cada uma delas, configurando polimorfismo.
     * 
     * @abstract
     */
    abstract function getSQL();

}
