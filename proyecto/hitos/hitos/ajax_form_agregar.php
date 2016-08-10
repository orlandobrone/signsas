<? header('Content-type: text/html; charset=iso-8859-1');

session_start();	

	include "../../conexion.php";

?>

<!--Hoja de estilos del calendario -->

<link rel="stylesheet" type="text/css" media="all" href="../../calendario/calendar-blue.css" title="win2k-cold-1">



<!-- librería principal del calendario -->

<script type="text/javascript" src="../../calendario/calendar.js"></script>



<!-- librería para cargar el lenguaje deseado -->

<script type="text/javascript" src="../../calendario/calendar-es.js"></script>



<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código -->

<script type="text/javascript" src="../../calendario/calendar-setup.js"></script>

<h1>Agregando nuevo hito</h1>

<p>Por favor rellene el siguiente formulario</p>

<form action="javascript: fn_agregar();" method="post" id="frm_per">

    <table class="formulario">

        <tbody>

        

        	<tr>

                <td>Proyecto</td>

                <td>

                	<select name="proyec" ide="proyec" class="required">

                    	<option value=""></option>

						<?

                            $sql = "select * from proyectos order by id asc";

                            $pai = mysql_query($sql);

                            while($rs_pai = mysql_fetch_assoc($pai)){

                        ?>

                            <option value="<?=$rs_pai['id']?>"><?=$rs_pai['nombre']?></option>

                        <? } ?>

					</select>

                </td>

            </tr>

            <tr>

                <td>Nombre Hito</td>

                <td><input name="nombre" type="text" id="nombre" size="40" class="required" /></td>

            </tr>

            

            <tr>

            	  <td>Sitios:</td>

                  <td colspan="3">

                      <? $sqlPry = "SELECT * FROM sitios"; 

                      $qrPry = mysql_query($sqlPry);

                      ?>

                      <select name="sitios" id="sitios" class="chosen-select required">

                          <? while ($rsPry = mysql_fetch_array($qrPry)) { ?>

                          <option value="<?=$rsPry['id']?>"><?=$rsPry['direccion']?> - <?=$rsPry['nombre_rb']?> </option>

                          <? } ?>

                      </select>            

                  </td>            

            </tr>

            <tr>

                <td>Fecha de Inicio</td>

                <td><input name="fecini" type="text" id="fecini" size="40" class="required" readonly="readonly" />

                <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador" />

				<script type="text/javascript">

					Calendar.setup({

						inputField     :    "fecini",      // id del campo de texto

						ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto

						button         :    "lanzador"   // el id del botón que lanzará el calendario

					});

				</script></td>

            </tr>

            <tr>

                <td>Fecha de Finalizaci&oacute;n</td>

                <td><input name="fecfin" type="text" id="fecfin" size="40" class="required" readonly="readonly" />

                <img src="../../calendario/application.png" width="16" height="16" align="absmiddle" id="lanzador2" />

				<script type="text/javascript">

					Calendar.setup({

						inputField     :    "fecfin",      // id del campo de texto

						ifFormat       :    "%Y-%m-%d",       // formato de la fecha, cuando se escriba en el campo de texto

						button         :    "lanzador2"   // el id del botón que lanzará el calendario

					});

				</script></td>

            </tr>

            <tr>

                <td>Descripci&oacute;n</td>

                <td><input name="descri" type="text" id="descri" size="40" class="required" /></td>

            </tr>

            <tr>

                <td>OT Cliente</td>

                <td><input name="ot_cliente" type="text" id="ot_cliente" size="40" class="required" /></td>

            </tr>
            
            <tr>

                <td>Valor Cotizado Hito</td>

                <td><input name="valor_cotizado_hito" type="text" id="valor_cotizado_hito" size="40" class="required" alt="integer"/></td>

            </tr>

             <?php //FGR

				$sqlfgr = "select count(1) as cuenta from opciones_perfiles where id_perfil = ".$_SESSION['perfil']." and opcion = 25";

				$paifgr = mysql_query($sqlfgr);

				$conteofgr=mysql_fetch_assoc($paifgr);

				

				if($conteofgr['cuenta']): ?>

                    <tr>

                        <td>PO1</td>

                        <td><input name="po" type="text" id="po" size="40" /></td>

                        <td>PO2</td>

                        <td><input name="po2" type="text" id="po2" size="40" /></td>

                    </tr>

                    <tr>

                        <td>GR1</td>

                        <td><input name="gr" type="text" id="gr" size="40" /></td>

                        <td>GR2</td>

                        <td><input name="gr2" type="text" id="gr2" size="40" /></td>

                    </tr>

                    <tr>

                        <td>#Factura1</td>

                        <td><input name="factura" type="text" id="factura" size="40" /></td>

                        <td>#Factura2</td>

                        <td><input name="factura2" type="text" id="factura2" size="40" /></td>

                    </tr>

       		 <?php endif; ?>

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

<link rel="stylesheet" href="/js/chosen/chosen.css">

<script src="/js/chosen/chosen.jquery.js" type="text/javascript"></script> 

<script language="javascript" type="text/javascript">

	$(document).ready(function(){

		

		$("#frm_per select").chosen({width:"250px"});

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

				var respuesta = confirm('\xBFDesea realmente agregar este nuevo hito?')

				if (respuesta)

					form.submit();

			}

		});

		$( "#fecini" ).setMask('9999/99/99');

		$( "#fecfin" ).setMask('9999/99/99');
		
		//$("#valor_cotizado_hito").setMask();

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