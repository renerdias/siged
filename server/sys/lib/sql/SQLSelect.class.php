<?php

namespace root\server\sys\lib\sql;

/**
 * Classe responsável por provê meios para manipulação de uma instrução de
 * SELECT no banco de dados
 *
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class SQLSelect extends SQLBase {

    /**
     * @var $column Array de colunas a serem retornadas
     * @access private
     */
    private $column;

    /**
     * @var $join Array de juncões a serem retornadas.
     * @access private
     */
    private $join;

    /**
     * Método reponsável por definir uma junção entre tabelas
     *
     * @access public
     * @param string $_type Recebe o tipo de junção a ser realizada
     *  Exemplo: INNER JOIN, LEFT JOIN  e etc.
     * @param string $_table Recebe o nome da tabela a ser usada
     * @param string $_column1 Recebe o nome da coluna de junção
     * @param string $_column2 Recebe o outro nome da coluna de junção
     * @return void
     */
    public function setJoin($_type,$_table, $_column1, $_column2) {
        # Agrega o resultado da expressão à lista de expressões
        $this->join[] = " $_type $_table ON $_column1 = $_column2 ";
    }

    /**
     * Método reponsável por definir as colunas que farão parte da
     * instrução SELECT
     * 
     * @access public
     * @param string $_column Recebe o nome da coluna
     * @return void
     */
    public function setColumn($_column) {
        # Adiciona a coluna no array
        $this->column[] = $_column;
    }

    /**
     * Método responsável por montar e retornar a instrução de SELECT
     * em forma de string.
     * 
     * @access public
     * @return string Retorna uma instrução sql
     */
    public function getSQL() {
        # monta a instrução de SELECT
        $this->sql = 'SELECT ';

        # Monta string com os nomes de column
        $this->sql .= implode(',', $this->column);

        # Adiciona na cláusula FROM o nome da tabela
        $this->sql .= ' FROM ' . $this->table;

        # Obtém as junções, caso existam
        if ($this->join) {
            $this->sql .= implode (' ',$this->join);
        }

        # Obtém a cláusula WHERE do objeto criterio da classe SQLCriteria e adiciona.
        if ($this->criteria) {
            $expression = $this->criteria->dump();
            if ($expression) {
                $this->sql .= ' WHERE ' . $expression;
            }
            # Obtém as propriedades do objeto criterio da classe SQLCriteria
            $order = $this->criteria->getProperty('order');
            $limit = $this->criteria->getProperty('limit');
            $offset = $this->criteria->getProperty('offset');

            # Obtém a ordenação do SELECT e adiciona
            if ($order) {
                $this->sql .= ' ORDER BY ' . $order;
            }
            if ($limit) {
                $this->sql .= ' LIMIT ' . $limit;
            }
            if ($offset) {
                $this->sql .= ' OFFSET ' . $offset;
            }
        }
        # Retorna instrução sql
        return $this->sql;
    }

}

?>
