<?php

namespace root\server\sys\lib\util\validators;

use root\server\sys\lib\Carbon\Carbon;

/**
* Trecho de código que concentra os métodos de validação de e-mail
*
* @package sys/lib/util
* @subpackage validators
* @version 0.1
* @author Rener Dias
* @copyright (c) 2017, R2 Informática
*/
trait Email {
  /**
  * Valida E-mail
  *
  * @access public
  * @static
  * @param $email
  * @return {type} Boolean
  */
  public static function email__is_valid($email) {
    $conta = "/[a-zA-Z0-9\._-]+@";
    $domino = "[a-zA-Z0-9\._-]+.";
    $extensao = "([a-zA-Z]{2,4})$/";
    $pattern = $conta.$domino.$extensao;
    if (preg_match($pattern, $email))
      return true;
    else return;
    /*
    if(filter_var($email, FILTER_VALIDATE_EMAIL)):
      return true;
    else:
      return;
    endif;
    */
  }
}
?>
