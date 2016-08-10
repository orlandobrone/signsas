<?php 
		include "../../conexion.php";
		include "../../ingreso_mercancia/extras/php/basico.php";
		
		/*verificamos si las variables se envian*/
		if(empty($_POST['mensaje'])){
			echo "Usted no a llenado todos los campos"; 
			exit;
		}
		session_start();
				
		$para = "andrea.rojas@singsas.com";
		// subject
		$titulo = 'Solicitud de Material';
		
		// message
		$mensaje = '
		<html>
		<head>
		  <title>Solicitud de Material</title>
		</head>
		<body>
		  <p>Nombre del Solicitante: '.$_SESSION['nombres'].'</p>
		  <p>Mensaje: '.$_POST['mensaje'].'</p>	
		  
		</body>
		</html>';
		
		// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$cabeceras .= 'Cc: fernanda.pino@singsas.com' . "\r\n";
		
		// Cabeceras adicionales
		$cabeceras .= 'To: <replay@sigasas.com>' . "\r\n";
		
		
		mail($para, $titulo, $mensaje, $cabeceras);

?>