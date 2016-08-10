<?php
session_start();

require_once('../class/class.contactformeditor.php');
$cfg_obj = new contactFormEditor();


if(!file_exists('user.php'))
{
	header('Location: ../../index.php');
	exit;
}

require_once('user.php');

if(!isset($user['login']) || !isset($user['password']))
{
	header('Location: ../../index.php');
	exit;
}

// VERIFY LOGIN AND PASSWORD
$post_login = trim($cfg_obj->quote_smart($_POST['user-login']));
$post_pwd = sha1($cfg_obj->quote_smart($_POST['user-password']));

if(sha1(trim($_POST['cr'])) != $cfg_obj->cr_sha1)
{
	$_SESSION['error'][] = 'It seems you have changed or removed the original copyright notice.'
									.'<br /><br />This software can only work with the Top Studio copyright notice.'
									.'<br /><br />Restore the original notice or contact us by email on Code Canyon to solve this problem.';
}

else if($post_login != $user['login'] || $post_pwd != $user['password'])
{
	$_SESSION['error'][] = 'Invalid password';
	
} else
{
	$_SESSION['user'] = $user['login'];
	
	if(isset($_POST['rememberme']) && $_POST['rememberme'] == 1)
	{
		$cookie_expire_in_days = 30;
		
		// don't prefix $_SERVER['SERVER_ADMIN'] with . => the cookie won't be installed in chrome and opera
		setcookie('user', $user['login'].'*'.$user['password'], time()+60*60*24*$cookie_expire_in_days, '/', $_SERVER['SERVER_NAME']);
	}
}

header('Location: ../../index.php');
exit;


?>