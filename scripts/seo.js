
$('#cerrar_1_1').click(function () {
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

    });
}

function seopalabras() {
    $("#cargando").fadeIn("500", function () {
        $("#fconte_1").hide();
        $("#fconte_1_2").show();

        $.ajax({
            url: 'scripts/datosSeo.php',
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                const $tabla = $('#listadocompetencia tbody');
                const competidores = response.success && Array.isArray(response.data)
                    ? response.data.slice(0, 10)
                    : [];
                $tabla.empty();
                $('#listadocompetenciaselec').text(competidores.length);

                if (competidores.length > 0) {
                    competidores.forEach(function (competidor) {
                        $('<tr>').append(
                            $('<td>').text(competidor.domain),
                            $('<td>').text(competidor.keywords)
                        ).appendTo($tabla);
                    });
                } else {
                    $('<tr>').append(
                        $('<td>', {
                            colspan: 2,
                            class: 'text-center',
                            text: 'No hay competidores disponibles'
                        })
                    ).appendTo($tabla);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                $('#listadocompetencia tbody').html(
                    '<tr><td colspan="2" class="text-danger">Error al cargar la competencia</td></tr>'
                );
            },
            complete: function () {
                $("#cargando").fadeOut("500");
            }
        });
    });
}


