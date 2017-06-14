<?php

namespace root\server\sys\lib\util;
use root\server\sys\lib\util\BuscaBR;
/**
 * Trecho de código que concentra os métodos de fonetização de string
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait Fonetizar {

  /**
   * Retorna fonética de um string
   *
   * @access public
   * @static
   * @param {type} String $str
   * @return {type} String
   */
    public static function fonetizar($str) {
      //TODO: Fonetizar->previsa ser revisto o BuscaBR
      return BuscaBR::Fonetica($str);
    }
}

?>
