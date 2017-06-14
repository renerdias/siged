<?php

namespace root\server\sys\lib\sql;

/**
 * Classe responsável por provê uma interface para definição de filtros de seleção
 * para ser usado em instruções SQL (SELECT, INSERT, DELETE e UPDATE)
 *
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class SQLFilter {

    /**
     * @var $variable
     * @access private
     */
    private $variable;

    /**
     * @var $operator Recebe um operator sql (=,<>,>=, ...)
     * @access private
     */
    private $operator;

    /**
     * @var $value
     * @access private
     */
    private $value;

    /**
     * Método executado no momento de criação da classe responsável por definir 
     * uma nova expressão para o critério
     *
     * @access public
     * @param string $_variable = variável
     * @param string $_operator = operador (>,<)
     * @param $_value
     * @return void
     */
    public function __construct($_variable, $_operator, $_value) {
        # Armazena as propriedades
        $this->variable = $_variable;
        $this->operator = $_operator;

        # Transforma o valor de acordo com o seu conteúdo antes de atribuir à
        # propriedade $this->value
        $this->value = $this->transformation($_value);
    }

    /**
     * Método responsável por receber um valor e fazer as modificações necessárias
     * para ele ser interpretado pelo banco de dados
     * podendo ser um integer/string/boolean ou array.
     *
     * @access private
     * @param $_value
     * @return mixed $result Retorno um valor transformado
     */
    private function transformation ($_value) {
        # Caso seja um array
        if (is_array($_value)) {
            # Percorre os valuees
            foreach ($_value as $x) {
                # Se for um inteiro
                if (is_integer($x)) {
                    $foo[] = $x;
                } else if (is_string($x)) {
                    # Se for string, adiciona aspas
                    $foo[] = "'$x'";
                }
            }
            # Converte o array em string separada por ","
            $result = '(' . implode(',', $foo) . ')';
        }
        # Caso seja uma string
        else if (is_string($_value)) {
            # Adiciona aspas
            $result = "'$_value'";
        }
        # Caso seja value nullo
        else if (is_null($_value)) {
            # Armazena NULL
            $result = 'NULL';
        }
        # Caso seja booleano
        else if (is_bool($_value)) {
            # Armazena TRUE ou FALSE
            $result = $_value ? 'TRUE' : 'FALSE';
        } else {
            $result = $_value;
        }
        # Retorna o value
        return $result;
    }

    /**
     * Método responsável por retorna o filtro em forma de expressão
     *
     * @access public
     * @return string Retorna o filtro
     */
    public function dump() {
        # Concatena informações e retorna o filtro em forma de expressão
        return "{$this->variable} {$this->operator} {$this->value}";
    }

}

?>
