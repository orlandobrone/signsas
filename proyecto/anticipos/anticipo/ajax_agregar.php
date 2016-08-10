<?

	session_start();

	

	include "../../conexion.php";

	include "../extras/php/basico.php";

	

	/*verificamos si las variables se envian*/

	if(empty($_POST['fecha']) || empty($_POST['prioridad']) 

	|| empty($_POST['nombre_responsable']) 

	|| empty($_POST['cedula_responsable']) 

	|| empty($_POST['centros_costos'])

	|| empty($_POST['v_cotizado'])

	|| empty($_POST['banco'])

	|| empty($_POST['tipo_cuenta'])

	|| empty($_POST['num_cuenta'])

	|| empty($_POST['cedula_consignar'])

	|| empty($_POST['beneficiario'])

	){

		echo "Usted no a llenado todos los campos";

		exit;

	}

	

	

	$sql = sprintf("INSERT INTO `anticipo` VALUES ('', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 0, '', '%s');",

		fn_filtro($_POST['fecha']),

		fn_filtro($_POST['prioridad']),

		fn_filtro($_POST['nombre_responsable']),

		fn_filtro($_POST['cedula_responsable']),

		fn_filtro($_POST['regional']),

		fn_filtro($_POST['centros_costos']),

		fn_filtro($_POST['giro']),

		fn_filtro($_POST['v_cotizado']),

		fn_filtro(0),

		fn_filtro($_POST['banco']),

		fn_filtro($_POST['tipo_cuenta']),

		fn_filtro($_POST['num_cuenta']),

		fn_filtro($_POST['cedula_consignar']),

		fn_filtro($_POST['beneficiario']),

		fn_filtro($_POST['observaciones']),

		fn_filtro($_POST['orden_trabajo']),
		
		fn_filtro($_POST['opcionbanco']),

		fn_filtro($_SESSION['id'])

	);



	if(!mysql_query($sql)){

		echo "Error al insertar la nueva asosaci&oacute;n:\n$sql"; 

		exit;

	}

		

	

	$sql2 = sprintf("INSERT INTO `legalizacion` (`id`,`responsable`,`fecha`,`id_anticipo`, `valor_fa`, `estado`) VALUES ('', '%s', '%s', '%s', '%s', 'NO REVISADO');",

		fn_filtro($_POST['nombre_responsable']),

		fn_filtro($_POST['fecha']),	

		fn_filtro(mysql_insert_id()),

		fn_filtro($_POST['total_anticipo'])	

	);

    

	if(!mysql_query($sql2)){

		echo "Error al insertar la nueva legalizacion:\n$sql2"; 

		exit;

	}

		

	

	/*$sqlMat = sprintf("SELECT nombre FROM proyectos WHERE id = ".$_POST['proyecto']);

	$perMat = mysql_query($sqlMat);

	$rs_per_mat = mysql_fetch_assoc($perMat);*/

		 

	

	$para = "oscar.galindo@signsas.com";

	// subject

	$titulo = 'Nuevo Anticipo';

	

	// message

	$mensaje = '

	<html>

	<head>

	  <title>Se ingreso nuevo Anticipo para revisi&oacute;n</title>

	</head>

	<body>

	  <p>No. Anticipo: '.mysql_insert_id().'</p>

	  <p>Fecha: '.$_POST['fecha'].'</p>	

	  <p>Prioridad: '.$_POST['prioridad'].'</p>	

	  <p>Nombre Responsable: '.$_POST['nombre_responsable'].'</p>	  

	  <p>Cedula Responsable: '.$_POST['cedula_responsable'].'</p>

	  <p>Total Anticipo: '.$_POST['total_anticipo'].'</p>	

	  <p>Beneficiario: '.$_POST['beneficiario'].'</p>	

	</body>

	</html>';

	

	// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse

	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";

	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$cabeceras .= 'Cc: rafael.cadena@signsas.com,ivan.conrado@signsas.com' . "\r\n";

	

	// Cabeceras adicionales

	$cabeceras .= 'To: <replay@signsas.com>' . "\r\n";

	

	

	mail($para, $titulo, $mensaje, $cabeceras);

	 



	exit;

?>