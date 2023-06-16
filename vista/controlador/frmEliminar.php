<?php
require_once("frmConfig.php");
$ruta = new classConfig();
$dirBorrar = $ruta->rutaEliminar();

if (!empty($_POST['delMedicina'])) {
    $vect = json_decode($_POST['delMedicina']);
    $pd = json_decode(file_get_contents($dirBorrar . 'opc=borrarMedico&cual=' . $vect[0] . '&dato=' . $vect[1]), true);
    if ($pd['resultado']) {
        $resp = array('resultado' => true);
    } else
        $resp = array('resultado' => false);
    echo json_encode($resp);
}

?>