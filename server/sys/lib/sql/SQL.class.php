<?php

namespace root\server\sys\lib\sql;

use root\server\sys\lib\db\DBTransaction;
/**
 * Classe genérica de execução de instruções SQL
 *
 * @package sys/lib
 * @subpackage sql
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
final class SQL {
    
    /**
     * @var $conn Recebe uma instância de PDO
     * @static
     * @access private
     */
    private static $conn;
    
    /**
     * Método executado no momento de criação da classe
     * 
     * @access private
     * @return void
     */ 
    private function __construct() {}
    
    /**
     * Método reponsável por executar instruções select
     * 
     * @static
     * @access public
     * @param string $_sql Recebe a instrução sql
     * @return mixed Retorna dados diversos
     */
    public static function select($_sql) {
        # Obtém uma transação ativa, caso haja
        if (self::$conn = DBTransaction::get()) {  
            $sqlResult = self::$conn->Query($_sql);
            
            $result = array();

            if ($sqlResult) {
                # Percorre os resultados da consulta, retornando um objeto
                while ($line = $sqlResult->fetchObject()) {
                    # Armazena no array $results;
                    $result[] = $line;
                }
            }
            return $result;
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }
    
    /**
     * Método reponsável por executar instruções sql diversas
     * 
     * @static
     * @access public
     * @param string $_sql Recebe a instrução sql
     * @return mixed Retorna dados diversos
     */
    public static function exec($_sql) {
        # Obtém uma transação ativa, caso haja
        if (self::$conn = DBTransaction::get()) {  
            return self::$conn->exec($_sql);
        } else {
            # Se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!!');
        }
    }    
}
