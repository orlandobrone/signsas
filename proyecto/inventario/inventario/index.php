<?php  include "../../restrinccion.php";  ?>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Documento sin t?tulo</title>

        <script language="javascript" type="text/javascript" src="../extras/js/jquery-1.3.2.min.js"></script>

        <script language="javascript" type="text/javascript" src="../extras/js/jquery.blockUI.js"></script>

        <script language="javascript" type="text/javascr

        <script language="javascript" type="text/javascript" src="../extras/js/mask.js"></script>

        <link href="../extras/css/estilo.css" rel="stylesheet" type="text/css" />

        <link href="../extras/php/PHPPaging.lib.css" rel="stylesheet" type="text/css" />

        <script language="javascript" type="text/javascript" src="index.js"></script>

    </head>

    <body>-->

    <?php require_once "../../config.php";

	define('URL_SECCION', URL_INVENTARIO);

	define('SECCION', INVENTARIO); ?>

	<?php require_once "../../tpl_top.php"; ?>

    <script type="text/javascript">

    $(document).ready(function () {

            var source =

            {

                 datatype: "json",

                 datafields: [

					 { name: 'id', type: 'string'},

					 { name: 'nombre_material', type: 'string'},

					 { name: 'descripcion', type: 'string'},

					 { name: 'cantidad', type: 'string'},

					 { name: 'costo_unidad', type: 'string'},

					 { name: 'fecha', type: 'date'},

					 { name: 'costo', type: 'string'},

					 { name: 'ubicacion', type: 'string'},

					 { name: 'codigo', type: 'string'},

					 { name: 'acciones', type: 'string'}

                ],

				cache: false,

			    url: 'ajax_data.php',

				sortcolumn: 'id',

                sortdirection: 'desc',

				filter: function()

				{

					// update the grid and send a request to the server.

					$("#jqxgrid").jqxGrid('updatebounddata', 'filter');

				},

				sort: function()

				{

					// update the grid and send a request to the server.

					$("#jqxgrid").jqxGrid('updatebounddata', 'sort');

				},

				root: 'Rows',

				beforeprocessing: function(data)

				{		

					if (data != null)

					{

						source.totalrecords = data[0].TotalRows;					

					}

				}

				};		

				var dataadapter = new $.jqx.dataAdapter(source, {

					loadError: function(xhr, status, error)

					{

						alert(error);

					}

				}

				);



            // var dataadapter = new $.jqx.dataAdapter(source);



            $("#jqxgrid").jqxGrid(

            {

                width: '100%',

                source: dataadapter,

                showfilterrow: true,

                pageable: true,

                filterable: true,

                theme: theme,

				autorowheight: true,

                autoheight: true,

				sortable: true,

                autoheight: true,

                columnsresize: true,

				virtualmode: true,

				rendergridrows: function(obj)

				{

					 return obj.data;      

				},              

                columns: [

                  { text: 'ID',datafield: 'id',filtertype: 'number',filtercondition: 'equal',columntype:'textbox', width: 50 },

                  { text: '-', datafield: 'acciones', filtertype: 'none',pinned: true, width: 50},

				  { text: 'Código', datafield: 'codigo',filtertype: 'textbox', filtercondition: 'starts_with' },

				  { text: 'Ubicación', datafield: 'ubicacion', filtertype: 'textbox', filtercondition: 'starts_with' },

				  { text: 'Nombre Material', datafield: 'nombre_material', filtertype: 'number', filtercondition: 'starts_with'},

                  { text: 'Descripción', datafield: 'descripcion', filtertype: 'textbox', filtercondition: 'starts_with'},

                  { text: 'Cantidad', datafield: 'cantidad', filtertype: 'number',cellsalign: 'right'},

                  { text: 'Costo Unitario', datafield: 'costo_unidad', filtertype: 'textbox',  cellsalign: 'right',width: 100 },

				  { text: 'Fecha Registro', datafield: 'fecha' ,filtertype: 'date', filtercondition: 'equal', cellsformat: 'yyyy-MM-dd',width: 100}

                ]

            });

            $(".btn_table").jqxButton({ theme: theme });

            $('#clearfilteringbutton').click(function () {

                $("#jqxgrid").jqxGrid('clearfilters');

            });

			$("#excelExport").click(function () {

                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'Beneficiarios');           

            });

			

			$('#excelExport2').click(function(){

				window.open("/inventario/inventario/export_excel.php");

			});

        });

   </script>

    

    

   <div id="cuerpo">

           <h1>INVENTARIO</h1>

           

            <div style="background:#ECECEC; margin-bottom:15px;border:1px solid #CCC;padding:10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px; width:96%; margin-top:20px;">

             <input value="Agregar Inventario" type="button" onclick="javascript: fn_mostrar_frm_agregar();" class="btn_table" />

             <input value="Reiniciar Filtros" id="clearfilteringbutton" type="button" class="btn_table" />

             <input type="button" value="Exportar a Excel" id='excelExport' class="btn_table" />

             <input type="button" value="Exportar Todo" id='excelExport2' class="btn_table" /> 

            </div>

            

            <div id="jqxgrid"></div>

            <div id="div_oculto" style="display: none;"></div>

            <p align="right">Desarrollado por: <strong>Ingecall SAS</strong><br /><a href="http://www.ingecall.com" target="_blank">www.ingecall.com</a></p>

        </div>

    <?php require_once "../../tpl_bottom.php"; ?>

    <!--</body>

</html>-->