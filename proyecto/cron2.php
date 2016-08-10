<?php
include "conexion.php";
require("phpMailer/class.phpmailer.php");

  $query="SELECT id, nombre,ot_cliente,fecha, id_proyecto
                          FROM hitos 
						 WHERE ot_cliente is NULL OR UPPER(ot_cliente) = 'PENDIENTE'
					  ORDER BY id DESC";
  
  $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
  
$i=0;
$cuerpo = '<p>Los siguientes hitos a&uacute;n no cuentan con OT Cliente:</p>
			<table border="1" width="438" align="center" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Fecha</th>
					<th>OT Proyecto</th>
				</tr>
			</thead>
			<tbody>';
$fechaactual = Date("Y-m-d");
  
while ($reg = mysql_fetch_array($result, MYSQL_ASSOC))
{
	if (diferenciaEntreFechas($fechaactual,$reg['fecha'],"DIAS",TRUE)>2) {
		
		$sql4 = "SELECT nombre FROM `proyectos` WHERE id = ".$reg['id_proyecto']; 

		if($pai4 = mysql_query($sql4)){
			$rs_pai4 = mysql_fetch_assoc($pai4);
			$otproyecto = $rs_pai4['nombre'];
		}
		else
			$otproyecto = '';
		$i++;
		$cuerpo .= "<tr>
						<td>".$reg['id']."</td>
						<td>".$reg['nombre']."</td>
						<td>".$reg['fecha']."</td>
						<td>".$otproyecto."</td>
					</tr>";
	} 
}
$cuerpo .= "</tbody>
			</table>";
$receptor = 'callcenter@signsas.com';
$copia = 'ivan.conrado@signsas.com';
if($i>0)
	enviar_mensaje('Hitos sin OT CLIENTE',$cuerpo,$receptor,$copia);

/*Otro Reporte*/
	$query="SELECT id, nombre, fecha_inicio_ejecucion, dias_hito
                          FROM hitos 
						 WHERE estado in ('PENDIENTE','EN EJECUCIÓN') AND fecha_inicio_ejecucion > '2014-06-01'
					  ORDER BY id DESC";
  
     $result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
  
$i=0;
$cuerpo = '<p>Los siguientes hitos se encuentran vencidos:</p>
			<table border="1" width="438" align="center" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Fecha Inicio Ejecuci&oacute;n</th>
					<th>Fecha Debi&oacute; Terminar</th>
					<th>D&iacute;as Vencido</th>
				</tr>
			</thead>
			<tbody>';
$fechaactual = Date("Y-m-d");
  
while ($reg = mysql_fetch_array($result, MYSQL_ASSOC))
{
	echo 'Entra';
	if($reg['id']=='7110'){
		echo '1. '+$reg['dias_hito'].'<br>2. '.$reg['fecha_inicio_ejecucion'];
	}
	if (((int)$reg['dias_hito']<=5&&diferenciaEntreFechas($fechaactual,$reg['fecha_inicio_ejecucion'],"DIAS",TRUE)>(2+(int)$reg['dias_hito'])) || ((int)$reg['dias_hito']>5&&diferenciaEntreFechas($fechaactual,$reg['fecha_inicio_ejecucion'],"DIAS",TRUE)>(5+(int)$reg['dias_hito']))) {
		$i++;
		$dias = (int)$reg['dias_hito']*86400;
		$debioterminar = date("Y-m-d",strtotime($reg['fecha_inicio_ejecucion'])+$dias);
		$cuerpo .= "<tr>
						<td>".$reg['id']."</td>
						<td>".$reg['nombre']."</td>
						<td>".$reg['fecha_inicio_ejecucion']."</td>
						<td>".$debioterminar."</td>
						<td>".diferenciaEntreFechas($fechaactual,$debioterminar,"DIAS",TRUE)."</td>
					</tr>";
	} 
}
$cuerpo .= "</tbody>
			</table>";
$receptor = 'viviana.castaneda@signsas.com';
if($i>0)
	enviar_mensaje('Hitos Vencidos',$cuerpo,$receptor,$copia);
  
function enviar_mensaje($asunto,$cuerpo,$receptor,$copia){
	
	$mail = new PHPMailer();
	$mail->Host = "localhost";
	$mail->From = 'noreply@signsas.com';
	$mail->FromName = 'Administrador Signsas';
	$mail->Subject = $asunto;
	$mail->AddAddress($receptor);
	$mail->addCC($copia);
	$mail->Body = $cuerpo;
	$mail->IsHTML(true);
	$mail->CharSet = 'ISO-8859-1';
	$mail->Send();
	
	echo 'Correo enviado';	


}

function diferenciaEntreFechas($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false){
   $f0 = strtotime($fecha_principal);
   $f1 = strtotime($fecha_secundaria);
   if ($f0 < $f1) { $tmp = $f1; $f1 = $f0; $f0 = $tmp; }
   $resultado = ($f0 - $f1);
   switch ($obtener) {
       default: break;
       case "MINUTOS"   :   $resultado = $resultado / 60;   break;
       case "HORAS"     :   $resultado = $resultado / 60 / 60;   break;
       case "DIAS"      :   $resultado = $resultado / 60 / 60 / 24;   break;
       case "SEMANAS"   :   $resultado = $resultado / 60 / 60 / 24 / 7;   break;
   }
   if($redondear) $resultado = round($resultado);
   return $resultado+1;
}
?> 