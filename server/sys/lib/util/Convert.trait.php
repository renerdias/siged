<?php

namespace root\server\sys\lib\util;

/**
 * Trecho de código que concentra os métodos de conversão diversos
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait Convert {

    /**
     * Converte um objeto para array
     *
     * @access public
     * @static
     * @param string $data Dados a serem comvertido
     * @return array
     */    
    public static function object_to_array($data) {
        if (is_array($data) || is_object($data)){
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] =  self::object_to_array($value);
            }
            return $result;
        }
        return $data;
    }    
}

?>
