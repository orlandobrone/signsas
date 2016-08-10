<?php 
require_once "conexion.php"; 
$usuario = mysql_escape_string(stripslashes(trim($_POST['usuario'])));
$password = mysql_escape_string(stripslashes(trim($_POST['password'])));

$qrLogin = mysql_query("SELECT * FROM usuario WHERE usuario = '$usuario' AND password = '$password'") or die(mysql_error());
if ($rowsLogin = mysql_fetch_array($qrLogin)) {
	session_start();
	
	$_SESSION['id'] = $rowsLogin['id'];
	$_SESSION['nombres'] = $rowsLogin['nombres'];
	$_SESSION['perfil'] = $rowsLogin['codigo_perfil'];
	
	$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); 
	
	header("location:panel.php");
}else{
	header("location:index.php?err=1");
}
?>