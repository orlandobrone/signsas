<? header('Content-type: text/html; charset=iso-8859-1');
	if(empty($_POST['ide_per'])){
		echo "Por favor no altere el fuente";
		exit;
	}

	include "../extras/php/basico.php";
	include "../../conexion.php";

	$sql = sprintf("select * from usuario where id=%d",
		(int)$_POST['ide_per']
	);
	$per = mysql_query($sql);
	$num_rs_per = mysql_num_rows($per);
	if ($num_rs_per==0){
		echo "No existen usuarios con ese ID";
		exit;
	}
	
	$rs_per = mysql_fetch_assoc($per);
	
?>
<h1>Modificando usuario</h1>
<p>Por favor rellene el siguiente formulario</p>
<form action="javascript: fn_modificar();" method="post" id="frm_per">
	<input type="hidden" id="id" name="id" value="<?=$rs_per['id']?>" />
    <table class="formulario">
        <tbody>
            <tr>
              <td>Nombres</td>
              <td><input name="nombres" type="text" id="nombres" size="40" class="required" value="<?=$rs_per['nombres']?>" /></td>
            </tr>
            <tr>
                <td>Usuario</td>
                <td><input name="usuario" type="text" id="usuario" size="40" class="required" value="<?=$rs_per['usuario']?>" /></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input name="email" type="text" id="email" size="40" class="required" value="<?=$rs_per['email']?>" /></td>
            </tr>
            <tr> 
                <td>Contrase&ntilde;a</td>
                <td><input name="password" type="password" id="password" size="40" value="" /></td>
            </tr>
            <tr>
                <td>Confirmar contrase&ntilde;a</td>
                <td><input name="confirmar" type="password" id="confirmar" size="40" value="" /></td>
            </tr>
            <tr>
                <td>Codigo de perfil</td>
                <td>
                <? $qrPerfil = mysql_query("SELECT * FROM perfiles") or die(mysql_error()); ?>
                <select name="codigo_perfil" id="codigo_perfil">
                  <? while ($rowsPerfil = mysql_fetch_array($qrPerfil)) { ?>
                  <option value="<?=$rowsPerfil['id']?>" <? if ($rs_per['codigo_perfil'] == $rowsPerfil['id']) echo 'selected="selected"'; ?>><?=$rowsPerfil['nombre']?></option>
                  <? } ?>
                </select></td>
            </tr>
            <tr>
                <td>Regional</td>
                <? $qrRegional = mysql_query("SELECT * FROM regional") or die(mysql_error()); ?>
                <td><select name="id_regional" id="id_regional">
                <? while ($rowsRegional = mysql_fetch_array($qrRegional)) { ?>
                  <option value="<?=$rowsRegional['id']?>" <? if ($rs_per['id_regional'] == $rowsRegional['id']) echo 'selected="selected"'; ?>><?=$rowsRegional['region']?></option>
                <? } ?>
                </select></td>
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
<link rel="stylesheet" href="/js/chosen/chosen.css">
<script src="/js/chosen/chosen.jquery.js" type="text/javascript"></script> 
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		
		$("#frm_per select").chosen({width:"250px"});
		$("#frm_per").validate({
			submitHandler: function(form) {
						var respuesta = confirm('\xBFDesea realmente modificar a este usuario?')
						if (respuesta)
							form.submit();
			}
		});
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
			},
			error: function(err) {
				alert(err);
			}
		});
	};
</script>