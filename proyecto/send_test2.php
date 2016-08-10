<?php

include 'phpMailer/class.phpmailer.php';

$mail = new PHPMailer();
 
$mail->Host = 'sig.signsas.com'; // <- el host es local porque utilizo servidor smtp del hosting
$mail->SMTPDebug  = 2; 
 
$mail->From 	  = 'jordonezb@operacionsign.com';
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "sig.signsas.com"; // sets the SMTP server
$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
$mail->Username   = "jordonezb@operacionsign.com"; // SMTP account username
$mail->Password   = "pau2320245";        // SMTP account password
  
$mail->FromName = 'Compartido';
$mail->Subject = 'Test Hosting Signsas';
$mail->IsHTML(true); 
$mail->AddAddress("info@signsas.com","Jonathan Ordoñez");
$mail->AddAddress("jordonezb@operacionsign.com","Jonathan Ordoñez");

 
 
echo $mail->Body = "Hola probando mail con un nombre <b>distinto</b>";
 
 
if(!$mail->Send())
{
    echo "Se ha producido un error al enviar el correo.";
 
    echo "Mailer Error: " . $mail->ErrorInfo;
 
    exit;
 
}


$para      = 'jordo@signsas.com';
$titulo    = 'El título';
$mensaje   = 'Hola';
$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
 
?>