<? header('Content-type: text/html; charset=iso-8859-1');

	if(empty($_POST['ide_per'])){

		echo "Por favor no altere el fuente";

		exit;

	}
 


	include "../extras/php/basico.php";

	include "../../conexion.php";



	$sql = sprintf("select * from perfiles where id=%d",

		(int)$_POST['ide_per']

	);

	$per = mysql_query($sql);

	$num_rs_per = mysql_num_rows($per);

	if ($num_rs_per==0){

		echo "No existen perfiles con ese ID";

		exit;

	}

	

	$rs_per = mysql_fetch_assoc($per); 

	

?>

<h1>Modificando Perfil</h1>

<p>Por favor rellene el siguiente formulario</p>

<form action="javascript: fn_modificar();" method="post" id="frm_per">

	<input type="hidden" id="id" name="id" value="<?=$rs_per['id']?>" />

    <table class="formulario" style="width:100%">

        <tbody>

            <tr>

                <td>Nombre</td>

                <td><input name="nombre" type="text" id="nombre" size="40" class="requisssred" value="<?=$rs_per['nombre']?>" /></td>

            </tr>

            <tr>

                <td>Descripci&oacute;n</td>

                <td><input name="descripcion" type="text" id="descripcion" size="40" class="required" value="<?=$rs_per['descripcion']?>" /></td>

            </tr>

            <tr>

                <td align="left" valign="top">Opciones</td>

                <td>

                <? $qrPerfil = mysql_query("SELECT * FROM opciones_perfiles WHERE id_perfil = '" . $rs_per['id'] . "'") or die(mysql_error()); 

				$idOpciones = array();

				while ($rowsPerfil = mysql_fetch_array($qrPerfil)) $idOpciones[] = $rowsPerfil['opcion'];

				?>

                

                <table style="width:100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="1" <? if (in_array('1', $idOpciones)) echo 'checked="checked"'; ?> />

                      Proyectos</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="2" <? if (in_array('2', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Costos</td>

                      <td><input name="opcion[]" type="checkbox" id="opcion[]" value="3" <? if (in_array('3', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Hitos</td>

                  </tr>

                  <tr>

                    

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="4" <? if (in_array('4', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Tareas</td>

                      <td><input name="opcion[]" type="checkbox" id="opcion[]" value="5" <? if (in_array('5', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Ingresos

</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="16" <? if (in_array('16', $idOpciones)) echo 'checked="checked"'; ?> />

Salida de Mercancia </td>

                  </tr>

                 

                  <tr>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="6" <? if (in_array('6', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Clientes

</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="7" <? if (in_array('7', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Proveedores

</td>

					<td><input name="opcion[]" type="checkbox" id="opcion[]" value="8" <? if (in_array('8', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Inventarios

</td>

                  </tr>

                  <tr>

                    

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="9" <? if (in_array('9', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Ingreso de Mercancia

</td>

					<td><input name="opcion[]" type="checkbox" id="opcion[]" value="10" <? if (in_array('10', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Solicitud de Despacho</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="11" <? if (in_array('11', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Cotizaciones

</td>

                  </tr>

                  

                  <tr>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="12" <? if (in_array('12', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Usuarios

</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="13" <? if (in_array('13', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Perfiles

</td>

					<td><input name="opcion[]" type="checkbox" id="opcion[]" value="14" <? if (in_array('14', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Reportes

</td>

                  </tr>

                  <tr>

                    

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="15" <? if (in_array('15', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Comercial

</td>

					 <td><input name="opcion[]" type="checkbox" id="opcion[]" value="17" <? if (in_array('17', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Asignaci&oacute;n

</td>

					<td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="18" <? if (in_array('18', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Anticipos

                	</td>

                  </tr>              

                 

                

                 <tr>

                   <td>

                   	<input name="opcion[]" type="checkbox" id="opcion[]" value="19" <? if (in_array('19', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Beneficiario

				    </td>



					<td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="20" <? if (in_array('20', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Legalizaci&oacute;n

                	</td>

                     <td>

                   	<input name="opcion[]" type="checkbox" id="opcion[]" value="23" <? if (in_array('23', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      P.O

				    </td>



                </tr>

                

                <tr>

					<td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="24" <? if (in_array('24', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Ingresos

                	</td>
                    
                    <td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="31" <? if (in_array('31', $idOpciones)) echo 'checked="checked"'; ?> /> 

                      Facturas

                	</td>

                </tr>

                <tr> 
                	<td>Acciones de Interfaces</td> 
                </tr>

                <tr>
                	<td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="27" <? if (in_array('27', $idOpciones)) echo 'checked="checked"'; ?> /> 

                     Hitos->Editor Principal 

                	</td>

                    <td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="21" <? if (in_array('21', $idOpciones)) echo 'checked="checked"'; ?> /> 

                     Hitos->Editor de Estado 

                	</td>

                     <td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="25" <? if (in_array('25', $idOpciones)) echo 'checked="checked"'; ?> /> 

                     Hitos->Editor PO GR

                	</td>

                </tr>
                
                <tr>
                	<td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="22" <? if (in_array('22', $idOpciones)) echo 'checked="checked"'; ?> /> 

                     Anticipo->Modificar 

                	</td>
                    
                    <td>

                	<input name="opcion[]" type="checkbox" id="opcion[]" value="32" <? if (in_array('32', $idOpciones)) echo 'checked="checked"'; ?> /> 

                     Anticipo->Aprobar 

                	</td>
                  	<td><input name="opcion[]" type="checkbox" id="opcion[]" value="26" <? if (in_array('26', $idOpciones)) echo 'checked="checked"'; ?>/> 

                        Financiero

                     </td>
                     
                     
                  </tr>
                  
                  
                  <tr>
                  	<td><input name="opcion[]" type="checkbox" id="opcion[]" value="30" <? if (in_array('30', $idOpciones)) echo 'checked="checked"'; ?>/> 

                         Asignaci&oacute;n->Asignaci&oacute;n

                    </td>
                	<td><input name="opcion[]" type="checkbox" id="opcion[]" value="28" <? if (in_array('28', $idOpciones)) echo 'checked="checked"'; ?>/> 

                        Asignaci&oacute;n->Veh&iacute;culos

                     </td>
                  	<td><input name="opcion[]" type="checkbox" id="opcion[]" value="29" <? if (in_array('29', $idOpciones)) echo 'checked="checked"'; ?>/> 

                         Asignaci&oacute;n->Funcionario/T&eacute;cnico

                     </td>
                  </tr>
                  
                  

                <?php $sqlReg = "SELECT * FROM regional ORDER BY id ASC"; 

                     $qrReg = mysql_query($sqlReg);

					 $fila = 0;

					 while ($rsReg = mysql_fetch_array($qrReg)) { 

					    $checkeado = '';

						$values='10'.$rsReg['id'];

						if(in_array($values, $idOpciones))

							$checkeado = 'checked="checked"';

					 	if($fila == 0){

                     		echo '<tr><td><input name="opcion[]" type="checkbox" id="opcion[]" value="10'.$rsReg['id'].'" '.$checkeado.' />'.$rsReg['region'].'</td>';

							$fila++;

						}

						else {

							echo '<td><input name="opcion[]" type="checkbox" id="opcion[]" value="10'.$rsReg['id'].'" '.$checkeado.' />'.$rsReg['region'].'</td></tr>';

							$fila=0;

						}

					                       

					 ?>

                <? } ?>

                  

              </table></td>

            </tr>

            

            

            

        </tbody>

        <tfoot>

            <tr>

                <td colspan="2">

                    <input name="modificar" type="submit" id="modificar" value="Modificar" />

                    <input name="cancelar" type="button" id="cancelar" value="Cancelar" onclick="fn_cerrar();" />

                </td>

            </tr>

        </tfoot>

    </table>

</form>

<script language="javascript" type="text/javascript">

	$(document).ready(function(){

		$("#frm_per").validate({

			submitHandler: function(form) {

				var respuesta = confirm('\xBFDesea realmente modificar a este cliente?')

				if (respuesta)

					form.submit();

			}

		}); 

		$('#telefo').setMask('(999) 999-9999');

		$('#celula').setMask('(999) 999-9999');

	});

	

	function fn_modificar(){

		var str = $("#frm_per").serialize();

		$.ajax({

			url: 'ajax_modificar.php',

			data: str,

			type: 'post',

			success: function(data){

				if(data != "") {

					alert(data);

				}else{

					fn_cerrar();	

					fn_buscar();

				}

			}

		});

	};

</script>