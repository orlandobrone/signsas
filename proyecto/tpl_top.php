<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>.: ADMINISTRADOR :.</title>

<link href="<?php echo CSS; ?>css.css" rel="stylesheet" type="text/css" />



<link rel="shortcut icon" href="/images/proyecto.ico">



<script src="<?php echo JSMENU; ?>SpryAccordion.js" type="text/javascript"></script>

<link href="<?php echo JSMENU; ?>SpryAccordion.css" rel="stylesheet" type="text/css" />



<?php if (defined('URL_SECCION')) { ?>

<script language="javascript" type="text/javascript" src="/js/jquery-1.6.4.min.js"></script>

<script language="javascript" type="text/javascript" src="<?=URL_SECCION;?>extras/js/jquery.blockUI.js"></script>

<script language="javascript" type="text/javascript" src="<?=URL_SECCION;?>extras/js/jquery.validate.1.5.2.js"></script>

<script language="javascript" type="text/javascript" src="<?=URL_SECCION;?>extras/js/mask.js"></script>

<link href="<?=URL_SECCION;?>extras/css/estilo.css" rel="stylesheet" type="text/css" />

<link href="<?=URL_SECCION;?>extras/php/PHPPaging.lib.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="<? echo URL_SECCION . SECCION;?>index.js"></script>

 

<link rel="stylesheet" href="/js/jqxgrid/jqwidgets/styles/jqx.base.css" type="text/css" />

<link rel="stylesheet" href="/js/jqxgrid/jqwidgets/styles/jqx.bootstrap.css" type="text/css" />

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxcore.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxdata.js"></script> 

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxbuttons.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxscrollbar.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxlistbox.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxdropdownlist.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxmenu.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.filter.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.sort.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.selection.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxpanel.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxcalendar.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxdatetimeinput.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxcheckbox.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.pager.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/globalization/globalize.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.columnsresize.js"></script> 

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxtooltip.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxdata.export.js"></script> 

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.export.js"></script> 

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxgrid.edit.js"></script> 

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxlistbox.js"></script>

<script type="text/javascript" src="/js/jqxgrid/jqwidgets/jqxnumberinput.js"></script>





<script language="javascript" type="text/javascript">

var theme = 'bootstrap';

$(document).ready(function(){

	$(".btn_table").jqxButton({ theme: theme });

});

</script>



<?php } ?>





</head>



<body>

<div id="main">

	<div id="frame_border">

    	<div id="frame_border2">

        	<!--div id="box_logo"></div-->

            <div id="container">

            	<?php 

				//echo $_SESSION['id'];		

				if (isset($_SESSION['id']) && !empty($_SESSION['id'])) { ?>

                <?

				$qrValidar = mysql_query("SELECT * FROM opciones_perfiles WHERE id_perfil = '" . $_SESSION['perfil'] . "'"); 

				$arrOpciones = array();

				while ($rowsValidar = mysql_fetch_array($qrValidar)) $arrOpciones[] = $rowsValidar['opcion'];

				$tab = 0;
				
				$_SESSION['aprobar_anticipo'] = false;

				if (in_array('21', $arrOpciones)) { 

					$_SESSION['editor_estado_hito'] = true;
					$_SESSION['modificar_anticipo'] = true;		

				}
				
				if(in_array('32', $arrOpciones)){				
					$_SESSION['aprobar_anticipo'] = true;
				}

			
				

				?>

            	<div id="menu" style="min-height: 605px;" <?=$_SESSION['aprobar_anticipo'];?>>

               	  <div id="Accordion1" class="Accordion" tabindex="0">

                  

                    <? if (in_array('1', $arrOpciones) || in_array('2', $arrOpciones) || in_array('3', $arrOpciones) || in_array('4', $arrOpciones) || in_array('5', $arrOpciones)) { ?>

               	    <div class="AccordionPanel">

                	    <div class="AccordionPanelTab">

                        <img src="<?=IMAGES;?>icon_proyectos.png" width="33" height="31" align="absmiddle" style="margin-right:7px" />PROYECTOS</div>

                	    <div class="AccordionPanelContent">

                	      <ul>

                          <? if (in_array('1', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>proyectos/proyectos/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Proyectos</a></li>

                          <? } ?>

                          <? if (in_array('2', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>costos/costos/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Costo</a></li>

                          <? } ?>    

                          <? if (in_array('3', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>hitos/hitos/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Hito</a></li>

                          <? } ?>  

                          <? //if (in_array('4', $arrOpciones)) { ?>

<!--                              <li><a href="<?=URL_APP;?>tareas/tareas/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Tarea</a></li>

-->                          <? //} ?>  

                          <? if (in_array('5', $arrOpciones)) { ?>

                              <li style="display:none;"><a href="<?=URL_APP;?>proyecto_ingresos/proyecto_ingresos/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Ingresos</a></li>

                          <? } ?>  

                          

                          <? if (in_array('1', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>proyectos/sitios/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Sitios</a></li>

                          <? } ?> 

                          <? if (in_array('23', $arrOpciones)) { ?>

                          	  <li><a href="<?=URL_APP;?>proyectos/po/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />P.O</a></li>

					      <? } ?> 

						  <? if (in_array('24', $arrOpciones)) { ?>  

                              <li><a href="<?=URL_APP;?>proyectos/ingresos/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Ingresos</a></li>

						  <? } ?> 

                          </ul>

                        </div>

              	    </div>

                    <? $tab++;} ?>

                    <? if (in_array('6', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab" onclick="location.href='<?=URL_APP;?>cliente/cliente/index.php';"><img src="<?=IMAGES;?>clientes.png" width="35" height="32" align="absmiddle" style="margin-right:5px" />CLIENTES</div>

                        <!--div class="AccordionPanelContent">Contenido 2</div-->

                      </div>

                    <? $tab++;} ?>

                    <? if (in_array('7', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab" onclick="location.href='<?=URL_APP;?>proveedor/proveedor/index.php';"><img src="<?=IMAGES;?>proveedores.png" align="absmiddle" style="margin-right:5px" />PROVEEDORES</div>

                        <!--div class="AccordionPanelContent">Contenido 2</div-->

                      </div>

                    <? $tab++;} ?>

                    <? if (in_array('8', $arrOpciones) || in_array('9', $arrOpciones) || in_array('10', $arrOpciones) || in_array('16', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab">

                        <img src="<?=IMAGES;?>inventario.png" align="absmiddle" style="margin-right:5px" />INVENTARIO

                        </div>

                        <div class="AccordionPanelContent">

                          <ul>

                          <? if (in_array('8', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>inventario/inventario/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Inventario</a></li>

                          <? } ?>

                          <? if (in_array('9', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>ingreso_mercancia/ingreso_mercancia/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Ingreso de mercanc&iacute;a</a></li>

                          <? } ?>

                          <? if (in_array('10', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>solicitud_despacho/solicitud_despacho/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Solicitud de Material</a></li>

                          <? } ?>

                          <? if (in_array('16', $arrOpciones)) { ?>

                          <li><a href="<?=URL_APP;?>salida_mercancia/salida_mercancia/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Salida mercancia</a></li>

                          <? } ?>
                          
                          <? if (in_array('31', $arrOpciones)) { ?>

                          <li><a href="<?=URL_APP;?>facturas/facturas/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Facturas</a></li>

                          <? } ?>

                          </ul>

                        </div>

                      </div>

                      <? $tab++;} ?>

                      <? if (in_array('11', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <!--<div class="AccordionPanelTab" onclick="location.href='<?=URL_APP;?>cotizacion/cotizacion/index.php';"><img src="<?=IMAGES;?>icon_cotizaciones.png" width="35" height="32" align="absmiddle" style="margin-right:5px" />COTIZACIONES</div>-->
                        <div class="AccordionPanelTab">

                        <img src="<?=IMAGES;?>icon_cotizaciones.png" align="absmiddle" style="margin-right:5px" />COTIZACIONES

                        </div>

                        <div class="AccordionPanelContent">

                          <ul>

                          <li><a href="<?=URL_APP;?>cotizacion/cotizacion/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Cotización Proyecto</a></li>
                          
                         <!-- <li><a href="<?=URL_APP;?>cotizacion/apu/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />APU</a></li>
                          
                          <li><a href="<?=URL_APP;?>cotizacion/cotizacion_hito/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Cotización Hito</a></li>-->
                          
                          </ul>          
                        </div>

                      </div>

                      <? $tab++;} ?>

                      <? if (in_array('12', $arrOpciones) || in_array('13', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab"><img src="<?=IMAGES;?>icon_usuarios.png" width="31" height="31" align="absmiddle" style="margin-right:10px" />SEGURIDAD</div>

                        <div class="AccordionPanelContent">

                        	<ul>

                            <? if (in_array('12', $arrOpciones)) { ?>

                            	<li><a href="<?=URL_APP;?>usuarios/usuarios/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Usuarios</a></li>

                            <? } ?>

                            <? if (in_array('13', $arrOpciones)) { ?>

                                <li><a href="<?=URL_APP;?>perfiles/perfiles/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Perfiles</a></li>

                            <? } ?>

                            </ul>

                        </div>

                      </div>

                      <? $tab++;} ?>

                      <? if (in_array('14', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab"><img src="<?=IMAGES;?>icon_reportes.png" width="30" height="33" align="absmiddle" style="margin-right:10px" />REPORTES</div>

                        <div class="AccordionPanelContent" style="overflow:hidden">

                        	<ul>

                            

                              <!--<li><a href="<?=URL_APP;?>reportes/reporte1/reporte1.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Costos</a></li>

                              <li><a href="<?=URL_APP;?>reportes/reporte2/reporte2.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Comercial</a></li>

                              <li><a href="<?=URL_APP;?>reportes/reporte3/reporte3.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Utilidad</a></li>

                              <li><a href="<?=URL_APP;?>reportes/reporte4/reporte4.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Utilidad Acumulada</a></li>

                              <li><a href="<?=URL_APP;?>reportes/reporte5/reporte5.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Costos Individuales</a></li>

                              <li><a href="<?=URL_APP;?>reportes/reporte6/reporte6.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Tiempos del proyecto</a></li>

                              <li><a href="<?=URL_APP;?>reportes/reporte8/reporte8.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Asignaciones</a></li>

                              

                              <li><a href="<?=URL_APP;?>reportes/reporte7/reporte7.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Utilidades por a&ntilde;o</a></li>-->
                              
                              
                              <li><a href="<?=URL_APP;?>reportes/reporte9/reporte9.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Informe General</a></li> 
                              
                              <li><a href="<?=URL_APP;?>reportes/reporte10/reporte10.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Reporte Costos</a></li>                           

                          	</ul> 

                        </div>

                      </div>

                       <? $tab++;} ?>

                       

                      

                       <? if (in_array('15', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab" onclick="location.href='<?=URL_APP;?>comercial/comercial/index.php';"><img src="<?=IMAGES;?>icon_comercial.png" width="31" height="27" align="absmiddle" style="margin-right:8px" />COMERCIAL</div>

                        <!--div class="AccordionPanelContent">Contenido 6</div-->

                      </div>

                      <? $tab++;} ?>

                      

                      

                       <? if (in_array('17', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab"><img src="<?=IMAGES;?>icon_reportes.png" width="30" height="33" align="absmiddle" style="margin-right:10px" />ASIGNACI&Oacute;N</div>

                        <div class="AccordionPanelContent" style="overflow:hidden">

                        	<ul>
						
                              <? if (in_array('28', $arrOpciones)) { ?>
                              <li><a href="<?=URL_APP;?>asignacion/vehiculos/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Veh&iacute;culos</a></li>
                              
                              <? } ?> 
							  
							  <? if (in_array('29', $arrOpciones)) { ?>
                              <li><a href="<?=URL_APP;?>asignacion/tecnicos/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Funcionario/T&eacute;cnico</a></li>
                              <? } ?> 
                              
                              <? if (in_array('30', $arrOpciones)) { ?>
                              <li><a href="<?=URL_APP;?>asignacion/asignacion/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Asignaciones</a></li>
							  <? } ?> 
                               

                          	</ul>

                        </div>

                      </div>

                       <? $tab++;} ?>

                       

                       

                      <? if (in_array('18', $arrOpciones) || in_array('19', $arrOpciones) || in_array('20', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab"><img src="https://cdn1.iconfinder.com/data/icons/Momentum_GlossyEntireSet/32/arrow-counterclockwise.png" width="30" height="33" align="absmiddle" style="margin-right:10px" />ANTICIPOS</div>

                        <div class="AccordionPanelContent" style="overflow:hidden">

                        	<ul>

                            <? if (in_array('18', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>anticipos/anticipo/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Anticipos</a></li>

                            <? } ?>

							<? if (in_array('19', $arrOpciones)) { ?>

                              <li><a href="<?=URL_APP;?>anticipos/beneficiario/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Beneficiario</a></li> 

                            <? } ?>

							<? if (in_array('20', $arrOpciones)) { ?> 

                              <li><a href="<?=URL_APP;?>anticipos/legalizacion/index.php?tab=<?=$tab?>"><img src="<?=IMAGES;?>arrow.png" width="11" height="11" border="0" />Legalizaci&oacute;n</a></li> 

                             <? } ?>   

                          	</ul>

                        </div>

                      </div>

                      <? $tab++;} ?>
                      
                      <? if (in_array('26', $arrOpciones)) { ?>

                      <div class="AccordionPanel">

                        <div class="AccordionPanelTab" onclick="location.href='<?=URL_APP;?>financiero/financiero/index.php';"><img src="<?=IMAGES;?>icon_comercial.png" width="31" height="27" align="absmiddle" style="margin-right:8px" />FINANCIERO</div>

                        <!--div class="AccordionPanelContent">Contenido 6</div-->

                      </div>

                      <? $tab++;} ?>      

               	  </div>

            	</div>

				<?php } ?>

                

                

                <div style="float:left;width:82%">

					<?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])) { ?>

                    <div style="float:right; background-image:url(<?=URL_APP;?>images/btn_menu.jpg); background-position: 0px -11px; height:22px; width:40px; margin-right:-40px" class="linksalir"><a href="<?=URL_APP;?>destruir_session.php" style="display:block; text-align:center; padding-top:3px; padding-bottom: 2px;">Salir</a></div>

                    <br clear="all" />

                    <div style="clear:both"></div>

                    <?php } ?>

				