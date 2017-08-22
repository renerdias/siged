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
    public static function backup_postgreSQL($name) {
      //TODO: backup_postgreSQL deve sr revisto
      #Pega o caminho da pasta root do servidor web (www)
      $config = Config::load(BASE_PATH . '/server/sys/config/config.json');
      $conf = $config->get('connection.' . $name);
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=
      $DBHost = $conf['server'];
      $DBPort = $conf['port'];
      $DB = $conf['dbname'];
      $DBUser = $conf['user'];
      $DBPass = $conf['password'];
      //TODO: Criar no config path para pg_dump para backup/restore
      $dump_path = '/opt/PostgreSQL/9.6/bin';

      $data_inicio = TUtil::time__is_now('d-m-Y H:i:s');
      TUtil::time__start_exec();
      $filename = "$DB-" . TUtil::time__is_now('Ymd-His') . ".r2bk";
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=
        $comand = "export PGPASSWORD=$DBPass && export PGUSER=$DBUser";
        $comand .= " && $dump_path/pg_dump --host $DBHost --port $DBPort -d $DB --format custom --blobs --encoding UTF8 --no-privileges --no-tablespaces --no-unlogged-table-data --file $filename > error.log";
        $comand .=" && unset PGPASSWORD=$DBPass && unset PGUSER=$DBUser";
        //Função do Php
        exec($comand, $saida, $retorno);
        $timeEnd = TUtil::time__end_exec();
        if ($retorno == 0) {
          $execucao['sucesso'] = true;
          $execucao['nome'] = $filename;
          $execucao['data_inicio'] = $data_inicio;
          $execucao['data_conclusão'] = TUtil::time__is_now('d-m-Y H:i:s');
          $execucao['tamanho'] = TUtil::byte_to_size(filesize($filename));
          $execucao['duracao'] = $timeEnd;
          return $execucao;
          //return true;
        } else {
            return;
        }
    }
}

?>
