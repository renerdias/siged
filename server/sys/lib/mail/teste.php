<?php

require_once "Email.class.php";
require_once "AttachmentEmail.class.php";


/*

$email = new Email( array(

	"from"=>"from@email.com",
	"to"=>"to@email.com",
	"message"=>"message",
	"subject"=>"subject",
	"cc"=>"cc@email.com",
	"bcc"=>"bcc@email.com",
	"attachment"=>array( new AttachmentEmail( "Email.php" ) )
) );

$email->send();
*/

/*
$email = new Email();

$email->setFrom("from@email.com");
$email->setReply("reply@email.com");
$email->setSubject("Subject");
$email->setMessage("message");
$email->addTo( "to@email.com" );
$email->addCc( "cc@email.com" );
$email->addBcc( "bcc@email.com" );
$email->addAttachment( new AttachmentEmail("Email.php") );
$email->send();
*/

$email = new Email();

$email->setSubject("Subject")->setMessage("message")->addTo("renerdias@live.com")->send();
