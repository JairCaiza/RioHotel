<?php
require_once("../config/database.php");
require_once("../config/config.php");

class classIngreso
{
	private $dbProyecto;

	public function __construct() {
		$menu = new classBaseDatos();
		$this->dbProyecto = $menu->abrirConexion();
	}

	private function set_names() {
		return $this->dbProyecto->query("SET NAMES 'utf8'");
	}

	public function registroHotel($param) {
		self::set_names();
		$fechaActual = date('d-m-Y');

		if ($param['dato0'] == 1) //REGISTRO DATOS DE USUARIOS DEL HOTEL
		$sql = "INSERT INTO tblPersona(strDocumento, strNombres, strApellidos, strTelefono, strCorreo, strCiudad, dtFechaNacimiento, lgFoto, strSexo, strClave)
		VALUES ('" . $param['dato1'] . "', '" . $param['dato2'] . "', '" . $param['dato3'] . "', '" . $param['dato4'] . "', '" . $param['dato5'] . "', '" . $param['dato6'] . "',
		'" . $param['dato7'] . "', '" . $param['dato8'] . "', '" . $param['dato9'] . "', '" . md5($param['dato10']) . "');";
		if ($param['dato0'] == 2) //ASIGNAR UN ROL A UNA PERSONA
		$sql = "INSERT INTO tblPersonaRol(intIdRol, intIdpersona, intEstado) VALUES (" . $param['dato1'] . ", (SELECT intIdPersona FROM tblpersona WHERE strDocumento = '" .$param['dato2'] . "' LIMIT 1), " .$param['dato3'] . ");";
		if ($param['dato0'] == 3) //REGISTRO DE UNA HABITACION
		$sql = "INSERT INTO tblHabitacion(intHabitacion_Numero, fltHabitacion_Costo, strHabitacion_Detalle, intHabitacion_Capacidad, intHabitacion_Tipo, intHabitacion_Estado,
			lngHabitacion_Foto) VALUES (" . $param['dato1'] . ", " . $param['dato2'] . ", '" . $param['dato3'] . "', " . $param['dato4'] . ", " . $param['dato5'] . ", " .
			$param['dato6'] . ", '" . $param['dato7'] . "');";
		if ($param['dato0'] == 4) //REGISTRO DE UN TIPO DE HABITACION
		$sql = "INSERT INTO tblTipoHabitacion(strTipoHabitacion_Detalle, intTipoHabitacion_Estado) VALUES('" . $param['dato1'] . "', " . $param['dato2'] . ");";
		if ($param['dato0'] == 5) //REGISTRO DE UN ESTADO DE HABITACION
		$sql = "INSERT INTO tblEstadoHabitacion(strEstadoHabitacion_Detalle, intEstadoHabitacion_Estado) VALUES('" . $param['dato1'] . "', " . $param['dato2'] . ");";
		if ($param['dato0'] == 6) //REGISTRO DE UN NUEVO REGISTRO
		$sql = "INSERT INTO tblReserva(strReserva_Cedula, strReserva_Nombres, strReserva_Apellidos, dtReserva_F_ingreso, dtReserva_F_salida, strReserva_Direccion, Reserva_CCelular, intReserva_Arreglo, dtReserva_F_nacimiento, intReserva_Habitación, strReserva_Vehiculo, intReserva_NumCompania, strReserva_Recepcionista, fltReserva_Costo, strReserva_Factura, strReserva_Registro, dtReserva_F_registro, intReserva_Estado) VALUES('" . $param['dato1'] . "', '" . $param['dato2'] . "', '" . $param['dato3'] . "', '" . $param['dato4'] . "', '" . $param['dato5'] . "', '" . $param['dato6'] . "', '" . $param['dato7'] . "', '" . $param['dato8'] . "', '" . $param['dato9'] . "', '" . $param['dato10'] . "', '" . $param['dato11'] . "', " . $param['dato12'] . ", '" . $param['dato13'] . "', " . $param['dato14'] . ", '" . $param['dato15'] . "', '" . $param['dato16'] . "', '" . $fechaActual . "', " . $param['dato17'] . ");";

		$result = $this->dbProyecto->query($sql);

		if ($result)
			$resp = array('resultado' => true);
		else
			$resp = array('resultado' => false);
		echo json_encode($resp);
	}
}
?>