
$('#cerrar_1_1').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_1_1').fadeOut();
});

$('#cerrar_1_2').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_1_2').fadeOut();
});


// Caché en JavaScript para datos SEO
const cacheSeoPalabras = {};
const cacheSeoHistorico = {};

function obtenerCacheSeo(domain) {
    if (cacheSeoPalabras[domain]) {
        return cacheSeoPalabras[domain];
    }
    try {
        const stored = sessionStorage.getItem('seo_cache_' + domain);
        if (stored) {
            const parsed = JSON.parse(stored);
            cacheSeoPalabras[domain] = parsed;
            return parsed;
        }
    } catch (e) {
        // En caso de que sessionStorage no esté accesible
    }
    return null;
}

function guardarCacheSeo(domain, data) {
    cacheSeoPalabras[domain] = data;
    try {
        sessionStorage.setItem('seo_cache_' + domain, JSON.stringify(data));
    } catch (e) {
        // Ignorar si el almacenamiento está restringido
    }
}

function obtenerCacheHistorico(domain) {
    if (cacheSeoHistorico[domain]) {
        return cacheSeoHistorico[domain];
    }
    try {
        const stored = sessionStorage.getItem('seo_historico_cache_' + domain);
        if (stored) {
            const parsed = JSON.parse(stored);
            cacheSeoHistorico[domain] = parsed;
            return parsed;
        }
    } catch (e) {
        // En caso de que sessionStorage no esté accesible
    }
    return null;
}

function guardarCacheHistorico(domain, data) {
    cacheSeoHistorico[domain] = data;
    try {
        sessionStorage.setItem('seo_historico_cache_' + domain, JSON.stringify(data));
    } catch (e) {
        // Ignorar si el almacenamiento está restringido
    }
}

function pintarTablasSeo(response) {
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
}

function pintarGraficosSeo(response) {

    Chart.defaults.color = '#000';
    Chart.defaults.backgroundColor = 'rgba(10,141,255,1)';
    Chart.defaults.font.size = 10;
    Chart.defaults.plugins.legend.position = 'bottom';

    // Top 10 por volumen de búsqueda
    const graficoVolumen = $('#graficoVolumenBusqueda');

    new Chart(
        graficoVolumen,
        {
            type: 'bar',
            data: {
                labels: response.volumenBusqueda ? response.volumenBusqueda.map(item => item.keyword) : [],
                datasets: [
                    {
                        label: 'Volumen de Búsqueda',
                        data: response.volumenBusqueda ? response.volumenBusqueda.map(item => item.volume) : [],
                    }
                ]
            },
            options: {
                indexAxis: "y",
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                layout: {
                    padding: 8
                },
                scales: {
                    x: {
                        ticks: { font: { size: 9 } }
                    },
                    y: {
                        ticks: { font: { size: 9 } }
                    }
                }
            }
        }
    );

    // Distribución del ranking orgánico
    const graficoDistribucion = $('#graficoOrganico');

    new Chart(
        graficoDistribucion,
        {
            type: 'bar',
            data: {
                labels: response.organico ? ['Top 1-5', 'Top 6-10', 'Top 11-20', 'Top 21-50', 'Top 51-100'] : [],
                datasets: [
                    {
                        label: 'Distribución del Ranking Orgánico',
                        data: response.organico ? [
                            response.organico.top1_5 || 0,
                            response.organico.top6_10 || 0,
                            response.organico.top11_20 || 0,
                            response.organico.top21_50 || 0,
                            response.organico.top51_100 || 0
                        ] : [],
                    }
                ]
            },
            options: {
                indexAxis: "x",
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                layout: {
                    padding: 8
                },
                scales: {
                    x: {
                        ticks: { font: { size: 9 } }
                    },
                    y: {
                        ticks: { font: { size: 9 } }
                    }
                }
            }
        }
    );

    // Top keywords por tráfico
    const graficoTrafico = $('#graficoTrafico');

    new Chart(
        graficoTrafico,
        {
            type: 'bar',
            data: {
                labels: response.keyTrafico ? response.keyTrafico.map(item => item.keyword) : [],
                datasets: [
                    {
                        label: 'Top Keywords por Tráfico',
                        data: response.keyTrafico ? response.keyTrafico.map(item => item.traffic) : [],
                    }
                ]
            },
            options: {
                indexAxis: "y",
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                layout: {
                    padding: 8
                },
                scales: {
                    x: {
                        ticks: { font: { size: 9 } }
                    },
                    y: {
                        ticks: { font: { size: 9 } }
                    }
                }
            }
        }
    );

    // Competencia (KW comunes)
    const graficoCompetencia = $('#graficoCompetencia');

    new Chart(
        graficoCompetencia,
        {
            type: 'bar',
            data: {
                labels: response.competencia ? response.competencia.map(item => item.domain) : [],
                datasets: [
                    {
                        label: 'Competencia (KW comunes)',
                        data: response.competencia ? response.competencia.map(item => item.keywords) : [],
                    }
                ]
            },
            options: {
                indexAxis: "x",
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                layout: {
                    padding: 8
                },
                scales: {
                    x: {
                        ticks: { font: { size: 9 } }
                    },
                    y: {
                        ticks: { font: { size: 9 } }
                    }
                }
            }
        }
    );

}

function seopalabras(domain = "https://cafeteatrocentral.es") {
    // 1. Comprobar si ya existen datos guardados en caché para este dominio
    const datosEnCache = obtenerCacheSeo(domain);
    if (datosEnCache) {
        $("#fconte_1").hide();
        $("#fconte_1_1").show();
        pintarTablasSeo(datosEnCache);
        pintarGraficosSeo(datosEnCache);
        return;
    }

    // 2. Si no hay nada en caché, solicitar a la API
    $("#cargando").fadeIn("500", function () {
        $("#fconte_1").hide();
        $("#fconte_1_1").show();

        $.ajax({
            url: 'scripts/datosSeo.php',
            method: 'GET',
            data: {
                domain: domain
            },
            dataType: 'json',
            success: function (response) {
                if (response && response.success) {
                    // Guardar en caché para futuras consultas
                    guardarCacheSeo(domain, response);
                }
                pintarTablasSeo(response);
                pintarGraficosSeo(response);
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

let graficoHistorico;
let datosHistoricoActual = null;
let metricaHistorico = 'traffic_sum';
let mesesHistorico = 0;

function pintarResumenHistorico(response) {
    const autoridad = response && response.backLinkAuthority;
    const paginasAutoridad = autoridad && Array.isArray(autoridad.pages)
        ? autoridad.pages[0]
        : null;
    const resumen = response && response.backLinkSummary;
    const datosBacklinks = resumen && Array.isArray(resumen.summary)
        ? resumen.summary[0]
        : null;
    const overview = response && response.datosOverview;
    const datosOrganico = overview && overview.organic;
    const datosPago = overview && (overview.adv || overview.paid || overview.pago);
    const obtenerMetrica = (datos, nombres) => {
        if (!datos || typeof datos !== 'object') return null;
        for (const nombre of nombres) {
            if (datos[nombre] != null) return datos[nombre];
        }
        return null;
    };
    const formatearNumero = (valor, moneda = false) => {
        if (valor == null || valor === '') return '—';
        const numero = Number(valor);
        if (!Number.isFinite(numero)) return String(valor);
        const texto = new Intl.NumberFormat('es-ES', {
            notation: 'compact',
            maximumFractionDigits: 1
        }).format(numero);
        return moneda ? `€${texto}` : texto;
    };

    $('#historicoDomainTrust').text(
        paginasAutoridad && paginasAutoridad.domain_inlink_rank != null
            ? paginasAutoridad.domain_inlink_rank
            : '—'
    );
    $('#historicoPageTrust').text(
        paginasAutoridad && paginasAutoridad.inlink_rank != null
            ? paginasAutoridad.inlink_rank
            : '—'
    );
    $('#historicoRefdomains').text(
        datosBacklinks && datosBacklinks.refdomains != null
            ? datosBacklinks.refdomains
            : '—'
    );
    $('#historicoBacklinks').text(
        datosBacklinks && datosBacklinks.backlinks != null
            ? datosBacklinks.backlinks
            : '—'
    );
    $('#historicoOrganicoTraffic').text(formatearNumero(
        obtenerMetrica(datosOrganico, ['traffic_sum', 'traffic'])
    ));
    $('#historicoOrganicoKeywords').text(formatearNumero(
        obtenerMetrica(datosOrganico, ['keywords_count', 'keywords'])
    ));
    $('#historicoOrganicoPrice').text(formatearNumero(
        obtenerMetrica(datosOrganico, ['price_sum', 'price']),
        true
    ));
    $('#historicoPagoTraffic').text(formatearNumero(
        obtenerMetrica(datosPago, ['traffic_sum', 'traffic'])
    ));
    $('#historicoPagoKeywords').text(formatearNumero(
        obtenerMetrica(datosPago, ['keywords_count', 'keywords'])
    ));
    $('#historicoPagoPrice').text(formatearNumero(
        obtenerMetrica(datosPago, ['price_sum', 'price']),
        true
    ));
}

function pintarGraficosHistorico(response) {
    console.log('Datos históricos recibidos:', response);
    response = response || {};
    pintarResumenHistorico(response);
    const organico = Array.isArray(response.historicoOrganico) ? response.historicoOrganico : [];
    const pago = Array.isArray(response.historicoPago) ? response.historicoPago : [];
    const registros = new Map();

    const agregarRegistros = (fuente, historico) => historico.forEach(item => {
        const clave = `${item.year}-${String(item.month).padStart(2, '0')}`;
        if (!registros.has(clave)) {
            registros.set(clave, { year: item.year, month: item.month, organico: null, pago: null });
        }
        registros.get(clave)[fuente] = item;
    });
    agregarRegistros('organico', organico);
    agregarRegistros('pago', pago);

    datosHistoricoActual = [...registros.values()].sort((a, b) => (
        a.year - b.year || a.month - b.month
    ));
    actualizarGraficoHistorico();
}

function actualizarGraficoHistorico() {
    if (!datosHistoricoActual) return;

    const datos = mesesHistorico
        ? datosHistoricoActual.slice(-mesesHistorico)
        : datosHistoricoActual;
    const nombresMeses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
    const labels = datos.map(item => `${nombresMeses[item.month - 1] || item.month} ${item.year}`);
    const valores = (fuente) => datos.map(item => item[fuente] ? Number(item[fuente][metricaHistorico] || 0) : null);

    if (graficoHistorico) graficoHistorico.destroy();
    graficoHistorico = new Chart(document.getElementById('graficoHistorico'), {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Orgánico',
                    data: valores('organico'),
                    borderColor: '#488dff',
                    backgroundColor: '#488dff',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#488dff',
                    pointRadius: 3,
                    borderWidth: 2,
                    tension: 0.25,
                    spanGaps: true
                },
                {
                    label: 'De pago',
                    data: valores('pago'),
                    borderColor: '#8957f5',
                    backgroundColor: '#8957f5',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#8957f5',
                    pointRadius: 3,
                    borderWidth: 2,
                    tension: 0.25,
                    spanGaps: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(115, 137, 165, 0.25)' } },
                x: { grid: { color: 'rgba(115, 137, 165, 0.25)' } }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, pointStyle: 'circle', padding: 18 }
                }
            }
        }
    });
}

$(document).on('click', '.historico-metrica', function () {
    $('.historico-metrica').removeClass('activa').attr('aria-selected', 'false');
    $(this).addClass('activa').attr('aria-selected', 'true');
    metricaHistorico = $(this).data('metrica');
    actualizarGraficoHistorico();
});

$(document).on('click', '.historico-periodo', function () {
    $('.historico-periodo').removeClass('activa');
    $(this).addClass('activa');
    mesesHistorico = Number($(this).data('meses'));
    actualizarGraficoHistorico();
});

function seohistorico(domain = "https://cafeteatrocentral.es") {
    const datosEnCache = obtenerCacheHistorico(domain);
    if (datosEnCache) {
        $("#fconte_1").hide();
        $("#fconte_1_2").show();
        pintarGraficosHistorico(datosEnCache);
        return;
    }

    $("#cargando").fadeIn("500", function () {
        $("#fconte_1").hide();
        $("#fconte_1_2").show();

        $.ajax({
            url: 'scripts/historicoSeo.php',
            method: 'GET',
            data: {
                domain: domain
            },
            dataType: 'json',
            success: function (response) {
                if (response && response.success) {
                    guardarCacheHistorico(domain, response);
                    pintarGraficosHistorico(response);
                    return;
                }

                const mensaje = response && response.error
                    ? response.error
                    : 'Error al cargar el histórico SEO';
                console.error(mensaje);
                $('#graficoHistorico').replaceWith(
                    $('<div>', {
                        id: 'graficoHistorico',
                        class: 'text-center',
                        text: mensaje
                    })
                );
            },
            error: function (xhr, status, error) {
                let mensaje = 'Error al cargar el histórico SEO';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    mensaje += ': ' + xhr.responseJSON.error;
                }
                console.error(mensaje, error);
                $('#graficoHistorico').replaceWith(
                    $('<div>', {
                        id: 'graficoHistorico',
                        class: 'text-center',
                        text: mensaje
                    })
                );
            },
            complete: function () {
                $("#cargando").fadeOut("500");
            }
        });
    });
}
