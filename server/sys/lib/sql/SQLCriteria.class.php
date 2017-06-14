<?php

namespace root\server\sys\lib\sql;

/**
 * Classe responsável por provê uma interface utilizada para definição de critérios
 *
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 *
 * @todo Verificar tradução de "parenteses" para o inglês.
 */
class SQLCriteria {

    /**
     * @var $expression Armazena a lista de expressões
     * @access private
     */
    private $expression;

    /**
     * @var $operator Armazena a lista de operadores
     * @access private
     */
    private $operator;

    /**
     * @var $property Armazena a lista de propriedades
     * @access private
     */
    private $property;

    /**
     * @var $parenteses Armazena a lista de parenteses
     * @access private
     */
    private $parenteses;

    /**
     * Está função é executada no momento de criação da classe
     * Não existirão instâncias de TCriterio, por isto estamos marcando-o como private
     *
     */
    /**
     * Método executada no momento de criação da classe
     *
     * @return void
     */
    public function __construct() {
        $this->expression = array();
        $this->operator = array();
        $this->parenteses = array();
    }

    /**
     * Método responsável por definir uma nova expressão para o critério
     *
     * @access public
     * @param string $_expression
     * @param string $_operator
     * @param string $_parentese
     * @return void
     */
    public function set($_expression, $_operator = NULL, $_parentese = null) {
        # Na primeira vez, não precisamos de operador lógico para concatenar
        if (empty($this->expression)) {
            $_operator = NULL;
        }
        # Agrega o resultado da expressão à lista de expressões
        $this->expression[] = $_expression;
        $this->operator[] = $_operator;
        $this->parenteses[] = $_parentese;
    }

    /**
     * Método responsável por concatenar as lista de expressões
     *
     * @access public
     * @return string Retorna uma string com o criterio de sql
     */
    public function dump() {
        # Concatena a lista de expressões
        if (is_array($this->expression)) {
            if (count($this->expression) > 0) {
                $result = '';
                foreach ($this->expression as $i => $expression) {
                    $operator = $this->operator[$i];
                    # Concatena o operador com a respectiva expressão
                    $result .= $operator . ' ' . self::setParenteses($expression->dump(),$this->parenteses[$i]) . ' ';
                }
                $result = trim($result);
                return "({$result})";
            }
        }
    }

    /**
     * Método responsável por definir o valor de uma propriedade
     *
     * @access public
     * @param string $_property
     * @param string $_value
     * @return void
     */
    public function setProperty($_property, $_value) {
        if (isset($_value)) {
            $this->property[$_property] = $_value;
        } else {
            $this->property[$_property] = NULL;
        }
    }

    /**
     * Método responsável por retorna o valor de uma propriedade
     *
     * @access public
     * @param string $_property
     * @return string Retorna o valor de uma propriedade
     */
    public function getProperty($_property) {
        if (isset($this->property[$_property])) {
            return $this->property[$_property];
        }
    }

    /**
     * Método responsável por controlar inclusão ou não de parenteses
     * nos critérios do sql
     *
     * @access private
     * @param string $_expression
     * @param string $_parentese Recebe o parentese a ser incluido
     * @return string $_expression Retorna expressão com parenteses caso seja solicitado
     */
    private function setParenteses($_expression,$_parentese){
        if ($_parentese === '('){
            return "($_expression";
        } else if ($_parentese === '(('){
            return "(($_expression";
        } else if ($_parentese === ')'){
            return " $_expression)";
        } else if ($_parentese === '))'){
            return "$_expression))";
        } else if ($_parentese === '()'){
            return "($_expression)";
        } else {return $_expression;}
    }
}

?>
