<?php

namespace root\server\sys\lib\util\validators;

/**
 * Trecho de código que concentra os métodos de validação numérica
 *
 * @package sys/lib/util
 * @subpackage validators
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait Number {

  /**
   * Valida número inteiro
   *
   * @access public
   * @static
   * @param mixed $_value Valor a ser verificado
   * @return {type} Boolean
   */
    public static function is_integer($_value) {
        # Obs.: Não usar FILTER_SANITIZE_NUMBER_INT pois ele retira a virgula
        # caso seja passado um valor fracionado não validando corretamente
        if (is_numeric(trim($_value)) && filter_var($_value, FILTER_VALIDATE_INT)) {
            return true;
        } else {
            return;
        }
    }
}
?>
