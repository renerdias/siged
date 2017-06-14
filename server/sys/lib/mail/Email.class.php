<?php
date_default_timezone_get();
class Email {

	private $from;
	private $reply;
	private $message;
	private $cc;
	private $bcc;
	private $to;
	private $subject;

	public function __construct() {

		return $this->clear();
	}

	public function clear() {

		$this->from = "";
		$this->reply = "";
		$this->message = "";
		$this->cc = array();
		$this->bcc = array();
		$this->to = array();
		$this->subject = "";
		$this->attachment = array();

		return $this;
	}

	public function setFrom( $from ) {

		$this->from = $from;

		return $this;
	}


	public function setReply( $reply ) {

		$this->reply = $reply;

		return $this;
	}

	public function addCc( $cc ) {

		$this->cc[] = $cc;

		return $this;
	}

        public function addBcc( $bcc ) {

                $this->bcc[] = $bcc;

                return $this;
        }

        public function addTo( $to ) {

                $this->to[] = $to;

                return $this;
        }

	public function setSubject( $subject ) {

		$this->subject = $subject;

		return $this;
	}

	public function setMessage( $message ) {

		$this->message = $message;

		return $this;
	}

	public function addAttachment( $attachment ) {

		$this->attachment[] = $attachment;

		return $this;
	}


	public function send() {

		if( count( $this->to ) <= 0 ){

			return false;
		}

		$emailsTo = implode( ",", $this->to );

		$headers = "MIME-Version: 1.0\n";

		if( !empty( $this->from ) )
    			$headers .= "From: " . $this->from . "\r\n";

		if( !empty( $this->reply ) )
			$headers .= "Reply-To: " . $this->reply . "\r\n";

		if( count( $this->cc ) > 0  ) {

			$headers .= "Cc: " . implode( ",", $this->cc ) . "\r\n";
		}

                if( count( $this->bcc ) > 0  ) {

                        $headers .= "Bcc: " . implode( ",", $this->bcc ) . "\r\n";
                }

    		$boundary = "XYZ-" . date("dmYis") . "-ZYX";

		$headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
		$headers .= "$boundary\n";

		$fullMessage  = "--$boundary\n";
    		$fullMessage .= "Content-Transfer-Encoding: 8bits\n";
    		$fullMessage .= "Content-Type: text/html; charset=\"utf-8\"\n\n";
    		$fullMessage .= $this->message . "\n";

		foreach( $this->attachment as $a ) {

    			$fullMessage .= "--$boundary\n";
			$fullMessage .= "Content-Type: ". $a->getMimeType() . "\n";
    			$fullMessage .= "Content-Disposition: attachment; filename=\"" . $a->getBaseName() . "\"\n";
    			$fullMessage .= "Content-Transfer-Encoding: base64\n\n";
    			$fullMessage .= chunk_split( base64_encode( $a->getFile() ) ) . "\n";
		}

		$fullMessage .= "--$boundary\n";

		return mail( $emailsTo, $this->subject, $fullMessage, $headers );
	}
}
