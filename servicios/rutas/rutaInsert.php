<?php
require_once("../modelo/modIngreso.php");
$ruta = new classIngreso();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_GET['opc']) && $_GET['opc'] == "insHotel")
		$ruta -> registroHotel($_POST);
}
	
?>