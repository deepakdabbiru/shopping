<?php

 require_once('class.phpmailer.php');
 include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail= new PHPMailer();
$body= "Hai,your verification code to book ticket.";
//$body = eregi_replace("[\]",'',$body);

 

$mail->IsSMTP(); // telling the class to use SMTP

$mail->Host = "ssl://smtp.gmail.com"; // SMTP server

$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)

// 1 = errors and messages

// 2 = messages only

$mail->SMTPAuth   = true;                  // enable SMTP authentication

$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

//$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

$mail->Username   = "deepak.@gmail.com";  // GMAIL username

$mail->Password   = "dad@143@me";            // GMAIL password 

$mail->SetFrom('deepak.dabbiru@gmail.com');

 

//$mail->AddReplyTo("deepak.dabbiru@gmail.com","First Last");

 

$mail->Subject    = "PHPMailer Test Subject via smtp (Gmail), basic";

 

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

 

$mail->MsgHTML($body);

 

$address = "deepak.dabbiru@gmail.com";

$mail->AddAddress($address, "Deepak Dabbiru");

 

//$mail->AddAttachment("images/phpmailer.gif");      // attachment

//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {

echo "Mailer Error: " . $mail->ErrorInfo;

} else {

echo "Message sent!";

}
 
?>