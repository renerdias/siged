<?php

namespace root\server\sys\lib\db;

use PDO;
use root\server\sys\lib\config\Config;

/**
 * Classe responsável por criar uma nova conexão com o banco de dados
 *
 * @package sys/lib
 * @subpackage db
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class DBConnection {

    /**
     * Está função é executada no momento de criação da classe
     * Não existirão instâncias de TConexao, por isto estamos marcando-o como private
     *
     * @access private
     * @return void
     */
    private function __construct() {

    }

    /**
     * Método responsável por criar uma nova conexão como o banco de dados
     * e instanciar o objeto PDO correspondente
     *
     * @access public
     * @static
     * @param string $_name Nome do banco a ser conectado
     * @return object Retorna uma instância do objeto PDO criada
     */
    public static function create($name) {
      //TODO: DBConnection dever ser revista
      $config = Config::load(dirname(__FILE__). '../../config/config.json');
      $conf = $conf->get('connection.' . $name);
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=
      $SGDB = $conf->sgdb;
      $server = $conf->server;
      $port = $conf->port;
      $dbname = $conf->dbname;
      $user = $conf->user;
      $password = $conf->password;
      #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--==-=-=-=-=-=-=

        # Escolhe o driver de banco de dados a ser utilizado de acordo com o
        # banco informado no arquivo de configurações
        switch ($SGDB) {
            case 'pgsql':
                $port = $port ? $port : '5432';
                $conn = new PDO("pgsql:dbname={$dbname}; user={$user}; password={$password};
                        host=$server;port={$port}");
                break;
            case 'mysql':
                $port = $port ? $port : '3307';
                $conn = new PDO("mysql:host={$server};port={$port};dbname={$dbname}", $user, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                break;
            case 'sqlite':
                $conn = new PDO("sqlite:{$dbname}");
                break;
            case 'firebird':
                $conn = new PDO("firebird:dbname={$dbname}", $user, $password);
                break;
        }
        # Define que o PDO lance exceções na ocorrência de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        # Retorna o objeto PDO instanciado.
        return $conn;
    }
}
