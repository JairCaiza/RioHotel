	<?php
require_once("../config/database.php");
require_once("../config/config.php");

class classEliminar{
	private $dbProyecto;

	public function __construct(){
    $menu = new classBaseDatos();
    $this->dbProyecto = $menu->abrirConexion();
	}

	private function set_names(){
		return $this->dbProyecto->query("SET NAMES 'utf8'");
	}
	
	public function eliminarDatosMedico($opc, $dato){
		self::set_names();
		$sentencia = "";
		if($opc == 1)
			$sentencia = "DELETE FROM tblCie10Visita WHERE consulta = ".$dato;

		$sql = $sentencia;
		$result = $this->dbProyecto->query($sql);

		if ($result)
			$resp = array('resultado' => true);
		else
			$resp = array('resultado' => false);
		echo json_encode($resp);
	}
}

?>

