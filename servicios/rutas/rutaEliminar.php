<?php
require_once("../modelo/modEliminar.php");
$ruta = new classEliminar();

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	if (isset($_GET['opc']) && $_GET['opc'] == "borrarMedico")
		$ruta -> eliminarDatosMedico($_GET['cual'], $_GET['dato']);
}

?>