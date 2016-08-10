<? header('Content-type: text/html; charset=iso-8859-1');

	include "../../conexion.php";

?>

<h1>Agregando nuevo Perfil</h1>

<p>Por favor rellene el siguiente formulario</p>

<form action="javascript: fn_agregar();" method="post" id="frm_per">

    <table class="formulario" style="width:100%">

        <tbody>

            <tr>

                <td>Nombre </td>

                <td><input name="nombre" type="text" id="nombre" size="40" class="required" /></td>

            </tr>

            <tr>

                <td>Descripci&oacute;n</td>

                <td><input name="descripcion" type="text" id="descripcion" size="40" class="required" /></td>

            </tr>

            <tr>

                <td align="left" valign="top">Opciones</td>

                <td>

                <table style="width:100%" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="1" />

                      Proyectos</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="2" /> 

                      Costos</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="3" /> 

                      Hitos</td>

                  </tr>

                  <tr>

                    

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="4" /> 

                      Tareas</td>

					<td><input name="opcion[]" type="checkbox" id="opcion[]" value="5" /> 

                      Ingresos</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="16" />

Salida de Mercancia</td>

                  </tr>

                  <tr>

                    

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="8" /> 

                      Inventario</td>

					 <td><input name="opcion[]" type="checkbox" id="opcion[]" value="6" /> 

                      Clientes</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="7" /> 

                      Proveedores</td>

                  </tr>

                  <tr>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="9" /> 

                      Ingreso de Mercancia

</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="10" /> 

                      Solicitud de Despacho</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="11" /> 

                      Cotizaciones</td>

                  </tr>

                  <tr>

                      <td><input name="opcion[]" type="checkbox" id="opcion[]" value="12" /> 

                      Usuarios</td>



                      <td><input name="opcion[]" type="checkbox" id="opcion[]" value="13" /> 

                      Perfiles</td>

                  </tr>

                  <tr>

                   

                     <td><input name="opcion[]" type="checkbox" id="opcion[]" value="14" /> 

                      Reportes</td>

                     <td><input name="opcion[]" type="checkbox" id="opcion[]" value="15" /> 

                      Comercial</td>

                     <td><input name="opcion[]" type="checkbox" id="opcion[]" value="17" /> 

                      Asignaci&oacute;n</td>

                  </tr>

                  <tr>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="18" /> 

                      Anticipos</td>

                    <td><input name="opcion[]" type="checkbox" id="opcion[]" value="19" /> 

                      Beneficiario</td>

					<td><input name="opcion[]" type="checkbox" id="opcion[]" value="20" /> 

                      Legalizaci&oacute;n

                    </td>

                  </tr>

                  <tr>

                      <td><input name="opcion[]" type="checkbox" id="opcion[]" value="23" /> 

                        P.O

                      </td>

                      <td><input name="opcion[]" type="checkbox" id="opcion[]" value="24" /> 

                        Ingresos

                     </td>

                     <td><input name="opcion[]" type="checkbox" id="opcion[]" value="25" /> 

                        Hitos->Editor PO GR

                     </td>
                     
                     

                  </tr>
                  
                  <tr>
                  	  <td><input name="opcion[]" type="checkbox" id="opcion[]" value="26" /> 

                        Financiero

                     </td>
                     <td><input name="opcion[]" type="checkbox" id="opcion[]" value="31" /> 

                        Facturas

                     </td>
                  </tr>
                  
                  <tr>
                  	<td><input name="opcion[]" type="checkbox" id="opcion[]" value="30"/> 

                         Asignaci&oacute;n->Asignaci&oacute;n

                    </td>
                	<td><input name="opcion[]" type="checkbox" id="opcion[]" value="28"/> 

                        Asignaci&oacute;n->Veh&iacute;culos

                     </td>
                  	<td><input name="opcion[]" type="checkbox" id="opcion[]" value="29"/> 

                         Asignaci&oacute;n->Funcionario/T&eacute;cnico

                     </td>
                  </tr>
                  
                    <tr>
                        <td>
    
                        <input name="opcion[]" type="checkbox" id="opcion[]" value="22"  /> 
    
                         Anticipo->Modificar 
    
                        </td>
                    
                        <td>
    
                        <input name="opcion[]" type="checkbox" id="opcion[]" value="32" /> 
    
                         Anticipo->Aprobar 
    
                        </td>                	
                  </tr>
                  


                  <?php $sqlReg = "SELECT * FROM regional ORDER BY id ASC"; 

                     $qrReg = mysql_query($sqlReg);

					 $fila = 0;

					 while ($rsReg = mysql_fetch_array($qrReg)) { 

					 	if($fila == 0){

                     		echo '<tr><td><input name="opcion[]" type="checkbox" id="opcion[]" value="10'.$rsReg['id'].'" />'.$rsReg['region'].'</td>';

							$fila++;

						}

						else {

							echo '<td><input name="opcion[]" type="checkbox" id="opcion[]" value="10'.$rsReg['id'].'" />'.$rsReg['region'].'</td></tr>';

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

                    <input name="agregar" type="submit" id="agregar" value="Agregar" />

                    <input name="cancelar" type="button" id="cancelar" value="Cancelar" onclick="fn_cerrar();" />

                </td>

            </tr>

        </tfoot>

    </table>

</form>

<script language="javascript" type="text/javascript">

	$(document).ready(function(){

		$("#frm_per").validate({

			rules:{

				usu_per:{

					required: true,

					remote: "ajax_verificar_usu_per.php"

				}

			},

			messages: {

				usu_per: "x"

			},

			onkeyup: false,

			submitHandler: function(form) {

				var respuesta = confirm('\xBFDesea realmente agregar a este nuevo perfil?')

				if (respuesta)

					form.submit();

			}

		});

		$('#telefo').setMask('(999) 999-9999');

		$('#celula').setMask('(999) 999-9999');

	});

	

	function fn_agregar(){

		var str = $("#frm_per").serialize();

		$.ajax({

			url: 'ajax_agregar.php',

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