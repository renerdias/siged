<?php

namespace root\server\sys\lib\util;

use Exception;

define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(__FILE__));
/**
 * Classe responsável por organizar função de diversas utilidades
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class TUtil {
  //REVIEW: Precisa de obseração/correção
  use Backup;
  use Convert;
  //REVIEW: Precisa de obseração/correção
  use Dir;
  //REVIEW: Precisa de obseração/correção
  use Fonetizar;
  use Guid;
  use Number;
  use Time;
  use validators\Doc;
  Use validators\Email;
  use validators\Number;
  use validators\String;
  use validators\Phone;

  #Constantes devem ficar aqui, pois trait's não aceitam constantes
  const FORMAT_DEFAULT = 'dmY His';
}
