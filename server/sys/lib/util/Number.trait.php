<?php

namespace root\server\sys\lib\util;

/**
 * Trecho de código que concentra os métodos de manipulação numérica
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait Number {
    /**
     * Retorna apenas os números do valor
     *
     * @access public
     * @static
     * @param mixed $_value Valor a ser analisado
     * @return {type} string|number
     */
    public static function only_number($_value) {
        return preg_replace("/[^0-9]/", "", $_value);
    }
}
?>
