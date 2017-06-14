<?php

namespace root\server\sys\lib\util\validators;

use root\server\sys\lib\Carbon\Carbon;

/**
* Trecho de código que concentra os métodos de validação de documentos
*
* @package sys/lib/util
* @subpackage validators
* @version 0.1
* @author Rener Dias
* @copyright (c) 2017, R2 Informática
*/
trait Doc {

  /**
  * Valida CPF
  *
  * @access public
  * @static
  * @param $cpf
  * @return {type} Boolean
  */
  public static function cpf__is_valid($cpf = null) {
    #Verifica se um número foi informado
    if(empty($cpf) || is_null($cpf)) {
      return;
    }
    #Elimina possível máscara
    $cpf = self::only_number($cpf);
    #Preenche com zeros a esquerda até o total de 11 dígitos
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
    #Verifica se o número de digitos informados é igual a 11
    if (strlen($cpf) != 11) {
      return;
    }
    #Verifica cpf zerado
    else if ($cpf == '00000000000') {
      return;
    } else {
      #Inicia validação final do CPF
      for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
          $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
          return;
        }
      }
      return true;
    }
  }

  /**
  * Valida NIS (PIS/PASEP)
  *
  * @access public
  * @static
  * @param $nis
  * @return {type} Boolean
  */
  public static function nis__is_valid($nis) {
    #Elimina possível máscara
    $nis = self::only_number($nis);
    #Preenche com zeros a esquerda até o total de 11 dígitos
    $nis = str_pad($nis, 11, '0', STR_PAD_LEFT);
    #Verifica se o número de digitos informados é igual a 11
    if (strlen($nis) != 11) {
      return;
    }
    #Verifica nis zerado
    else if ($nis == '00000000000') {
      return;
    } else {
      #Inicia validação final do NIS
      for ($d = 0, $p = 3, $c = 0; $c < 10; $c++) {
        $d += $nis{$c} * $p;
        $p = ($p < 3) ? 9 : --$p;
      }
      $d = ((10 * $d) % 11) % 10;
      return ($nis{$c} == $d) ? true : false;
    }
  }




  /**
  * Valida CNS (Cartão SUS)
  *
  * @access public
  * @static
  * @param $cns
  * @return {type} Boolean
  */
  public static function cns__is_valid($cns) {
    #Elimina possível máscara
    $cns = self::only_number($cns);
    #Verifica se o valor informado é um CNS Definitivo ou Provisório
    return self::validaCNS_Definitivo($cns) || self::validaCNS_Provisorio($cns) ? true : false;
  }

  /**
  * Valida CNS (Cartão SUS) Definitivo
  *
  * #Rotina de validação de Números que iniciam com  “1” ou “2”
  *
  * @access public
  * @static
  * @param $cns
  * @return {type} Boolean
  */
  private function validaCNS_Definitivo($cns) {
      #Elimina possível máscara
      $cns = self::only_number($cns);
      #Preenche com zeros a esquerda até o total de 15 dígitos
      $cns = str_pad($cns, 15, '0', STR_PAD_LEFT);
      #Verifica se o número de digitos informados é igual a 15
      if (strlen($cns) != 15) {
        return;
      }
      #Verifica nis zerado
      else if ($cns == '000000000000000') {
        return;
      } else {
      #Inicia validação final do CNS Definitivo
  		$pis = substr($cns,0,11);
  		$soma = (((substr($pis, 0,1)) * 15) +
  		         ((substr($pis, 1,1)) * 14) +
  			     ((substr($pis, 2,1)) * 13) +
  			     ((substr($pis, 3,1)) * 12) +
  			     ((substr($pis, 4,1)) * 11) +
  			     ((substr($pis, 5,1)) * 10) +
  			     ((substr($pis, 6,1)) * 9) +
  			     ((substr($pis, 7,1)) * 8) +
  			     ((substr($pis, 8,1)) * 7) +
  			     ((substr($pis, 9,1)) * 6) +
  			     ((substr($pis, 10,1)) * 5));
  		$resto = fmod($soma, 11);
  		$dv = 11  - $resto;
  		if ($dv == 11) {
  			$dv = 0;
  		}
  		if ($dv == 10) {
  			$soma = ((((substr($pis, 0,1)) * 15) +
  		              ((substr($pis, 1,1)) * 14) +
  			          ((substr($pis, 2,1)) * 13) +
  			          ((substr($pis, 3,1)) * 12) +
  			          ((substr($pis, 4,1)) * 11) +
  			          ((substr($pis, 5,1)) * 10) +
  			          ((substr($pis, 6,1)) * 9) +
  			          ((substr($pis, 7,1)) * 8) +
  			          ((substr($pis, 8,1)) * 7) +
  			          ((substr($pis, 9,1)) * 6) +
  			          ((substr($pis, 10,1)) * 5)) + 2);
  			$resto = fmod($soma, 11);
  			$dv = 11  - $resto;
  			$resultado = $pis."001".$dv;
  		} else {
  			$resultado = $pis."000".$dv;
  		}
  		if ($cns != $resultado){
              return;
          } else {
          	return true;
  		}
  	}
  }
  /**
  * Valida CNS (Cartão SUS) Definitivo
  *
  * #Rotina de validação de Números que iniciam com “7”, “8” ou “9”
  *
  * @access public
  * @static
  * @param $cns
  * @return {type} Boolean
  */
  private function validaCNS_Provisorio($cns) {
    #Elimina possível máscara
    $cns = self::only_number($cns);
    #Preenche com zeros a esquerda até o total de 15 dígitos
    $cns = str_pad($cns, 15, '0', STR_PAD_LEFT);
    #Verifica se o número de digitos informados é igual a 15
    if (strlen($cns) != 15) {
      return;
    }
    #Verifica nis zerado
    else if ($cns == '000000000000000') {
      return;
    } else {
      #Inicia validação final do CNS Provisório
			$soma = (((substr($cns,0,1)) * 15) +
			((substr($cns,1,1)) * 14) +
			((substr($cns,2,1)) * 13) +
			((substr($cns,3,1)) * 12) +
			((substr($cns,4,1)) * 11) +
			((substr($cns,5,1)) * 10) +
			((substr($cns,6,1)) * 9) +
			((substr($cns,7,1)) * 8) +
			((substr($cns,8,1)) * 7) +
			((substr($cns,9,1)) * 6) +
			((substr($cns,10,1)) * 5) +
			((substr($cns,11,1)) * 4) +
			((substr($cns,12,1)) * 3) +
			((substr($cns,13,1)) * 2) +
			((substr($cns,14,1)) * 1));
			$resto = fmod($soma,11);
			if ($resto != 0) {
				return;
			} else {
				return true;
			}
  	}
  }
}
?>
