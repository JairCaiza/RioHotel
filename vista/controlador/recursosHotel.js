var formato64 = '';
var vecLetra = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']


/* ===============================   FUNCION BASE 64   =============================== */
function getArchivoBase64(archivoBase, objImg) {
    var reader = new FileReader();
    reader.readAsDataURL(document.getElementById(archivoBase).files[0]);
    reader.onload = function () {
        formato64 = reader.result;
        document.getElementById(objImg).src = formato64;
    };
    reader.onerror = function (error) {
        console.log('Error: ', error);
        formato64 = '';
    };
}
/* =============================   FIN FUNCION BASE 64   ============================= */

function instanciaTabla(nombTabla) {
    $(nombTabla).DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo(nombTabla + '_wrapper .col-md-6:eq(0)');
}

function verNumeroQR(idCon) {
    var num = 0;
    var numRec = 0;
    for (contVec = (idCon.split('B').length - 2); contVec >= 0; contVec--) {
        var val1 = idCon.split('B')[contVec].split('A')[0];
        var val2 = vecLetra.indexOf(idCon.split('B')[contVec].split('A')[1][0]);
        var val3 = vecLetra.indexOf(idCon.split('B')[contVec].split('A')[1][1]);

        num = (val1 - val2) + val3;
        numRec = (numRec * 10) + num;
    }
    return (numRec);
}