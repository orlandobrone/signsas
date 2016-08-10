<?php

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Disposition: attachment;filename=Despacho_export_".date('d-m-Y').".xls");
	header("Content-Transfer-Encoding: binary ");
	

	include "../../conexion.php";
	include "../extras/php/basico.php";


	$query = "SELECT *
			  FROM solicitud_despacho			
			  WHERE estado != 'draft' ORDER BY id DESC";

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

?>

	<table rules="all" border="1">

    	<tr bgcolor="#CCCCCC">
        	<td align="center"><strong>ID</strong></td>
            <td align="center"><strong>Nombre Responsable</strong></td>
            <td align="center"><strong>Descripci&oacute;n</strong></td> 
            <td align="center"><strong>Direcci&oacute;n Entrega</strong></td>
			<td align="center"><strong>Nombre Recibe</strong></td>          
            <td align="center"><strong>PBX/Celular</strong></td>
            <td align="center"><strong>Fecha Solicitud</strong></td>
            <td align="center"><strong>Fecha Entrega</strong></td>
            <td align="center"><strong>Fecha Registro</strong></td>
            
            <td align="center"><strong>C&oacute;digo</strong></td>
            <td align="center"><strong>Material</strong></td>
            <td align="center"><strong>Cantidad</strong></td>
            <td align="center"><strong>Costo</strong></td>
            <td align="center"><strong>Observaci&oacute;n</strong></td>
            <td align="center"><strong>Estado</strong></td>
            <td align="center"><strong>Existencia</strong></td>
            <td align="center"><strong>Cant. Comprada</strong></td>
            <td align="center"><strong>Costo Unidad</strong></td> 
            <td align="center"><strong>IVA</strong></td> 
            <td align="center"><strong>Orden Compra</strong></td> 
            <td align="center"><strong>Cant. Entregada</strong></td>
             
        </tr>

<?php	
    $letters = array('-');
	$fruit   = array('/');	

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)):

		$sqlPry = "SELECT * FROM materiales WHERE id_despacho = ".$row['id'];
		$qrPry = mysql_query($sqlPry);
		
		while($rsPry = mysql_fetch_array($qrPry)):
		
			$sql2 = "SELECT nombre_material, cantidad, codigo FROM inventario WHERE id = ".$rsPry['id_material'];
			$pai2 = mysql_query($sql2); 
			$rs_pai2 = mysql_fetch_assoc($pai2);
			
			$sql3 = "SELECT * FROM TEMP_MERCANCIAS WHERE id_item = ".$rsPry['id'];
			$pai3 = mysql_query($sql3); 
			$rs_pai3 = mysql_fetch_assoc($pai3);
	
	
			switch($rsPry['aprobado']):
					case '':
					case 0:
					case 3:
						$aprobar = "No Aprobado";						
					break;
					case 1:
						$aprobar = "Aprobado";						
					break;				
			endswitch;
		
?>
            <tr>
                    <td bgcolor="#CCCCCC"><?=$row['id']?></td>
                    <td><?=$row['nombre_responsable']?></td>
                    <td><?=$row['descripcion']?></td> 
                    <td><?=$row['direccion_entrega']?></td>
                    <td><?=$row['nombre_recibe']?></td>
                    <td><?=$row['telefono']?>/<?=$row['celular']?></td>
                   	<td><?=$row['fecha_solicitud']?></td>
                    <td><?=$row['fecha_entrega']?></td>
                    <td><?=$row['fecha']?></td>
            
                    <td><?=$rs_pai2['codigo']?></td>
                    <td><?=$rs_pai2['nombre_material']?></td>
                    <td><?=$rsPry['cantidad']?></td>
                    <td><?=$rsPry['costo']?></td>                    
                    <td><?=$rsPry['observacion']?></td>
                    <td><?=$aprobar?></td>
                    
                    <td><?=(int)$rs_pai2['cantidad']?></td>
                    <td><?=$rs_pai3['cantidadc']?></td>
                    <td><?=$rs_pai3['costo2']?></td>
                    <td><?=$rs_pai3['iva2']?></td>
                    <td><?=$rs_pai3['orden_compra2']?></td>
                    <td><?=$rs_pai3['cantidade']?></td>                  
             </tr>
<?		
		endwhile;
	endwhile;
?>
	</table>

    
