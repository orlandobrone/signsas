// JavaScript Document

$(document).ready(function(){
	//fn_buscar();
	$("#grilla tbody tr").mouseover(function(){
		$(this).addClass("over");
	}).mouseout(function(){
		$(this).removeClass("over");
	});
});

function fn_cerrar(){
	$.unblockUI({ 
		onUnblock: function(){
			$("#div_oculto").html("");
		}
	}); 
	$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
};

function fn_mostrar_frm_agregar(){
	$("#div_oculto").load("ajax_form_agregar.php", function(){
		$.blockUI({
			message: $('#div_oculto'),
			css:{
				width: '47%',
				top: '1%',
				left: '23%',
				'max-height':'600px',
				'overflow-y': 'scroll'
			}
		}); 
	});
};

function fn_mostrar_frm_modificar(ide_per){
	$("#div_oculto").load("ajax_form_modificar.php", {ide_per: ide_per}, function(){
		$.blockUI({
			message: $('#div_oculto'),
			css:{
				width: '52%',
				top: '1%',
				left: '23%',
				'max-height':'600px',
				'overflow-y': 'scroll'
			}
		}); 
	});
};

function fn_paginar(var_div, url){
	var div = $("#" + var_div);
	$(div).load(url);
	/*
	div.fadeOut("fast", function(){
		$(div).load(url, function(){
			$(div).fadeIn("fast");
		});
	});
	*/
}

function fn_eliminar(ide_per){
	var respuesta = confirm("Desea eliminar este P.O?");
	if (respuesta){
		$.ajax({
			url: 'ajax_eliminar.php',
			data: 'id=' + ide_per,
			type: 'post',
			success: function(data){
				if(data!=""){
					alert(data);
				}
				$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
			}
		});
	}
}

function fn_buscar(){
	/*var str = $("#frm_buscar").serialize();
	$.ajax({
		url: 'ajax_listar.php',
		type: 'get',
		data: str,
		success: function(data){
			$("#div_listar").html(data);
		}
	});*/
	$("#jqxgrid").jqxGrid('updatebounddata', 'cells');
}