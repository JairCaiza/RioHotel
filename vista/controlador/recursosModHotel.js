
function editarDataHotel(op, dato1, dato2, dato3, dato4, dato5, dato6, dato7, dato8, dato9, dato10, dato11, dato12, dato13, dato14, dato15) {
    var vecData = [op, dato1, dato2, dato3, dato4, dato5, dato6, dato7, dato8, dato9, dato10, dato11, dato12, dato13, dato14, dato15];
    var valorPost = JSON.stringify(vecData);

    $.ajax({
        type: "POST",
        url: "../controlador/frmEditar.php",
        data: "modDatosHotel=" + valorPost,
        dataType: "html",
        success: function (data) {
            var datos = JSON.parse(data);
            if (datos.resultado) {
                alertify.success("Datos actualizados correctamente ");                
                setTimeout(location.reload(), 3000);
            }
        },
        error: function (data) {
            alertify.error("ERROR. al procesar intente más tarde.");
        }
    });
}
