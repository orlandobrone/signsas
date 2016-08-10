<?php
session_start(); // new value for $_SESSION['user']

require_once('../class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();

require_once('../sourcecontainer/'.$contactformeditor_obj->dir_form_inc.'/class/class.contactform.php');
$contactform_obj = new contactForm($cfg=array());


// only possible when not using the demo
if($contactform_obj->demo != 1)
{
	
	$contactformeditor_obj->authentication(true);
	
	
	$login = trim($contactformeditor_obj->quote_smart($_POST['user-login']));
	
	$length_login_min = 2;
	$length_login_max = 30;
	
	if(!preg_match('#^[a-z0-9]{'.$length_login_min.','.$length_login_max.'}$#i',$login)){
		$error[] = 'Please enter a valid username with letters and numbers only ('.$length_login_min.' characters min, '.$length_login_max.' characters max)';
	}
	
	
	$pwd1 = trim($contactformeditor_obj->quote_smart($_POST['user-password-1']));
	$pwd2 = trim($contactformeditor_obj->quote_smart($_POST['user-password-2']));
	
	if(!$pwd1 && !$pwd2)
	{
		$error[] = 'Please enter a password';
	} else{
		
		$length_pwd_min = 4;
		$length_pwd_max = 30;
		
		if($pwd1)
		{
			if(strlen($pwd1)<$length_pwd_min)
			{
				$error[] = 'Your password must be at least '.$length_pwd_min.' characters long';
			}
				
			if(strlen($pwd1)>$length_pwd_max)
			{
				$error[] = 'Your password can\t be longer than '.$length_pwd_max.' characters long';
			}
		}
			
		if($pwd1 != $pwd2)
		{
			$error[] = 'Please enter the same password in the two password fields';
		}
	}
	
	if(isset($error) && $error)
	{
		$json_error = '';
		
		foreach($error as $value)
		{
			$json_error .= '<p><strong>ERROR</strong>: '.$value.'</p>';
		}
	
		echo '{"response":"nok",'
				.' "response_msg":"'.$json_error.'"'
				.'}';
		exit;
	}
	
	$fp = fopen('user.php', 'w+');
	
	$config = '<?php'."\r\n";
	$config .= '$user[\'login\'] = \''.$login.'\';'."\r\n";
	$config .= '$user[\'password\'] = \''.sha1($pwd1).'\';'."\r\n";
	$config .= '?>'."\r\n";
	
	fwrite($fp, $config);
	
	fclose($fp);
	
	
	// update session and cookie
	$_SESSION['user'] = $login;
	$cookie_expire_in_days = 30;
	setcookie('user', $login.'*'.sha1($pwd1), time()+60*60*24*$cookie_expire_in_days, '/', $_SERVER['SERVER_NAME']);
	
	
	echo '{"response":"ok",'
			.' "response_msg":"Your account was successfully changed."'
			.'}';
}
?>