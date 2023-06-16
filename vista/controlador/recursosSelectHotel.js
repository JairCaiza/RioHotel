
function verAcceso(objVista) {
    var valorPost = JSON.stringify(objVista);
    $.ajax({
        type: "POST",
        url: "controlador/frmSelect.php",
        data: "inicioCode=" + valorPost,
        dataType: "html",
        success: function (data) {console.log(data)
            var datos = JSON.parse(data);
            if (datos.resultado) {
                localStorage.setItem('perfilCedula',datos.dataPerfil[0]['strDocumento']);
                localStorage.setItem('perfilNombres',datos.dataPerfil[0]['strNombres']);
                localStorage.setItem('perfilApellidos',datos.dataPerfil[0]['strApellidos']);
                localStorage.setItem('perfilFono',datos.dataPerfil[0]['strTelefono']);
                localStorage.setItem('perfilCorreo',datos.dataPerfil[0]['strCorreo']);
                localStorage.setItem('perfilCiudad',datos.dataPerfil[0]['strCiudad']);
                localStorage.setItem('perfilFechaNac',datos.dataPerfil[0]['dtFechaNacimiento']);
                localStorage.setItem('perfilSexo',datos.dataPerfil[0]['strSexo']);
                $(location).attr('href', 'formularios/frmAdminInicio.php');
            } else
                alertify.error("Usuario o contraseña incorrectos");
        },
        error: function (data) {
            alertify.error("ERROR. al procesar intente más tarde.");
        }
    });
}
//////////////////////////////////////////////////////////////// FUNCIONES DEL ADMIN ////////////////////////////////////////////////////////////////
/////// VER ESTADOS HABITACION
function verAdminDataHotel(op, vista, objVista) {
    var vecData = [op];
    var valorPost = JSON.stringify(vecData);
    var addItem = '';
    $.ajax({
        type: "POST",
        url: "../controlador/frmSelect.php",
        data: "paramHotel=" + valorPost,
        dataType: "html",
        success: function (data) {
            var datos = JSON.parse(data);
            if (datos.resultado) {
                $.each(datos.datosHotel, function (id, resp) {
                    addItem += cargarAdminObjVisual('data' + op, vista, resp);
                });
                $('#' + objVista).html(addItem);
                if (op == 2)
                    instanciaTabla('#tblAdminTipoHabitacion');
                if (op == 4)
                    instanciaTabla('#tblAdminHabitacion');
            }
        },
        error: function (data) {
            alertify.error("ERROR. al procesar intente más tarde.");
        }
    });
}
/////// VER HABITACIONES GUARDADAS
function cargarAdminObjVisual(op, ver, objHotel) {
    var recurso = '';
    if ((op == 'data2' && ver == 1) || (op == 'data3' && ver == 1)) {
        recurso += "<option value='" + objHotel['idTipo'] + "'>" + objHotel['detalleTipo'] + "</option>";
    }
    else if (op == 'data4' && ver == 2) {
        recurso += "<tr> <td>" + objHotel['intHabitacion_Numero'] + "</td> <td>" + objHotel['detalleTipo'] + "</td> ";
        recurso += "<td>" + objHotel['detalleEstado'] + "</td> <td>" + objHotel['fltHabitacion_Costo'] + "</td> <td>" + objHotel['strHabitacion_Detalle'] + "</td> ";
        recurso += "<td>" + objHotel['intHabitacion_Capacidad'] + "</td> <td> <img src='" + objHotel['foto'] + "' style='width: 75px; height:75px;'></td> </tr>";
    }
    else if (op == 'data2' && ver == 2) {
        recurso += "<tr> <td>" + objHotel['detalleTipo'] + "</td> <td>" + objHotel['detalleEstado'] + "</td>  </tr>";
    }
    else if (op == 'data3' && ver == 2) {
        recurso += "<tr> <td>" + objHotel['detalleTipo'] + "</td> <td>" + objHotel['detalleEstado'] + "</td>  </tr>";
    }
    else if (op == 'data5' && ver == 3) {
        recurso = `<div class="col-md-12 col-sm-12 "> <div class="x_panel">
        <div class="x_title"> <h2>`+objHotel['detalleTipo']+`</h2>
        <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li> <li><a class="close-link"><i class="fa fa-close"></i></a> </li>
        </ul>
        <div class="clearfix"></div> </div>
        <div class="x_content"> <br />
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        <div class="item form-group">
        <div class="col-md-9 col-sm-9" style="text-align: center;">
        <img src="`+objHotel['foto']+`" style="width: 175px; height: 175px;">
        </div> </div>
        <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align"> <b>NÚMERO:</b> </label>
        <label class="col-form-label col-md-2 col-sm-2">`+objHotel['intHabitacion_Numero']+` </label>
        <label class="col-form-label col-md-3 col-sm-3 label-align"> <b>COSTO:</b> </label>
        <label class="col-form-label col-md-3 col-sm-3">`+objHotel['fltHabitacion_Costo']+` </label>
        </div>
        <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align"> <b>CAPACIDAD:</b> </label>
        <label class="col-form-label col-md-2 col-sm-2">`+objHotel['intHabitacion_Capacidad']+` </label>
        <label class="col-form-label col-md-3 col-sm-3 label-align"> <b>TIPO:</b> </label>
        <label class="col-form-label col-md-3 col-sm-3">`+objHotel['detalleTipo']+` </label>
        </div>
        <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align"> <b>DETALLE:</b> </label>
        <label class="col-form-label col-md-6 col-sm-6">`+objHotel['strHabitacion_Detalle']+` </label>
        </div>
        <div class="ln_solid"></div>
        <div class="item form-group">
        <div class="col-md-6 col-sm-6 offset-md-3">
        <button type="button" class="btn btn-success" onclick="verDatosRH(`+objHotel['intHabitacion_Numero']+`, `+objHotel['fltHabitacion_Costo']+`, `+objHotel['intHabitacion_id']+`)" data-toggle="modal" data-target="#modal-ReservaHabitacion"> Reservar </button>
        </div> </div> </form> </div> </div> </div>`;
    }
    return (recurso);
}
//////////////////////////////////////////////////////////////// FUNCIONES DEL ADMIN ////////////////////////////////////////////////////////////////