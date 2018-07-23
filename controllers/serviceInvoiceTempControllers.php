<?php
include '../models/invoicesServicesTempModels.php';
date_default_timezone_set("America/Caracas");
$fecha_registro=date("Y-m-d");

if(isset($_POST['servicio'])){
	$servicio = $_POST['servicio'];
	$dinero_us = $_POST['dinero_us'];
	$dinero_cad = $_POST['dinero_cad'];
	$nota = $_POST['nota'];
	$codigo = $_POST['codigo'];
	$usuario = $_POST['usuario'];

	$insert = new invoicesServicesTemp($codigo,$servicio,$dinero_us,$dinero_cad,$nota,$usuario,$fecha_registro,'');
	$insert->InsertTablaTempServi();
	//llamar al monmento de resgistar
	$consulta = new invoicesServicesTemp($codigo,'','','','',$usuario,'','');
	$array=$consulta->SelectServicosTablaTemp();
	if($array->num_rows!=0){
		while($resultado = $array->fetch_assoc()) { 
		  $data []= array('id' => $resultado['id'], 
		  				  'codigo_ser' => $resultado['codigo_ser'],
		  				  'descripcion' => $resultado['descripcion'],
		  				  'dolar_us' => $resultado['pago_us'],
		  				  'dolar_cad' => $resultado['pago_can'],
		  				  'nota' => $resultado['nota'],
		  				); 
		} 
	}else{
		$data=0;
	}
	echo json_encode($data);
}
//llama cuando se habre la pagina
if(isset($_GET['tabla']) && $_GET['tabla']==1){
	$codigo = $_GET['codigo'];
	$usuario = $_GET['usuario'];
	$consulta = new invoicesServicesTemp($codigo,'','','','',$usuario,'','');
	$array=$consulta->SelectServicosTablaTemp();
	if($array->num_rows!=0){
		while($resultado = $array->fetch_assoc()) { 
		  $data []= array('id' => $resultado['id'],
		  				  'codigo_ser' => $resultado['codigo_ser'], 
		  				  'descripcion' => $resultado['descripcion'],
		  				  'dolar_us' => $resultado['pago_us'],
		  				  'dolar_cad' => $resultado['pago_can'],
		  				  'nota' => $resultado['nota'],
		  				); 
		} 
	}else{
		$data=0;
	}
	echo json_encode($data);
}
//eliminar registro
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$eliminar = new invoicesServicesTemp('','','','','','','',$id);
	$array=$eliminar->EliminarServicioTablaTemp();

	echo json_encode(3);
}




 
?>