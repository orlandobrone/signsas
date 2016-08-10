<?php

	header("Pragma: public");

	header("Expires: 0");

	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

	header("Content-Type: application/force-download");

	header("Content-Type: application/octet-stream");

	header("Content-Type: application/download");

	header("Content-Disposition: attachment;filename=Tecnicos_export_".date('d-m-Y').".xls");

	header("Content-Transfer-Encoding: binary ");

	

	include "../../conexion.php";

	include "../extras/php/basico.php";

	

	$query = "SELECT * FROM tecnico WHERE 1 ORDER BY id DESC";

			  

	$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());

	

?>

	<table rules="all" border="1">

    	<tr bgcolor="#CCCCCC">

        	<td align="center"><strong>ID</strong></td>

            <td align="center"><strong>Nombre</strong></td>

            <td align="center"><strong>Cedula</strong></td>

            <td align="center"><strong>ARP</strong></td>

            <td align="center"><strong>EPS</strong></td>

            <td align="center"><strong>Celular</strong></td>

            <td align="center"><strong>Regi&oacute;n</strong></td>
            
            <td align="center"><strong>Cargo</strong></td>
            
            <td align="center"><strong>Estado</strong></td>
            
            <td align="center"><strong>Sueldo</strong></td>
            
            <td align="center"><strong>Valor Plan</strong></td>
            
            <td align="center"><strong>Valor Hora</strong></td>

        </tr>

	

<?php	

	

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)):

				if($row['estado'])
					$activo = 'Activo';
				else
					$activo = 'Inactivo';
					
				$valor_hora = str_replace('.',',',$row['valor_hora']);

?>

                <tr>

                    <td bgcolor="#CCCCCC"><?=$row['id']?></td>

                    <td><?=utf8_decode($row['nombre'])?></td>

                    <td><?=$row['cedula']?></td>

                    <td><?=$row['ARP']?></td>

                    <td><?=$row['EPS']?></td>

                    <td><?=$row['celular']?></td>

                    <td><?=$row['region']?></td>
                    
                    <td><?=$row['cargo']?></td>
                    
                    <td><?=$activo?></td>
                    
                    <td><?=$row['sueldo']?></td>
                    
                    <td><?=$row['valor_plan']?></td>
                    
                    <td>$<?=$valor_hora?></td>

                </tr>

<?		

		  	

	endwhile;

?>

	</table>

    

