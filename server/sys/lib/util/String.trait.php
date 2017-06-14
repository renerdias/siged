<?php

namespace root\server\sys\lib\util;

/**
 * Trecho de código que concentra os métodos de manipulação de string
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait String {

    /**
     * Higieniza uma string
     *
     * @access public
     * @static
     * @param mixed $_value Valor a ser verificado
     * @return {type} String
     */
    public static function string__is_sanitize ($str) {
        $str = filter_var($str, FILTER_SANITIZE_STRING);
        $str = filter_var($str, FILTER_SANITIZE_SPECIAL_CHARS);
        return $str;
    }
}

?>
