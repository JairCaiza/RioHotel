<?php
require_once("../config/database.php");
require_once("../config/config.php");

class classEditar{
	private $dbProyecto;

	public function __construct(){
		$menu = new classBaseDatos();
		$this->dbProyecto = $menu->abrirConexion();
	}

	private function set_names(){
		return $this->dbProyecto->query("SET NAMES 'utf8'");
	}
	
	public function editarDatosHotel($param){
		self::set_names();
		$sql="";

		if ($param['dato0'] == 1)//ACTUALIZA EL ESTADO DE UNA HABITACI0N RESERVADA
			$sql = "UPDATE tblHabitacion SET intHabitacion_Estado = ".$param['dato2']." WHERE intHabitacion_id =".$param['dato1'].";";
	
		$result = $this->dbProyecto->query($sql);
		
		if ($result)
			$resp = array('resultado' => true);
		else
			$resp = array('resultado' => false);
		echo json_encode($resp);
	}
}

?>

