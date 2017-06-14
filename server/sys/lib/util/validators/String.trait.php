<?php

namespace root\server\sys\lib\util\validators;

/**
 * Trecho de código que concentra os métodos de validação de string
 *
 * @package sys/lib/util
 * @subpackage validators
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait String {

    /**
     * Valida string
     *
     * @access public
     * @static
     * @param mixed $_value Valor a ser verificado
     * @return {type} boolean
     */
    public static function string__is_valid($str) {
        if (is_string($str)) {
            return true;
        } else {
            return;
        }
    }
}

?>
