<?php
$hora1 = $_POST['hora1'];
$hora2 = $_POST['hora2'];
	
		$separar[1]=explode(':',$hora1); 
		$separar[2]=explode(':',$hora2); 
	
		$total_minutos[1] = ($separar[1][0]*60)+$separar[1][1]; 
		$total_minutos[2] = ($separar[2][0]*60)+$separar[2][1]; 
		$total_minutos = $total_minutos[1]-$total_minutos[2]; 
		$total_horas = $total_minutos/60;
		echo $total_horas;
?>