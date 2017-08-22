<?php

namespace root\server\sys\lib\session;

/**
 * Classe responsável por manipular as sessões do sistema
 *
 * @package sys/lib
 * @subpackage session
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class Security {
/*
OBTER IP
$ip = "";
  $ip_remoto = "";
  if (isset($_SERVER['REMOTE_ADDR'])){
    $ip_remoto = $_SERVER['REMOTE_ADDR'];
  }
  if (!empty( $_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif( !empty( $_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //to check ip passed from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }

*/
private $session_opened;
    /**
     * Método executado no momento de criação da classe
     * Não existirão instâncias de Session, por isto estamos marcando-o como private
     *
     * @access public
     * @return void
     */
    public function __construct() {

    }

    /**
     * Método reponsável por iniciar a sessão
     *
     * @access public
     * @static
     * @return void
     */
    public function init() {
        # Inicia a sessão
        session_start();
        $this->session_opened = true;
        return $this;
    }

    /**
     * Método reponsável por retornar a conexão que está ativa
     *
     * @access public
     * @static
     * @return object Retorna a conexão ativa (instância do objeto PDO)
     */
    public function get($key) {
      if ($this->session_opened){
        return $_SESSION[$key] ;
      } else {
        trigger_error("Session não foi iniciada!", E_USER_ERROR);
      }
    }

    /**
     * Método reponsável por desfazer todas as operações realizadas
     * na transação e não gravadas no banco
     *
     * @access public
     * @static
     * @return void
     */
    public function set($key, $value) {
      if ($this->session_opened){
        $_SESSION[$key] = $value ;
        return $this;
      } else {
        trigger_error("Session não foi iniciada!", E_USER_ERROR);
      }
    }
    /**
     * Método reponsável por fechar/destruir a sessão
     *
     * @access public
     * @static
     * @return void
     */
    public function write() {

      session_write_close();
      return $this;
    }
    /**
     * Método reponsável por fechar/destruir a sessão
     *
     * @access public
     * @static
     * @return void
     */
    public function destroy() {
      session_destroy();
    }
}
