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
  private static $time;
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

//TODO: Ajustar contagem de tempo de execução
    /* Get current time */
    //function getTime(){
      private static function get_time() {
       return microtime(TRUE);
    }

    /* Calculate start time */
    public static function time__start_exec(){
       self::$time = self::get_time();
    }

    /*
     * Calculate end time of the script,
     * execution time and returns results
     */
    public static function time__end_exec(){
       $finalTime = self::get_time();
       $execTime = $finalTime - self::$time;
       return gmdate("H:i:s", $execTime);//number_format($execTime, 6);//em segundos
    }

}
?>
