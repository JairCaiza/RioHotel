<?php
require_once("config.php");
class classBaseDatos{
	private $vecConfig;

	public function __construct(){
		$this->vecConfig = array();
		$objConf = new classConfig();
		$this->vecConfig = $objConf->vecData();		
	}

	public function abrirConexion(){
		$dbM = new PDO("mysql:host={$this->vecConfig['host']}; dbname={$this->vecConfig['db']}", $this->vecConfig['username'], $this->vecConfig['password']);
		return ($dbM);
	}

	private function set_names(){
		return $this->dbM->query("SET NAMES 'utf8'");
	}	
}
?>