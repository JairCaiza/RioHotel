<?php
require_once("../modelo/modSelect.php");
$ruta = new classSelect();

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	if (isset($_GET['opc']) && $_GET['opc'] == "ingreso")
		$ruta -> verAcceso($_GET['usuario'], $_GET['acceso']);
	
	if (isset($_GET['opc']) && $_GET['opc'] == "todosDatos")
		$ruta -> verTodosDatos($_GET['cual']);

	if (isset($_GET['opc']) && $_GET['opc'] == "unDato")
		$ruta -> verUnDato($_GET['cual'], $_GET['dato']);
	
	if (isset($_GET['opc']) && $_GET['opc'] == "dosDatos")
		$ruta -> verDosDatos($_GET['cual'], $_GET['dato1'], $_GET['dato2']);

	if (isset($_GET['opc']) && $_GET['opc'] == "dosDatos1")
		$ruta -> verDosDato1($_GET['cual'], $_GET['dato1'], $_GET['dato2']);


	if (isset($_GET['opc']) && $_GET['opc'] == "unDatoIni")
		$ruta -> verDatoIni($_GET['cual'], $_GET['dato']);
	
	if (isset($_GET['opc']) && $_GET['opc'] == "datosPaciente")
		$ruta -> verTodosDato($_GET['cual']);
}

?>