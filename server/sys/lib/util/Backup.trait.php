<?php

namespace root\server\sys\lib\util;

use root\server\sys\lib\util;
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
    public static function backup_postgreSQL() {
      //TODO: backup_postgreSQL deve sr revisto
      $config = Config::load(dirname(__FILE__). '../config/config.json');
      $conf = $conf->get('connection.' . $name);
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=
      $SGDB = $conf->sgdb;
      $server = $conf->server;
      $port = $conf->port;
      $dbname = $conf->dbname;
      $user = $conf->user;
      $password = $conf->password;
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=

        //"pg_dump --host $DBServer --port $DBPort -U $DBUser --format custom --blobs --encoding UTF8 --no-privileges --no-tablespaces --no-unlogged-table-data --file > saida.psql"
        $DBHost = "localhost";
        $DBPort = "5432";
        $DB = "siged";
        $DBUser = "postgres";
        $DBPass = "postgres";
        $filename = TUil::time__is_now('Ymd-Hms');

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
