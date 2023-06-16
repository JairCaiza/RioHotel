
/* ===============================   FUNCIONES DE LA CONSULTA MEDICA   =============================== */
function borrarCIE10(consulta) {
    var vecData = [1, consulta];
    var valorPost = JSON.stringify(vecData);
    var addItem = '';
    $.ajax({
        type: "POST",
        url: "../controlador/frmEliminar.php",
        data: "delMedicina=" + valorPost,
        dataType: "html",
        success: function (data) {
            var datos = JSON.parse(data);
            if (datos.resultado) {
                $('#cmbConCIE').val().forEach(cie => ingresoCieVisita(5, cie, consulta));
            }
        },
        error: function (data) {
            alertify.error("ERROR. al procesar intente más tarde.");
        }
    });
}
function borrarSigCita(numSiguiente){
    alertify.confirm('Alerta', 'Está seguro que desea eliminar la cita seleccionada?', function() {
        cambiaEstMedico(7, numSiguiente, 'na', 'na', 'na', 'na', 'na', 'na', 'na', 'na')
    },
    function() {
        alertify.error('Operación cancelada')
    });
}
/* =============================   FIN FUNCIONES DE LA CONSULTA MEDICA   ============================= */