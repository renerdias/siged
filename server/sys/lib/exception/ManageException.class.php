<?php

//TODO: Classe ManageException dever ser revista
namespace root\server\sys\lib\exception;

use root\server\sys\lib\phpmailer\PHPMailer;

/**
 * Classe voltada para tratamento de erros.
 *
 * @package sys/lib
 * @subpackage exception
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
Class ManageException
{
	private $mailTo = "renerdias@live.com";
	private $mailFrom = "no-reply@gmail.com.br";
	private $mailReplyTo = "renerdias@live.com";
	private $mailMode = 1;
	#Erros que vão para o log
	private $userErrors = array(
		E_WARNING,
		E_USER_ERROR,
		E_USER_WARNING,
		E_USER_NOTICE
	);
	#Erros que vão para o email
	private $errorType = array(
		E_ERROR => "ERRO FATAL",
		E_WARNING => "ALERTA",
		E_PARSE => "ERRO DE SINTAXE",
		E_NOTICE => "AVISO",
		E_CORE_ERROR => "ERRO DE PROCESSAMENTO",
		E_CORE_WARNING => "ALERTA DE PROCESSAMENTO",
		E_COMPILE_ERROR => "ERRO DE COMPILAÇÃO",
		E_COMPILE_WARNING => "ALERTA DE COMPILAÇÃO",
		E_USER_ERROR => "ERRO DO USUÁRIO",
		E_USER_WARNING => "ALERTA DO USUARIO",
		E_USER_NOTICE => "AVISO DO USUARIO",
		E_STRICT => "AVISO ESTRITO"
	);
	private $ignoreErrors = array(
		E_NOTICE,
		E_WARNING
	);
	private $logMode = 1;
	private $logMsg;
	private $t = "\t";
	private $el = "\r\n";
	private $corpMsg;
	/**
	 * Registra a função que irá tratar o erros capturados
	 *
	 * @access private
	 * @return void
	 */
	public function register()
	{
		set_error_handler(array($this,"catchMyErrors"));
		// set_exception_handler(array($this, "catchMyErrors"));
	}



	private function ignoreErrors()
	{
		if (!in_array($_SERVER['REMOTE_ADDR'], array(
			'127.0.0.1',
			'::1'
		)) && in_array($errno, $this->getIgnoreErrors())) {
			return;
		}
	}
	private function setCorpMsg($var)
	{
		$consCorpMsg = array(
			"CRDT",
			"CRERRNO",
			"CRERRORTYPE",
			"CRERRMSG",
			"CRFILENAME",
			"CRLINENUM"
		);
		$corp = "<b>Informações sobre o erro:</b>" . $this->el;
		$corp.= "<ul>" . $this->el;
		$corp.= $this->t . "<li>Data e hora: CRDT</li>" . $this->el;
		$corp.= $this->t . "<li>Tipo: CRERRNO CRERRORTYPE</li>" . $this->el;
		$corp.= $this->t . "<li>Descrição: CRERRMSG</li>" . $this->el;
		$corp.= $this->t . "<li>Arquivo: CRFILENAME</li>" . $this->el;
		$corp.= $this->t . "<li>Linha: CRLINENUM</li>" . $this->el;
		$corp.= "</ul>";
		$this->corpMsg = str_replace($consCorpMsg, $var, $corp);
	}
	private function setLogMsg($var)
	{
		$this->logMsg["line"] = $var[0];
		$this->logMsg["file"] = $var[1];
		$this->logMsg["message"] = $var[2];
		$this->logMsg["datetime"] = $var[3];
	}






	public function catchMyErrors($errno, $errmsg, $filename, $linenum, $vars)
	{
		try {
			$this->ignoreErrors();
			$dt = date("d-m-Y H:i:s");
			$errmsg = $str = mb_convert_encoding($errmsg, "ISO-8859-1", "ASCII,JIS,UTF-8,ISO-8859-1");
			$this->setCorpMsg(array(
				$dt,
				$errno,
				$this->errorType[$errno],
        $errmsg,
        $filename,
        $linenum));
			if (in_array($errno, $this->userErrors)) {
				if ($this->logMode == 1) {
					$this->setLogMsg(array(
						$linenum,
						$filename,
						$errmsg,
						$dt
					));
					$this->saveLog($errno);
				}
				if ($this->mailMode == 1) {
					$this->sendMail();
				}
			}
		}
		catch(Exception $e) {
			echo 'Erro desconhecido: ' . $e->getMessage();
		}
	}
	#=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	#Manipulação do arquivo de log
	/**
	 * Retorna o nome do arquivo log xml do dia atual
	 *
	 * @access private
	 * @return {type} String
	 */
	private function getFileLog()
	{
		return date("Ymd") . "-error_log.xml";
	}
	/**
	 * Cria arquivo log xml
	 *
	 * @access private
	 * @return void
	 */
	private function createFileLog()
	{
		$corp = "<?xml version='1.0' encoding='ISO-8859-1'?>" . $this->el;
		$corp.= $this->t . '<errors>' . $this->el;
		$corp.= $this->t . '</errors>';
		$file = fopen($this->getFileLog(), "w+");
		fwrite($file, $corp);
		fclose($file);
	}
	/**
	 * Cria os detalhes do log
	 *
	 * @access private
	 * @param $child Recebe um CHILD do xml
	 * @return void
	 */
	private function createLogDetails($child)
	{
		$child->addAttribute("line", $this->logMsg["line"]);
		$child->addAttribute("file", $this->logMsg["file"]);
		$child->addAttribute("message", $this->logMsg["message"]);
		$child->addAttribute("datetime", $this->logMsg["datetime"]);
	}
	/**
	 * Salva log no arquivo xml
	 *
	 * @access private
	 * @param $errno Recebe o numero do erro
	 * @return void
	 */
	private function saveLog($errno)
	{
		if (!file_exists($this->getFileLog())) $this->createFileLog();
		$xml = simplexml_load_file($this->getFileLog());
		$exist = false;
		foreach($xml->error as $errorLine) if ($errorLine["code"] == $errno) {
			$child = $errorLine->addChild("details");
			$this->createLogDetails($child);
			$exist = true;
			break;
		}
		if (!$exist) {
			$error = $xml->addChild("error");
			$error->addAttribute("type", $this->errorType[$errno]);
			$error->addAttribute("code", $errno);
			$child = $error->addChild("details");
			$this->createLogDetails($child);
		}
		file_put_contents($this->getFileLog(), $xml->asXML());
	}
	#=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
	/**
	 * Envia email em caso de erro
	 *
	 * @access private
	 * @return void
	 */
	private function sendMail()
	{
    #Cria uma nova instância de PHPMailer
    $mail = new PHPMailer;
    #Diz ao PHPMailer para usar SMTP
    $mail->isSMTP();
		#=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    #Informa o hostname do servidor de email
    $mail->Host = "smtp-mail.outlook.com";
    #Informa a porta do SMTP - Normalmente 25, 465 or 587
    $mail->Port = 587;
    #Informa que será usada autenticação
    $mail->SMTPAuth = true;
		#=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    #Informa o usuário SMTP para autenticação
    $mail->Username = "renerdias@live.com";
    #Informa a senha SMTP para autenticação
    $mail->Password = "Desenvolvimento";
		#=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    #Defina de quem a mensagem deve ser enviada
    $mail->setFrom('renerdias@live.com', 'SIGED');
    #Defina pra quem a mensagem está sendo enviada
    $mail->addAddress('renerdias@live.com', 'Rener Dias');
    #=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    #Defina o título da mensagem
    $mail->Subject = 'SIGED - Alerta';
    #Defina a mensagem a ser enviada
    $mail->msgHTML($this->corpMsg);
		#=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    #Envia a mensagem e checa erros
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
	}
}
