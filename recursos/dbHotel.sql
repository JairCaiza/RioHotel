=================== dbRioHotel ===================

CREATE TABLE tblRol (
  intIdRol INT NOT NULL AUTO_INCREMENT,
  strNombreRol VARCHAR(15) NOT NULL,
  intEstadoRol INT NOT NULL,
  PRIMARY KEY (intIdRol)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;

CREATE TABLE tblPersona(
  intIdPersona INT NOT NULL AUTO_INCREMENT,
  strDocumento VARCHAR(15),
  strNombres VARCHAR(30),
  strApellidos VARCHAR(30),
  strTelefono VARCHAR(20),
  strCorreo VARCHAR(50),
  strCiudad VARCHAR(50),
  dtFechaNacimiento DATE,
  lgFoto LONGBLOB,
  strSexo VARCHAR(25),
  strClave VARCHAR(150),
  PRIMARY KEY (intIdPersona)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;

CREATE TABLE tblPersonaRol(
  intIdPersonaRol INT AUTO_INCREMENT,
  intIdRol INT,
  intIdpersona INT,
  intEstado INT,
  PRIMARY KEY (intIdPersonaRol),
  FOREIGN KEY (intIdRol) REFERENCES tblRol (intIdRol),
  FOREIGN KEY (intIdpersona) REFERENCES tblPersona(intIdPersona)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;


CREATE TABLE tblTipoHabitacion (
  intIdTipoHabitacion INT NOT NULL AUTO_INCREMENT,
  strDetalleTipo VARCHAR(15) NOT NULL,
  intEstado INT NOT NULL,
  PRIMARY KEY (intIdTipoHabitacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;

CREATE TABLE tblHabitacion(
  intIdHabitacion INT AUTO_INCREMENT,
  intIdTipoHabitacion INT,
  intNumero INT,
  fltCostoHabitacion FLOAT,
  strDetalleHabitacion VARCHAR(50),
  intCapacidadHabitacion INT,
  intEstadoHabitacion INT,
  lgFotoHabitacion LONGBLOB,
  PRIMARY KEY(intIdHabitacion),
  FOREIGN KEY (intIdTipoHabitacion) REFERENCES tblTipoHabitacion (intIdTipoHabitacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;

CREATE TABLE tblEstadoHabitacion(
  intIdEstado INT NOT NULL AUTO_INCREMENT,
  strDetalleEstado VARCHAR(15) NOT NULL,
  intEstado INT NOT NULL,
  PRIMARY KEY (intIdEstado)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;

CREATE TABLE tblEstados_Habitacion(
  intIdEstado INT NOT NULL,
  intIdHabitacion INT NOT NULL,
  dtFechaInicioMantenimiento DATETIME,
  dtFechaFinMantenimiento DATETIME,
  PRIMARY KEY (intIdEstado, intIdHabitacion),
  FOREIGN KEY (intIdEstado) REFERENCES tblEstadoHabitacion(intIdEstado),
  FOREIGN KEY (intIdHabitacion) REFERENCES tblHabitacion(intIdHabitacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;


CREATE TABLE tblReserva(
  intIdReserva INT AUTO_INCREMENT,
  dtFechaIngreso DATETIME,
  dtFechaSalida DATETIME,
  strReserva_Direccion VARCHAR(75),
  strReserva_Celular VARCHAR(20),
  fltDescuento_Reserva FLOAT,
  strReserva_Vehiculo VARCHAR(20),
  intReservaNumCompania INT,
  fltReserva_Costo FLOAT,
  strReserva_Factura VARCHAR(125),
  strReserva_Registro VARCHAR(15),
  dtFechaRegistro DATETIME,
  inTEstadoReserva INT,
  strObservacionReserva VARCHAR(100),
  PRIMARY KEY (intIdReserva)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;

CREATE TABLE tblPersonas_Reservas(
  intIdPersonaRol INT NOT NULL,
  intIdReserva INT NOT NULL,
  strTipoPersonaReserva VARCHAR(25),
  PRIMARY KEY (intIdPersonaRol, intIdReserva),
  FOREIGN KEY (intIdPersonaRol) REFERENCES tblPersonaRol(intIdPersonaRol),
  FOREIGN KEY (intIdReserva) REFERENCES tblReserva(intIdReserva)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;

CREATE TABLE tblReserva_Habitacion(
  intIdHabitacion INT NOT NULL,
  intIdReserva INT NOT NULL,
  PRIMARY KEY (intIdHabitacion, intIdReserva),
  FOREIGN KEY (intIdHabitacion) REFERENCES tblHabitacion(intIdHabitacion),
  FOREIGN KEY (intIdReserva) REFERENCES tblReserva(intIdReserva)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1;


INSERT INTO tblRol (strNombreRol, intEstadoRol) VALUES ('ADMIN', 1);
INSERT INTO tblRol (strNombreRol, intEstadoRol) VALUES ('EMPLEADO', 1);
INSERT INTO tblRol (strNombreRol, intEstadoRol) VALUES ('USUARIO', 1);

INSERT INTO tblTipoHabitacion (strDetalleTipo, intEstado) VALUES ('SIMPLE', 1);
INSERT INTO tblTipoHabitacion (strDetalleTipo, intEstado) VALUES ('DOBLE', 1);
INSERT INTO tblTipoHabitacion (strDetalleTipo, intEstado) VALUES ('PRESIDENCIAL', 1);
INSERT INTO tblTipoHabitacion (strDetalleTipo, intEstado) VALUES ('SUITE', 1);

INSERT INTO tblEstadoHabitacion(strDetalleEstado, intEstado) VALUES ('LIBRE', 1);
INSERT INTO tblEstadoHabitacion(strDetalleEstado, intEstado) VALUES ('OCUPADO', 1);
INSERT INTO tblEstadoHabitacion(strDetalleEstado, intEstado) VALUES ('RESERVADO', 1);



SELECT tblPersona.strDocumento, tblPersona.strNombres, tblPersona.strApellidos, tblPersona.strTelefono, tblPersona.strCorreo, tblPersona.strCiudad, tblPersona.dtFechaNacimiento, tblPersona.strSexo, tblRol.strNombreRol, tblRol.intEstadoRol FROM tblPersona INNER JOIN tblPersonaRol
    ON tblPersona.intIdPersona = tblPersonaRol.intIdpersona INNER JOIN tblRol ON tblRol.intIdRol =
    tblPersonaRol.intIdRol WHERE (tblPersona.strDocumento = '') AND (tblPersona.strClave = '') AND
    (tblPersonaRol.intEstado = 1) AND (tblRol.intEstadoRol = 1)
    
