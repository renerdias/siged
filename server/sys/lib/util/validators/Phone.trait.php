<?php

namespace root\server\sys\lib\util\validators;

use root\server\sys\lib\Carbon\Carbon;

/**
* Trecho de código que concentra os métodos de validação de telefone
*
* @package sys/lib
* @subpackage util
* @version 0.1
* @author Rener Dias
* @copyright (c) 2017, R2 Informática
*/
trait Phone {

  /**
  * Valida Telefone
  *
  * @access public
  * @static
  * @param $phone
  * @return {type} Boolean
  */
  public static function phone__is_valid($phone) {
    #Validar número de Telefone
    #Validação de telefone principalmente número de celular se tornou outra dor de cabeça depois que adicionaram mais um dígito, porém essa alteração não vale para todos os estados então sempre fica a dúvida de aceitar ou não esse dígito.
    #Uma saída é usar um REGEX que aceite os 2 formatos, número de celular com com 9 dígitos e com 8 dígitos:
    #$valor = '(99) 99999-9999';
    if (preg_match('/^\([0-9]{2}\)?\s?[0-9]{4,5}-[0-9]{4}$/', $phone)):
      return true;
    else:
      return;
    endif;
  }
}
?>
