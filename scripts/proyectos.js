let currentCompanyId = 'empresa_prueba_01';
let currentCompanyName = 'Empresa de Prueba';
let currentUserId = 'usuario_buzzo_01';

$('#cerrar_2').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_2').fadeOut();
});

$('#cerrar_2_1').click(function () {
    $('#fconte_2').fadeIn();
    $('#fconte_2_1').fadeOut();
});

$('#cerrar_2_2').click(function () {
    $('#fconte_2').fadeIn();
    $('#fconte_2_2').fadeOut();
});

$('#cerrar_2_3').click(function () {
    $('#fconte_2').fadeIn();
    $('#fconte_2_3').fadeOut();
});

$('#cerrar_2_4').click(function () {
    $('#fconte_2').fadeIn();
    $('#fconte_2_4').fadeOut();
});

$('#cerrar_2_5').click(function () {
    $('#fconte_2').fadeIn();
    $('#fconte_2_5').fadeOut();
});

$('#cerrar_2_6').click(function () {
    $('#fconte_2').fadeIn();
    $('#fconte_2_6').fadeOut();
});

function empresa(companyId = 'empresa_prueba_01', companyName = 'Empresa de Prueba') {
    currentCompanyId = companyId;
    currentCompanyName = companyName;

    $('.tituloempresa').text(companyName);
    $('.pperfilnombre').text(companyName);

    $('#cargando').fadeIn('500', function () {
        $('#fconte_1').hide();
        $('#fconte_2').show();
        $('#cargando').fadeOut('500');
    });
}

// 1. PROYECTOS
function proyectos() {
    $('#cargando').fadeIn('300', function () {
        $('#fconte_2').hide();
        $('#fconte_2_1').show();
        cargarProyectos();
    });
}

function cargarProyectos() {
    $.ajax({
        url: 'scripts/proyectos/proyectos.php',
        method: 'GET',
        data: {
            company_id: currentCompanyId,
            user_id: currentUserId
        },
        dataType: 'json',
        success: function (res) {
            const $lista = $('#listadoproyectos');
            $lista.empty();
            const items = (res.success && Array.isArray(res.data)) ? res.data : [];

            if (items.length > 0) {
                items.forEach(function (p) {
                    const status = p.status || 'draft';
                    const $tarjeta = $('<article>', {
                        class: 'proyecto-tarjeta'
                    });

                    $('<div>', { class: 'proyecto-identificador' })
                        .text(p.code || p.public_id || '-')
                        .appendTo($tarjeta);

                    $('<div>', { class: 'proyecto-datos' }).append(
                        $('<h3>', { class: 'proyecto-nombre' }).text(p.name || '-'),
                        $('<p>', { class: 'proyecto-descripcion' }).text(p.description || 'Sin descripción')
                    ).appendTo($tarjeta);

                    $('<div>', { class: 'proyecto-meta' }).append(
                        $('<span>', {
                            class: 'proyecto-estado ' + (status === 'active' ? 'proyecto-estado-activo' : '')
                        }).text(status),
                        $('<time>', {
                            class: 'proyecto-fecha',
                            datetime: p.created_at || ''
                        }).text(p.created_at ? p.created_at.substring(0, 10) : '-')
                    ).appendTo($tarjeta);

                    $tarjeta.appendTo($lista);
                });
            } else {
                $('<div>', {
                    class: 'proyectos-mensaje',
                    text: 'No hay proyectos registrados para esta empresa.'
                }).appendTo($lista);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error cargando proyectos:', error);
            $('#listadoproyectos').empty().append(
                $('<div>', {
                    class: 'proyectos-mensaje proyectos-mensaje-error',
                    text: 'Error al cargar proyectos.'
                })
            );
        },
        complete: function () {
            $('#cargando').fadeOut('300');
        }
    });
}

// 2. PARTES (WORK REPORTS)
function partes() {
    $('#cargando').fadeIn('300', function () {
        $('#fconte_2').hide();
        $('#fconte_2_2').show();
        cargarPartes();
    });
}

function cargarPartes() {
    $.ajax({
        url: 'scripts/proyectos/partes.php',
        method: 'GET',
        data: {
            company_id: currentCompanyId,
            user_id: currentUserId
        },
        dataType: 'json',
        success: function (res) {
            const $tabla = $('#listadopartes');
            $tabla.empty();

            $('<thead>').append(
                $('<tr>').append(
                    $('<th>').text('Código / ID'),
                    $('<th>').text('Proyecto'),
                    $('<th>').text('Operario'),
                    $('<th>').text('Estado'),
                    $('<th>').text('Fecha')
                )
            ).appendTo($tabla);

            const $tbody = $('<tbody>').appendTo($tabla);
            const items = (res.success && Array.isArray(res.data)) ? res.data : [];

            if (items.length > 0) {
                items.forEach(function (wr) {
                    $('<tr>').append(
                        $('<td>').css('font-weight', 'bold').text(wr.code || wr.public_id),
                        $('<td>').text(wr.project_name || wr.project_public_id || '-'),
                        $('<td>').text(wr.worker_name || wr.worker_profile_public_id || '-'),
                        $('<td>').text(wr.status || '-'),
                        $('<td>').text(wr.created_at ? wr.created_at.substring(0, 10) : '-')
                    ).appendTo($tbody);
                });
            } else {
                $('<tr>').append(
                    $('<td>', { colspan: 5, class: 'text-center', text: 'No hay partes de trabajo registrados para esta empresa.' })
                ).appendTo($tbody);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error cargando partes:', error);
            $('#listadopartes').html('<tr><td colspan="5" style="text-align:center; color:#c00;">Error al cargar partes de trabajo.</td></tr>');
        },
        complete: function () {
            $('#cargando').fadeOut('300');
        }
    });
}

// 3. CLIENTES
function clientes() {
    $('#cargando').fadeIn('300', function () {
        $('#fconte_2').hide();
        $('#fconte_2_3').show();
        cargarClientes();
    });
}

function cargarClientes() {
    $.ajax({
        url: 'scripts/proyectos/clientes.php',
        method: 'GET',
        data: {
            company_id: currentCompanyId,
            user_id: currentUserId
        },
        dataType: 'json',
        success: function (res) {
            const $tabla = $('#listadotraclientes');
            $tabla.empty();

            $('<thead>').append(
                $('<tr>').append(
                    $('<th>').text('Nombre'),
                    $('<th>').text('CIF / NIF'),
                    $('<th>').text('Email'),
                    $('<th>').text('Teléfono'),
                    $('<th>').text('Ciudad'),
                    $('<th>').text('Estado')
                )
            ).appendTo($tabla);

            const $tbody = $('<tbody>').appendTo($tabla);
            const items = (res.success && Array.isArray(res.data)) ? res.data : [];

            if (items.length > 0) {
                items.forEach(function (c) {
                    $('<tr>').append(
                        $('<td>').css('font-weight', 'bold').text(c.name || '-'),
                        $('<td>').text(c.tax_id || '-'),
                        $('<td>').text(c.email || '-'),
                        $('<td>').text(c.phone || '-'),
                        $('<td>').text(c.city || '-'),
                        $('<td>').text(c.status || '-')
                    ).appendTo($tbody);
                });
            } else {
                $('<tr>').append(
                    $('<td>', { colspan: 6, class: 'text-center', text: 'No hay clientes registrados para esta empresa.' })
                ).appendTo($tbody);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error cargando clientes:', error);
            $('#listadotraclientes').html('<tr><td colspan="6" style="text-align:center; color:#c00;">Error al cargar clientes.</td></tr>');
        },
        complete: function () {
            $('#cargando').fadeOut('300');
        }
    });
}

// 4. PLANIFICADOR
function planificador() {
    $('#cargando').fadeIn('300', function () {
        $('#fconte_2').hide();
        $('#fconte_2_4').show();
        cargarPlanificador();
    });
}

function cargarPlanificador() {
    $.ajax({
        url: 'scripts/proyectos/planificador.php',
        method: 'GET',
        data: {
            company_id: currentCompanyId,
            user_id: currentUserId
        },
        dataType: 'json',
        success: function (res) {
            const $tabla = $('#listadoplanificador');
            $tabla.empty();

            $('<thead>').append(
                $('<tr>').append(
                    $('<th>').text('Tipo'),
                    $('<th>').text('Inicio'),
                    $('<th>').text('Fin'),
                    $('<th>').text('Estado'),
                    $('<th>').text('Notas')
                )
            ).appendTo($tabla);

            const $tbody = $('<tbody>').appendTo($tabla);
            const items = (res.success && Array.isArray(res.data)) ? res.data : [];

            if (items.length > 0) {
                items.forEach(function (pl) {
                    $('<tr>').append(
                        $('<td>').css('font-weight', 'bold').text(pl.type || '-'),
                        $('<td>').text(pl.start_at ? pl.start_at.substring(0, 16).replace('T', ' ') : '-'),
                        $('<td>').text(pl.end_at ? pl.end_at.substring(0, 16).replace('T', ' ') : '-'),
                        $('<td>').text(pl.status || '-'),
                        $('<td>').text(pl.notes || '-')
                    ).appendTo($tbody);
                });
            } else {
                $('<tr>').append(
                    $('<td>', { colspan: 5, class: 'text-center', text: 'No hay planificaciones registradas para esta empresa.' })
                ).appendTo($tbody);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error cargando planificador:', error);
            $('#listadoplanificador').html('<tr><td colspan="5" style="text-align:center; color:#c00;">Error al cargar planificaciones.</td></tr>');
        },
        complete: function () {
            $('#cargando').fadeOut('300');
        }
    });
}

// 5. HISTORIAL
function historial() {
    $('#cargando').fadeIn('300', function () {
        $('#fconte_2').hide();
        $('#fconte_2_5').show();
        cargarHistorial();
    });
}

function cargarHistorial() {
    $.ajax({
        url: 'scripts/proyectos/historial.php',
        method: 'GET',
        data: {
            company_id: currentCompanyId,
            user_id: currentUserId
        },
        dataType: 'json',
        success: function (res) {
            const $tabla = $('#listadohistorial');
            $tabla.empty();

            $('<thead>').append(
                $('<tr>').append(
                    $('<th>').text('Concepto'),
                    $('<th>').text('Proyecto / Operario'),
                    $('<th>').text('Horas Totales'),
                    $('<th>').text('Período')
                )
            ).appendTo($tabla);

            const $tbody = $('<tbody>').appendTo($tabla);
            const hoursByProject = (res.success && res.data && Array.isArray(res.data.hours_by_project)) ? res.data.hours_by_project : [];
            const hoursByWorker = (res.success && res.data && Array.isArray(res.data.hours_by_worker)) ? res.data.hours_by_worker : [];
            const periodo = (res.data && res.data.from && res.data.to) ? (res.data.from.substring(0, 10) + ' a ' + res.data.to.substring(0, 10)) : '-';

            let count = 0;
            if (hoursByProject.length > 0) {
                hoursByProject.forEach(function (item) {
                    count++;
                    $('<tr>').append(
                        $('<td>').css('font-weight', 'bold').text('Horas Proyecto'),
                        $('<td>').text(item.project_name || item.project_public_id || '-'),
                        $('<td>').text(item.total_hours != null ? item.total_hours + ' h' : '-'),
                        $('<td>').text(periodo)
                    ).appendTo($tbody);
                });
            }

            if (hoursByWorker.length > 0) {
                hoursByWorker.forEach(function (item) {
                    count++;
                    $('<tr>').append(
                        $('<td>').css('font-weight', 'bold').text('Horas Operario'),
                        $('<td>').text(item.worker_name || item.worker_profile_public_id || '-'),
                        $('<td>').text(item.total_hours != null ? item.total_hours + ' h' : '-'),
                        $('<td>').text(periodo)
                    ).appendTo($tbody);
                });
            }

            if (count === 0) {
                $('<tr>').append(
                    $('<td>', { colspan: 4, class: 'text-center', text: 'No hay registros históricos de horas para el período actual.' })
                ).appendTo($tbody);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error cargando historial:', error);
            $('#listadohistorial').html('<tr><td colspan="4" style="text-align:center; color:#c00;">Error al cargar el historial.</td></tr>');
        },
        complete: function () {
            $('#cargando').fadeOut('300');
        }
    });
}

// 6. AVISOS
function avisos() {
    $('#cargando').fadeIn('300', function () {
        $('#fconte_2').hide();
        $('#fconte_2_6').show();
        cargarAvisos();
    });
}

function cargarAvisos() {
    $.ajax({
        url: 'scripts/proyectos/avisos.php',
        method: 'GET',
        data: {
            company_id: currentCompanyId,
            user_id: currentUserId
        },
        dataType: 'json',
        success: function (res) {
            const $tabla = $('#listadoavisos');
            $tabla.empty();

            $('<thead>').append(
                $('<tr>').append(
                    $('<th>').text('Código'),
                    $('<th>').text('Título'),
                    $('<th>').text('Descripción'),
                    $('<th>').text('Prioridad'),
                    $('<th>').text('Estado'),
                    $('<th>').text('Fecha')
                )
            ).appendTo($tabla);

            const $tbody = $('<tbody>').appendTo($tabla);
            const items = (res.success && Array.isArray(res.data)) ? res.data : [];

            if (items.length > 0) {
                items.forEach(function (av) {
                    let prioColor = '#333';
                    if (av.priority === 'urgent' || av.priority === 'high') prioColor = '#e74c3c';
                    else if (av.priority === 'normal') prioColor = '#f39c12';
                    else if (av.priority === 'low') prioColor = '#27ae60';

                    $('<tr>').append(
                        $('<td>').css('font-weight', 'bold').text(av.code || av.public_id),
                        $('<td>').text(av.title || '-'),
                        $('<td>').text(av.description || '-'),
                        $('<td>').append(
                            $('<span>')
                                .css({ 'color': prioColor, 'font-weight': 'bold', 'text-transform': 'uppercase' })
                                .text(av.priority || 'normal')
                        ),
                        $('<td>').text(av.status || 'pending'),
                        $('<td>').text(av.created_at ? av.created_at.substring(0, 10) : '-')
                    ).appendTo($tbody);
                });
            } else {
                $('<tr>').append(
                    $('<td>', { colspan: 6, class: 'text-center', text: 'No hay avisos registrados para esta empresa.' })
                ).appendTo($tbody);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error cargando avisos:', error);
            $('#listadoavisos').html('<tr><td colspan="6" style="text-align:center; color:#c00;">Error al cargar avisos.</td></tr>');
        },
        complete: function () {
            $('#cargando').fadeOut('300');
        }
    });
}