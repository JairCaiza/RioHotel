<?php
require_once("../config/database.php");
require_once("../config/config.php");
class classSelect
{
  private $dbMedico;
  private $vecResp;

  public function __construct()
  {
    $this->vecResp = array();
    $menu = new classBaseDatos();
    $this->dbMedico = $menu->abrirConexion();
  }
  private function set_names()
  {
    return $this->dbMedico->query("SET NAMES 'utf8'");
  }

  public function verAcceso($usuario, $acceso)
  {
    self::set_names();
    $this->dbMedico->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->dbMedico->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sentencia = "SELECT tblPersona.strDocumento, tblPersona.strNombres, tblPersona.strApellidos, tblPersona.strTelefono, tblPersona.strCorreo, tblPersona.strCiudad,
    tblPersona.dtFechaNacimiento, tblPersona.strSexo, tblRol.strNombreRol, tblRol.intEstadoRol FROM tblPersona INNER JOIN tblPersonaRol ON tblPersona.intIdPersona = 
    tblPersonaRol.intIdpersona INNER JOIN tblRol ON tblRol.intIdRol = tblPersonaRol.intIdRol WHERE (tblPersona.strDocumento = ?) AND (tblPersona.strClave = ?) AND
    (tblPersonaRol.intEstado = 1) AND (tblRol.intEstadoRol = 1)";

    $stmt = $this->dbMedico->prepare($sentencia);
    $stmt->execute(array($usuario, $acceso));
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
      $this->vecResp[] = $rs;
    }
    if (count($this->vecResp) > 0)
      $resp = array('resultado' => true, 'respDatos' => $this->vecResp);
    else
      $resp = array('resultado' => false);
    echo json_encode($resp);
    $this->dbMedico = null;
  }

  public function verTodosDatos($opc)
  {
    self::set_names();

    $this->dbMedico->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->dbMedico->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($opc == 1) //CARGA LOS TIPOS DE USUARIOS REGISTRADOS
      $sentencia = "SELECT intIdRol, strNombreRol, intEstadoRol FROM tblRol WHERE (intEstadoRol = 1);";
    if ($opc == 2) //CARGA LOS TIPOS DE HABITACIONES
      $sentencia = "SELECT intIdTipoHabitacion AS idTipo, strDetalleTipo AS 'detalleTipo', intEstado, IF(intEstado = 1, 'Activo', 'Inactivo') AS detalleEstado FROM tblTipoHabitacion WHERE (intEstado = 1);";
    if ($opc == 3) //CARGA LOS ESTADOS DE HABITACIONES REGISTRADOS
      $sentencia = "SELECT intIdEstado AS idTipo, strDetalleEstado AS 'detalleTipo', intEstado, IF(intEstado = 1, 'Activo', 'Inactivo') AS detalleEstado  FROM tblEstadoHabitacion WHERE (intEstado = 1);";
    if ($opc == 4) //CARGA TODAS LAS HABITACIONES REGISTRADAS
      $sentencia = "
    SELECT tblHabitacion.intHabitacion_id, tblHabitacion.intHabitacion_Numero, tblHabitacion.fltHabitacion_Costo, tblHabitacion.strHabitacion_Detalle, tblHabitacion.intHabitacion_Capacidad, tblHabitacion.intHabitacion_Tipo,
    tblHabitacion.intHabitacion_Estado, REPLACE(tblHabitacion.lngHabitacion_Foto,' ', '+') AS foto, tblTipoHabitacion.strTipoHabitacion_Detalle AS detalleTipo, tblEstadoHabitacion.strEstadoHabitacion_Detalle AS detalleEstado
    FROM tblHabitacion INNER JOIN tblTipoHabitacion ON tblTipoHabitacion.intTipoHabitacion_Id = tblHabitacion.intHabitacion_Tipo INNER JOIN tblEstadoHabitacion ON
    tblEstadoHabitacion.intEstadoHabitacion_Id = tblHabitacion.intHabitacion_Estado";
    if ($opc == 5) //CARGA TODAS LAS HABITACIONES DISPONIBLES PARA RESERVA
      $sentencia = " SELECT tblHabitacion.intHabitacion_id, tblHabitacion.intHabitacion_Numero, tblHabitacion.fltHabitacion_Costo, tblHabitacion.strHabitacion_Detalle,
    tblHabitacion.intHabitacion_Capacidad, tblHabitacion.intHabitacion_Tipo, tblHabitacion.intHabitacion_Estado, REPLACE(tblHabitacion.lngHabitacion_Foto,' ', '+') AS foto,
    tblTipoHabitacion.strTipoHabitacion_Detalle AS detalleTipo, tblEstadoHabitacion.strEstadoHabitacion_Detalle AS detalleEstado FROM tblHabitacion INNER JOIN tblTipoHabitacion ON
    tblTipoHabitacion.intTipoHabitacion_Id = tblHabitacion.intHabitacion_Tipo INNER JOIN tblEstadoHabitacion
    ON tblEstadoHabitacion.intEstadoHabitacion_Id = tblHabitacion.intHabitacion_Estado WHERE (tblHabitacion.intHabitacion_Estado = 1);";

    $stmt = $this->dbMedico->prepare($sentencia);
    $stmt->execute(array());
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
      $this->vecResp[] = $rs;
    }
    if (count($this->vecResp) > 0)
      $resp = array('resultado' => true, 'respDatos' => $this->vecResp);
    else
      $resp = array('resultado' => false);
    echo json_encode($resp);
    $this->dbMedico = null;
  }

  public function verUnDato($opc, $param)
  {
    self::set_names();

    $this->dbMedico->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->dbMedico->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sentencia = "";

    if ($opc == 1) //MUESTRA LA INFORMACION DE UN USUARIO DADO SU CEDULA
      $sentencia = "
    SELECT tblPersona.strDocumento, tblPersona.strNombres, tblPersona.strApellidos, tblPersona.strTelefono,
    tblPersona.strCorreo, tblPersona.strCiudad, tblPersona.dtFechaNacimiento, REPLACE(tblPersona.lgFoto, ' ', '+') AS foto,
    tblPersona.strSexo, tblPersona.strClave, tblPersonaRol.intEstado, tblRol.intIdRol,
    tblRol.strNombreRol, tblRol.intEstadoRol AS estadoRol FROM tblPersona INNER JOIN tblPersonaRol ON
    tblPersona.intIdPersona = tblPersonaRol.intIdpersona INNER JOIN tblRol ON tblRol.intIdRol =
    tblPersonaRol.intIdRol WHERE (tblPersona.strDocumento = ?) AND (tblPersonaRol.intEstado = 1) AND (tblRol.intEstadoRol = 1)";

    $stmt = $this->dbMedico->prepare($sentencia);
    $stmt->execute(array($param));
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
      $this->vecResp[] = $rs;
    }
    if (count($this->vecResp) > 0)
      $resp = array('resultado' => true, 'respDato' => $this->vecResp);
    else
      $resp = array('resultado' => false);
    echo json_encode($resp);
    $this->dbMedico = null;
  }

  public function verDosDatos($opc, $param1, $param2)
  {
    self::set_names();

    $this->dbMedico->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $this->dbMedico->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sentencia = "
    ";

    if ($opc == 1) //VER SI UN USARIO TIENE UN PERFIL DADO LA CEDULA Y EL ID
      $sentencia = "
      SELECT tblPersona.strDocumento, tblPersona.strNombres, tblPersona.strApellidos, tblPersona.strTelefono,
      tblPersona.strCorreo, tblPersona.strCiudad, tblPersona.dtFechaNacimiento, REPLACE(tblPersona.lgFoto, ' ', '+') AS foto,
      tblPersona.strSexo, tblPersona.strClave, tblPersonaRol.intEstado, tblRol.intIdRol,
      tblRol.strNombreRol, tblRol.intEstadoRol AS estadoRol FROM tblPersona INNER JOIN tblPersonaRol ON
      tblPersona.intIdPersona = tblPersonaRol.intIdpersona INNER JOIN tblRol ON tblRol.intIdRol =
      tblPersonaRol.intIdRol WHERE (tblPersona.strDocumento = ?) AND (tblRol.intIdRol = ?) AND (tblPersonaRol.intEstado = 1) AND (tblRol.intEstadoRol = 1);";

    $stmt = $this->dbMedico->prepare($sentencia);
    $stmt->execute(array($param1, $param2));
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
      $this->vecResp[] = $rs;
    }
    if (count($this->vecResp) > 0)
      $resp = array('resultado' => true, 'respDatos' => $this->vecResp);
    else
      $resp = array('resultado' => false);
    echo json_encode($resp);
    $this->dbMedico = null;
  }


  public function verDatoIni($opc, $param)
  {
    self::set_names();
    $sentencia = "
    ";
    if ($opc == 1) //VER UN USUARIO DADO SU DOCUMENTO
      $sentencia = "
    SELECT documento, nombres, apellidos, direccion, fono, correo, acceso, estado, tipo, fecha FROM tblUsuario WHERE documento like '%.$param.%'";

    foreach ($this->dbMedico->query($sentencia) as $res) {
      $this->vecResp[] = $res;
    }
    if (count($this->vecResp) > 0)
      $resp = array('resultado' => true, 'respDato' => $this->vecResp);
    else
      $resp = array('resultado' => false);
    echo json_encode($resp);
    $this->dbMedico = null;
  }

  public function verUnDato1($opc, $param1)
  {
    self::set_names();
    $sentencia = "
    ";
    if ($opc == 1)
      $sentencia = "
    SELECT idSigVisita, fecha, estado, paciente, registro FROM tblproximavisita WHERE fecha >= '.$param1. 00:00:00' AND estado = 1;";

    foreach ($this->dbMedico->query($sentencia) as $res) {
      $this->vecResp[] = $res;
    }
    if (count($this->vecResp) > 0)
      $resp = array('resultado' => true, 'respDatos' => $this->vecResp);
    else
      $resp = array('resultado' => false);
    echo json_encode($resp);
    $this->dbMedico = null;
  }

  public function verDosDato1($opc, $param1, $param2)
  {
    self::set_names();
    $sentencia = "
    ";
    if ($opc == 1) //REPORTE DE ATENCIONES MEDICAS
      $sentencia = "
    SELECT idVisita, motivo, enfermedad, fisico, diagnostico, tratamiento, paciente, registro, fecha FROM tblVisita WHERE (tblVisita.fecha >= '.$param1. 00:00:00') AND (tblVisita.fecha <= '.$param2. 23:59:00');";

    foreach ($this->dbMedico->query($sentencia) as $res) {
      $this->vecResp[] = $res;
    }
    if (count($this->vecResp) > 0)
      $resp = array('resultado' => true, 'respDatos' => $this->vecResp);
    else
      $resp = array('resultado' => false);
    echo json_encode($resp);
    $this->dbMedico = null;
  }
}
