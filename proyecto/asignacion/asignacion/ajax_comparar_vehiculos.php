<?
	include "../../conexion.php";
	
	$sqlPry = "SELECT * FROM vehiculos"; 
	$qrPry = mysql_query($sqlPry);
	
	$optionT = '<option value="">Seleccione...</option>';
	
    while ($row = mysql_fetch_array($qrPry)):
						
		/*$sql = "	 SELECT COUNT(1) AS conteo FROM asignacion WHERE id_vehiculo = ".$row['id']." 
					 AND ((fecha_ini >= '".$_POST['fechaini']."' AND fecha_ini <= '".$_POST['fechaend']."') 
					 OR (fecha_fin >= '".$_POST['fechaini']."' AND fecha_fin <= '".$_POST['fechaend']."') 
					 OR (fecha_ini <= '".$_POST['fechaini']."' AND fecha_fin >= '".$_POST['fechaend']."'))"; 
		
		$result = mysql_query($sql);
		$rows = mysql_fetch_array($result);*/
								
		//if($rows['conteo'] != 1):									
   				$optionT .= '<option value="'.$row['id'].'">'.utf8_encode($row['placa']).'</option>';
       //endif;                      			
                                
     endwhile;
	 
	 echo $optionT;                   
	
	
?>