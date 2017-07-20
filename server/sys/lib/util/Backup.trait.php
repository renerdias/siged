<?php

namespace root\server\sys\lib\util;

use root\server\sys\lib\util\TUtil;
use root\server\sys\lib\config\Config;
/**
 * Trecho de código que concentra os métodos de backup
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait Backup {
  /**
  * Backup PostgreSQL
  *
  * @access public
  * @static
  * @param $config
  * @return {type} Boolean
  */
//TODO Backup PostgreSQL->Remover configurações de conexão daqui
    public static function backup_postgreSQL($name) {
      //TODO: backup_postgreSQL deve sr revisto
      #Pega o caminho da pasta root do servidor web (www)
      $root = $_SERVER["DOCUMENT_ROOT"];
      $config = Config::load($root . '/r2/siged/server/sys/config/config.json');
      $conf = $config->get('connection.' . $name);
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=
      $DBHost = $conf['server'];
      $DBPort = $conf['port'];
      $DB = $conf['dbname'];
      $DBUser = $conf['user'];
      $DBPass = $conf['password'];
      $filename = TUtil::time__is_now('Ymd-Hms');
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=
      //TODO: Criar no config path para pg_dump para backup/restore
        $comand = "export PGPASSWORD=$DBPass && export PGUSER=$DBUser";
        $comand .= " && /opt/PostgreSQL/9.6/bin/pg_dump --host $DBHost --port $DBPort -d $DB --format custom --blobs --encoding UTF8 --no-privileges --no-tablespaces --no-unlogged-table-data --file '$DB-$filename.r2bk' > error.log";
        $comand .=" && unset PGPASSWORD=$DBPass && unset PGUSER=$DBUser";
        //Função do Php
        exec($comand, $saida, $retorno);
        if ($retorno == 0) {
            return true;
        } else {
            return;
        }

        /*
          switch (strtoupper(PHP_OS)) {
          case 'WINNT':


          break;
          case 'LINUX':
          $pg_dump = '/opt/PostgreSQL/9.5/bin/pg_dump';
          $user = 'postgres';
          $password = 'postgres';
          $database = 'siged';
          $output = '/home/rener/Documentos';

          break;
          default:
          break;
          }
          $return = '';
          $cmd = "$pg_dump -U $user -W $password -Ft $database > $output";
          exec($cmd, $output, $return);
         */
        //return new static();
    }

}

?>
