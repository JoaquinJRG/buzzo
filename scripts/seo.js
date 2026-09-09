
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
                // Top 10 por volumen de búsqueda
                const $tablaVolumen = $('#listadovolumenbusqueda tbody');
                const volumenData = response.volumenBusqueda || (response.data && response.data.volumenBusqueda) || [];
                const volumenKeywords = response.success && Array.isArray(volumenData)
                    ? volumenData.slice(0, 10)
                    : [];
                $tablaVolumen.empty();
                $('#listadovolumenbusquedaselec').text(volumenKeywords.length);
                $('#listadovolumenbusquedartotal').text(volumenKeywords.length);

                if (volumenKeywords.length > 0) {
                    volumenKeywords.forEach(function (item) {
                        $('<tr>').append(
                            $('<td>').text(item.keyword),
                            $('<td>').text(item.position),
                            $('<td>').text(item.volume),
                            $('<td>').text(item.traffic)
                        ).appendTo($tablaVolumen);
                    });
                } else {
                    $('<tr>').append(
                        $('<td>', {
                            colspan: 4,
                            class: 'text-center',
                            text: 'No hay datos de volumen de búsqueda disponibles'
                        })
                    ).appendTo($tablaVolumen);
                }

                // Top 10 por mejor posición
                const $tablaPosicion = $('#listadomejorposicion tbody');
                const posicionData = response.mejorPosicion || (response.data && response.data.mejorPosicion) || [];
                const posicionKeywords = response.success && Array.isArray(posicionData)
                    ? posicionData.slice(0, 10)
                    : [];
                $tablaPosicion.empty();
                $('#listadomejorposicionselec').text(posicionKeywords.length);
                $('#listadomejorposicionrtotal').text(posicionKeywords.length);

                if (posicionKeywords.length > 0) {
                    posicionKeywords.forEach(function (item) {
                        $('<tr>').append(
                            $('<td>').text(item.keyword),
                            $('<td>').text(item.position),
                            $('<td>').text(item.volume),
                            $('<td>').text(item.traffic)
                        ).appendTo($tablaPosicion);
                    });
                } else {
                    $('<tr>').append(
                        $('<td>', {
                            colspan: 4,
                            class: 'text-center',
                            text: 'No hay datos de mejor posición disponibles'
                        })
                    ).appendTo($tablaPosicion);
                }

                // Competencia
                const $tablaCompetencia = $('#listadocompetencia tbody');
                const competidoresData = response.competencia || (Array.isArray(response.data) ? response.data : (response.data && response.data.competencia)) || [];
                const competidores = response.success && Array.isArray(competidoresData)
                    ? competidoresData.slice(0, 10)
                    : [];
                $tablaCompetencia.empty();
                $('#listadocompetenciaselec').text(competidores.length);

                if (competidores.length > 0) {
                    competidores.forEach(function (competidor) {
                        $('<tr>').append(
                            $('<td>').text(competidor.domain),
                            $('<td>').text(competidor.keywords)
                        ).appendTo($tablaCompetencia);
                    });
                } else {
                    $('<tr>').append(
                        $('<td>', {
                            colspan: 2,
                            class: 'text-center',
                            text: 'No hay competidores disponibles'
                        })
                    ).appendTo($tablaCompetencia);
                }

                // Páginas con más tráfico (Top 10)
                const $tablaPaginas = $('#listadopaginas tbody');
                const paginasData = response.masTrafico || (response.data && response.data.masTrafico) || [];
                const paginas = response.success && Array.isArray(paginasData)
                    ? paginasData.slice(0, 10)
                    : [];
                $tablaPaginas.empty();
                $('#listadopaginasselec').text(paginas.length);
                $('#listadopaginastotal').text(paginas.length);

                if (paginas.length > 0) {
                    paginas.forEach(function (pagina) {
                        $('<tr>').append(
                            $('<td>').text(pagina.url || pagina.domain || ''),
                            $('<td>').text(pagina.traffic ?? 0)
                        ).appendTo($tablaPaginas);
                    });
                } else {
                    $('<tr>').append(
                        $('<td>', {
                            colspan: 2,
                            class: 'text-center',
                            text: 'No hay páginas disponibles'
                        })
                    ).appendTo($tablaPaginas);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error en la solicitud:', error);
                $('#listadovolumenbusqueda tbody').html(
                    '<tr><td colspan="4">Error al cargar el volumen de búsqueda</td></tr>'
                );
                $('#listadomejorposicion tbody').html(
                    '<tr><td colspan="4">Error al cargar la mejor posición</td></tr>'
                );
                $('#listadocompetencia tbody').html(
                    '<tr><td colspan="2">Error al cargar la competencia</td></tr>'
                );
                $('#listadopaginas tbody').html(
                    '<tr><td colspan="2">Error al cargar las páginas con más tráfico</td></tr>'
                );
            },
            complete: function () {
                $("#cargando").fadeOut("500");
            }
        });
    });
}


