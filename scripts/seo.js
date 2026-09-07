
$('#cerrar_1_1').click(function () {
    console.log("cerrar_1_1 clicked");
    $('#fconte_1').fadeIn();
    $('#fconte_1_1').fadeOut();
});

$('#cerrar_1_2').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_1_2').fadeOut();
});

function seoestadisticas() {
    $("#cargando").fadeIn("500", function () {
        $("#fconte_1").hide();
        $("#fconte_1_1").show();
        $("#cargando").fadeOut("500");
        /*
        $.ajax({
            url: '',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                $("#fconte_1").hide();
                $("#fconte_1_1").show();
                if (response.success && response.data.items && response.data.items.length > 0) {
                    renderAlbaranes(response.data.items);
                } else {
                    $('#albaranesTable tbody').html('<tr><td colspan="6" class="text-center">No hay albaranes disponibles</td></tr>');
                }
            
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                $('#albaranesTable tbody').html('<tr><td colspan="6" class="text-danger">Error al cargar albaranes</td></tr>');
            },
            complete: function () {
                $("#cargando").fadeOut("500");
            }
        });
        */
    });
}
function seopalabras() {
    $("#cargando").fadeIn("500", function () {
        $("#fconte_1").hide();
        $("#fconte_1_2").show();
        $("#cargando").fadeOut("500");
        /*
        $.ajax({
            url: '',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                $("#fconte_1").hide();
                $("#fconte_1_1").show();
                if (response.success && response.data.items && response.data.items.length > 0) {
                    renderAlbaranes(response.data.items);
                } else {
                    $('#albaranesTable tbody').html('<tr><td colspan="6" class="text-center">No hay albaranes disponibles</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                $('#albaranesTable tbody').html('<tr><td colspan="6" class="text-danger">Error al cargar albaranes</td></tr>');
            },
            complete: function () {
                $("#cargando").fadeOut("500");
            }
        });
        */
    });
}

function appi(cif) {


}


