<?php

namespace root\server\sys\lib\util;

use root\server\sys\lib\Carbon\Carbon;

/**
 * Trecho de código que concentra os métodos de manipulação de data
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait Time {
    /**
     * Retorna data/hora atual
     *
     * @access public
     * @static
     * @param {type} String $format
     * @return {type} datetime
     */
    public static function time__is_now($format = null) {
      if (!is_null($format)) {
        return Carbon::now()->format($format);
      } else {
        return Carbon::now()->format(self::FORMAT_DEFAULT);
      }
    }
}
?>
