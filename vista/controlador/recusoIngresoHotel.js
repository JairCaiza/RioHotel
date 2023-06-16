
function personaIngreso(opc, param1, param2, param3, param4, param5, param6, param7, param8, param9, param10,
    param11, param12, param13, param14, param15, param16, param17, param18, param19, param20) {
    var vecData = [opc, param1, param2, param3, param4, param5, param6, param7, param8, param9, param10,
        param11, param12, param13, param14, param15, param16, param17, param18, param19, param20];
    var valorPost = JSON.stringify(vecData);
    $.ajax({
        type: "POST",
        url: "controlador/frmIngreso.php",
        data: "insDataHotel=" + valorPost,
        dataType: "html",
        success: function (data) {
            var datos = JSON.parse(data);
            if (datos.resultado) {
                guardarDataHotel(2, 3, param1, 1, 'na', 'na', 'na', 'na', 'na', 'na', 'na');
                alertify.success('Inicie sesión');
            }
            else
                alertify.error("No se pudo procesar intente más tarde.");
        },
        error: function (data) {
            alertify.error("ERROR. al procesar intente más tarde.");
        }
    });
}

function guardarDataHotel(opc, param1, param2, param3, param4, param5, param6, param7, param8, param9, param10) {
    var vecData = [opc, param1, param2, param3, param4, param5, param6, param7, param8, param9, param10];
    var valorPost = JSON.stringify(vecData);
    $.ajax({
        type: "POST",
        url: "controlador/frmIngreso.php",
        data: "insDataHotel=" + valorPost,
        dataType: "html",
        success: function (data) {
            var datos = JSON.parse(data);
            if (datos.resultado)
                alertify.success('Datos ingresados correctamente');
            else
                alertify.error("No se pudo procesar intente más tarde.");
        },
        error: function (data) {
            alertify.error("ERROR. al procesar intente más tarde.");
        }
    });
}
function guardarFormDataHotel(opc, param1, param2, param3, param4, param5, param6, param7, param8, param9, param10,
    param11, param12, param13, param14, param15, param16, param17, param18, param19, param20) {
    var vecData = [opc, param1, param2, param3, param4, param5, param6, param7, param8, param9, param10,
        param11, param12, param13, param14, param15, param16, param17, param18, param19, param20];
    var valorPost = JSON.stringify(vecData);
    $.ajax({
        type: "POST",
        url: "../controlador/frmIngreso.php",
        data: "insDataHotel=" + valorPost,
        dataType: "html",
        success: function (data) {
            var datos = JSON.parse(data);
            if (datos.resultado) {
                alertify.success('Datos ingresados correctamente');
                if (opc == 3)
                    verAdminDataHotel(4, 2, 'tbodyAAHabitacion');
                if (opc == 4)
                    verAdminDataHotel(2, 2, 'tbodyAATipoHabitacion');
                if (opc == 5)
                    verAdminDataHotel(3, 2, 'tbodyAAEstadoHabitacion');
                if (opc == 6)
                    editarDataHotel(1, param10, 3, 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na');
            }
            else
                alertify.error("No se pudo procesar intente más tarde.");
        },
        error: function (data) {
            alertify.error("ERROR. al procesar intente más tarde.");
        }
    });
}
