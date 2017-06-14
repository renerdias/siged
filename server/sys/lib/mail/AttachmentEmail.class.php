<?php

class AttachmentEmail {

	private $path;
	private $file;

	public function __construct( $path ) {

		$this->file = "";		

		$this->path = $path;

		$fp = fopen( $this->path, "rb" ); 
    		
		$this->file = fread( $fp, $this->getFileSize() );
   	 	
		fclose($fp);
	}

	public function getFileSize() {
	
		return filesize( $this->path );
	}

	public function getPath() {

		return $this->path;
	}

	public function getBasename() {

		return basename( $this->path );
	}

	public function getMimeType() {

		return mime_content_type( $this->path );
	}
	
	public function getFile() {

		return $this->file;
	}
	
	public function __toString() {

		return $this->path;
	}
}


