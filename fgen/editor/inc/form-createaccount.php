<?php
session_start();

require_once('../class/class.contactformeditor.php');
$contactformeditor_obj = new contactFormEditor();

require_once('../sourcecontainer/'.$contactformeditor_obj->dir_form_inc.'/class/class.contactform.php');
$contactform_obj = new contactForm($cfg=array());

// only possible when not using the demo
if($contactform_obj->demo != 1)
{
	
	$login = trim($contactformeditor_obj->quote_smart($_POST['user-login']));
	
	$length_login_min = 2;
	$length_login_max = 30;
	
	if(!preg_match('#^[a-z0-9]{'.$length_login_min.','.$length_login_max.'}$#i',$login)){
		$_SESSION['error'][] = 'Please enter a valid username with letters and numbers only ('.$length_login_min.' characters min, '.$length_login_max.' characters max)';
	}
	
	
	$pwd1 = trim($contactformeditor_obj->quote_smart($_POST['user-password-1']));
	$pwd2 = trim($contactformeditor_obj->quote_smart($_POST['user-password-2']));
	
	if(!$pwd1 && !$pwd2)
	{
		$_SESSION['error'][] = 'Please enter a password';
	} else{
		
		$length_pwd_min = 4;
		$length_pwd_max = 30;
		
		if($pwd1)
		{
			if(strlen($pwd1)<$length_pwd_min)
			{
				$_SESSION['error'][] = 'Your password must be at least '.$length_pwd_min.' characters long';
			}
				
			if(strlen($pwd1)>$length_pwd_max)
			{
				$_SESSION['error'][] = 'Your password can\t be longer than '.$length_pwd_max.' characters long';
			}
		}
			
		if($pwd1 != $pwd2)
		{
			$_SESSION['error'][] = 'Please enter the same password in the two password fields';
		}
	}
	
	if(isset($_SESSION['error']) && $_SESSION['error'])
	{
		header('Location: ../../index.php');
		exit;
	}
	
	
	$fp = fopen('user.php', 'w+');
	
	$config = '<?php'."\r\n";
	$config .= '$user[\'login\'] = \''.$login.'\';'."\r\n";
	$config .= '$user[\'password\'] = \''.sha1($pwd1).'\';'."\r\n";
	$config .= '?>'."\r\n";
	
	fwrite($fp, $config);
	
	fclose($fp);
	
	
	// delete previously installed cookie (cookie installed / delete user.php / create account)
	if(isset($_COOKIE['user']))
	{
		setcookie('user', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
	}
	
	
	
	$_SESSION['validation'] = 'Your account was successfully created. Please log in.';
	
	header('Location: ../../index.php');
	exit;
}
?>