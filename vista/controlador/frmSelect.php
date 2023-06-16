<?php
require_once("frmConfig.php");
$ruta = new classConfig();
$dirSelect = $ruta->rutaSelect();

if (!empty($_POST['inicioCode'])) {
	$vect = json_decode($_POST['inicioCode']);
	$pd = json_decode(file_get_contents($dirSelect . 'opc=ingreso&usuario=' . $vect[0] . '&acceso=' . md5($vect[1])), true);
	if ($pd['resultado']) {
		$resp = array('resultado' => true, 'dataPerfil' => $pd['respDatos']);
		session_start();
		$_SESSION['usuario'] = $pd['respDatos'][0]['strDocumento'];
	} else
		$resp = array('resultado' => false);
	echo json_encode($resp);
}


//////////////////////////////////////////////////////////////// FUNCIONES DEL ADMIN ////////////////////////////////////////////////////////////////
/////// HABITACION
if (!empty($_POST['paramHotel'])) {
	$vect = json_decode($_POST['paramHotel']);
	$pd = json_decode(file_get_contents($dirSelect . 'opc=todosDatos&cual=' . $vect[0]), true);
	if ($pd['resultado']) {
		$resp = array('resultado' => true, 'datosHotel' => $pd['respDatos']);
	} else
		$resp = array('resultado' => false);
	echo json_encode($resp);
}

//////////////////////////////////////////////////////////////// FUNCIONES DEL ADMIN ////////////////////////////////////////////////////////////////
?>