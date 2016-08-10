<?

	include "../../conexion.php";

	include "../extras/php/basico.php";
	
	function calcular_horas($hora1,$hora2){ 
	
		$separar[1]=explode(':',$hora1); 
		$separar[2]=explode(':',$hora2); 
	
		$total_minutos[1] = ($separar[1][0]*60)+$separar[1][1]; 
		$total_minutos[2] = ($separar[2][0]*60)+$separar[2][1]; 
		$total_minutos = $total_minutos[1]-$total_minutos[2]; 
		$total_horas = $total_minutos/60;
		return $total_horas;
	
   } 

	/*verificamos si las variables se envian*/

	//if(empty($_POST['fecini']) || empty($_POST['fecfin'])){
	if(empty($_POST['fecini'])){

		echo "Usted no a llenado todos los campos";

		exit;

	}
	
	$horastrab = calcular_horas($_POST['hora_final'],$_POST['hora_inicio']);
	
	if($_POST['almuerzo'])
		$horastrab-=1;
	

	if($_POST['disponible']){ $libre = 'si'; }else{ $libre = 'no';} 

	

	if($_POST['vehiculos'] != ''):

		

		$sql = sprintf("INSERT INTO `asignacion` VALUES ('', '%s', '%s', '%s', '%s', '%s', '%s', '%s' , '%s', '%s' , '%s', %s);",

			fn_filtro($_POST['hitos']),

			fn_filtro($_POST['tecnicos']),

			fn_filtro($_POST['vehiculos']),

			fn_filtro($_POST['id_ordonetrabajo']),

			fn_filtro($libre),

			fn_filtro($_POST['observacion']),

			fn_filtro($_POST['fecini']),

			fn_filtro($_POST['fecfin']),

			fn_filtro($_POST['hora_inicio']),

			fn_filtro($_POST['hora_final']),
			
			fn_filtro($horastrab)

		);

	

	else:

		

		$sql = sprintf("INSERT INTO `asignacion` VALUES ('', '%s', '%s', '0', '%s', '%s', '%s', '%s' , '%s','%s','%s',%s);",

			fn_filtro($_POST['hitos']),

			fn_filtro($_POST['tecnicos']),

			fn_filtro($_POST['id_ordonetrabajo']),

			fn_filtro($libre),

			fn_filtro($_POST['observacion']),

			fn_filtro($_POST['fecini']),

			fn_filtro($_POST['fecfin']),

			fn_filtro($_POST['hora_inicio']),

			fn_filtro($_POST['hora_final']),
			
			fn_filtro($horastrab)

		);

	

	

	endif;

	

	if(!mysql_query($sql))

		echo "Error al insertar la nueva asosaci&oacute;n:\n$sql"; 
		
	$sqlPry = "SELECT fecha_inicio_ejecucion AS fecha FROM hitos WHERE id = ".$_POST['hitos']; 
	$qrPry = mysql_query($sqlPry);
	$rsPry = mysql_fetch_assoc($qrPry);
	
	if($_POST['fecini']<$rsPry['fecha'] || empty($rsPry['fecha'])){
		$sql = "UPDATE hitos SET fecha_inicio_ejecucion = '".$_POST['fecini']."' WHERE id = ".$_POST['hitos'];
		
		if(!mysql_query($sql))
			echo "Ocurrio un error\n$sql";
	}

	exit;

?>