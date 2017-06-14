<?php

namespace root\server\sys\lib\db;

/**
 * Classe responsável por manipular as transações com o banco de dados
 *
 * @package sys/lib
 * @subpackage db
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class DBTransaction {

    /**
     * @var $conn Recebe uma instância de PDO
     * @static
     * @access private
     */
    private static $conn;

    /**
     * Método executado no momento de criação da classe
     * Não existirão instâncias de DBTransaction, por isto estamos marcando-o como private
     *
     * @access private
     * @return void
     */
    private function __construct() {

    }

    /**
     * Método reponsável por criar uma conexão como o banco de dados
     * e iniciar uma transação
     * 
     * @access public
     * @static
     * @param string $_dbname Recebe o nome do banco de dados
     * @return void
     */
    public static function open($_dbname) {
        # Abre uma conexão e armazena na propriedade estática $conn
        if (empty(self::$conn)) {
            self::$conn = DBConnection::create($_dbname);
            # Inicia a transação
            self::$conn->beginTransaction();
        }
    }

    /**
     * Método reponsável por retornar a conexão que está ativa
     * 
     * @access public
     * @static
     * @return object Retorna a conexão ativa (instância do objeto PDO)
     */
    public static function get() {
        # Retorna a conexão ativa
        return self::$conn;
    }  

    /**
     * Método reponsável por desfazer todas as operações realizadas
     * na transação e não gravadas no banco
     * 
     * @access public
     * @static
     * @return void
     */
    public static function rollback() {
        if (self::$conn) {
            # Desfaz as operações realizadas durante a transação
            self::$conn->rollback();
            # Limpa variável
            self::$conn = NULL;
        }
    }
    
    /**
     * Método reponsável por gravar todas operações realizadas e fecha a transação
     * 
     * @access public
     * @static
     * @return void
     */
    public static function commit() {
        if (self::$conn) {
            # Aplica as operações realizadas durante a transação
            self::$conn->commit();
            # Limpa variável
            self::$conn = NULL;
        }
    }    
}
