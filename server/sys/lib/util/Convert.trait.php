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
     * Converte um object para array
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
    /**
     * Converte uma array para object
     *
     * @access public
     * @static
     * @param string $data Dados a serem comvertido
     * @return array
     */
    public static function array_to_object($data) {
        if (is_array($data) || is_object($data)){
            foreach ($data as $key => $value) {
                $result->$key =  self::array_to_object($value);
            }
            return $result;
        }
        return $data;
    }
    /**
     * Converte bytes para extenso
     *
     * @access public
     * @static
     * @param string
     * @return string
     */
    public static function byte_to_size($bytes) {
      $unit = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
      return $bytes ? round($bytes/pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $unit[$i] : '0 Bytes';
    }
}

?>
