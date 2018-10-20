<?php
// https://coa520.com/audit/testEmail.php 
/*
	ini_set("sendmail_from", "form-mailer@ciniva.com");
	ini_set("SMTP", "mail.ciniva.com");
	
	$headers = 'From: contact@maggiedavis.com' . "\r\n" . "Content-type: text/html\r\n".
    'X-Mailer: PHP/' . phpversion();
	$message = 	"<b>HTML test</b><br><br> xxxxxxxxxxx";
	$subject = "Contact form"; 
	mail("steve7642@gmail.com", $subject, $message,  $headers);
*/ 
$to      = 'steve7642@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@coa520.com' . "\r\n" . 
            // ^ This is where you update your header to show the sender
    'Reply-To: webmaster@coa520.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);		 
		 echo 'OK?'; 
		 
	//header("location:http://maggidavis.com/thankyou.html"   ); // cannot execute after echo !!
?>