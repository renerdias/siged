<?php

namespace root\server\sys\lib\util;

/**
 * Trecho de código que concentra os métodos de geração de identificadores únicos
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait Guid {

    /**
     * Gera um identificador universal UUID
     *
     * @access public
     * @static
     * @param boolean $opt Determina se o uuid deve ser gerado entre colchetes ou não
     * @return string uuid Retorna um identificador universal
     */    
    public static function uuid($opt = false) {
        # Verifica se existe um função nativa de criação
        if (function_exists('com_create_guid')) {
            if ($opt) {
                return com_create_guid();
            } else {
                return trim(com_create_guid(), '{}');
            }
        } else {
            mt_srand((double) microtime() * 10000); // optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);    // "-"
            $left_curly = $opt ? chr(123) : "";     //  "{"
            $right_curly = $opt ? chr(125) : "";    //  "}"
            $uuid = $left_curly
                . substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12)
                . $right_curly;
            return $uuid;
        }
    }

}

?>
