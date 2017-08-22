<?php

namespace root\server\sys\lib\sendmail;

/**
 * Classe responsável por enviar email's
 *
 * @package sys/lib
 * @subpackage sendmail
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
class SendMail {
  #Rementente
  protected $from = 'siged@rnr';
  protected $to;
  protected $cc;
  protected $cco;
  protected $subject;
  protected $message;

    /**
     * Método executado no momento de criação da classe
     * Não existirão instâncias novas, por isto estamos marcando-o como private
     *
     * @access public
     * @return void
     */
    public function __construct() {

    }

    /**
     *
     *
     * @access public
     * @static
     * @return void
     */
    public function from($str) {
        #Rementente
        $this->from = $str;
        return $this;
    }

    /**
     *
     *
     * @access public
     * @static
     * @return void
     */
    public function to($str) {
      $this->to = $str;
      return $this;
    }

    /**
     *
     *
     * @access public
     * @static
     * @return void
     */
    public function cc($str) {
        $this->cc = $str;
        return $this;
    }
    /**
     *
     *
     * @access public
     * @static
     * @return void
     */
    public function cco($str) {
      $this->cco = $str;
      return $this;
    }
    /**
     *
     *
     * @access public
     * @static
     * @return void
     */
    public function subject($str) {
      $this->subject = $str;
      return $this;
    }

    /**
     * Método reponsável por fechar/destruir a sessão
     *
     * @access public
     * @static
     * @return void
     */
    public function message($str) {
      $msg = "
        <html>
          <head>
            <title>HTML email</title>
          </head>
          <body>
            $str
            </body>
        </html>
      ";
      $this->message = $msg;
      return $this;
    }
    /**
     *
     *
     * @access public
     * @static
     * @return void
     */
    public function send() {
      // Always set content-type when sending HTML email
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // More headers
      $headers .= "From: $this->from" . "\r\n";
      /*
      if ($this->cc){
        $headers .= "Cc: $this->cc" . "\r\n";
      }
      if ($this->cco){
        $headers .= "Cco: $this->cco" . "\r\n";
      }
      */
      mail($this->to,$this->subject,$this->message,$headers);
    }
}
