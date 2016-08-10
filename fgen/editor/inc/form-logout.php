<?php
session_start();


if(isset($_SESSION['user']))
{
	unset($_SESSION['user']);
}


if(isset($_COOKIE['user']))
{
	setcookie('user', '', time() - 3600, '/', $_SERVER['SERVER_NAME']);
}


header('Location: ../../index.php');
exit;

?>