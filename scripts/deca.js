
// Botones de cierre
$('#cerrar_1_1').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_1_1').fadeOut();
});

$('#cerrar_1_2').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_1_2').fadeOut();
});

$('#cerrar_1_3').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_1_3').fadeOut();
});

$('#cerrar_1_4').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_1_4').fadeOut();
});

$('#cerrar_1_4_1').click(function () {
    $('#fconte_1_4').fadeIn();
    $('#fconte_1_4_1').fadeOut();
});

$('#cerrar_1_4_2').click(function () {
    $('#fconte_1_4').fadeIn();
    $('#fconte_1_4_2').fadeOut();
});

$('#cerrar_1_4_3, #cerrar_1_4_4, #cerrar_1_4_5, #cerrar_1_4_6').click(function () {
    var seccion = $(this).attr('id').replace('cerrar_', 'fconte_');
    $('#fconte_1_4').fadeIn();
    $('#' + seccion).fadeOut();
});

// Confiurar calendarios
$.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    prevText: '< Ant',
    nextText: 'Sig >',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['es']);

$('#decafecha, #empresalogsdesde, #empresalogshasta').datepicker({
    changeMonth: true,
    changeYear: true
});

// Añadir más envios al formulario
$('#decaaddenvio').click(function () {
    var $ultimoEnvio = $('#formularioemisiondeca fieldset[id^="deca-envio-"]').last();
    var numeroEnvio = $('#formularioemisiondeca fieldset[id^="deca-envio-"]').length + 1;
    var $nuevoEnvio = $ultimoEnvio.clone();

    $nuevoEnvio.attr('id', 'deca-envio-' + numeroEnvio);
    $nuevoEnvio.find('legend').text('Envío ' + numeroEnvio);

    $nuevoEnvio.find('[id]').each(function () {
        var id = $(this).attr('id');
        $(this).attr('id', id + '-' + numeroEnvio);
    });

    $nuevoEnvio.find('label[for]').each(function () {
        var forId = $(this).attr('for');
        $(this).attr('for', forId + '-' + numeroEnvio);
    });

    $nuevoEnvio.find('[name]').each(function () {
        var name = $(this).attr('name');
        $(this).attr('name', name + '_' + numeroEnvio);
    });

    $nuevoEnvio.find('.hasDatepicker').removeClass('hasDatepicker');
    $nuevoEnvio.insertBefore($('#formularioemisiondeca .botones'));

    $nuevoEnvio.find('input, select').val('');
    $nuevoEnvio.find('input[id^="decafecha-"]').datepicker({
        changeMonth: true,
        changeYear: true
    });
});


function emitirDeca() {
    $("#fconte_1").hide();
    $("#fconte_1_1").show();
    cargarDatosEmisionAgenda();
}

function misDeca() {
    $("#fconte_1").hide();
    $("#fconte_1_2").show();
}

function decaTerceros() {
    $("#fconte_1").hide();
    $("#fconte_1_3").show();
}

function miAgenda() {
    $("#fconte_1").hide();
    $("#fconte_1_4").show();
    cargarAgenda('counterparts');
}

var agendaAction = 'counterparts';
var datosEmisionAgenda = {
    counterparts: [],
    addresses: [],
    vehicles: [],
    drivers: [],
    authorizations: []
};

function agendaRequest(action, data) {
    return $.ajax({
        url: 'scripts/deca/agenda.php',
        method: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        data: JSON.stringify({ action: action, data: data || {} })
    });
}

function cargarDatosEmisionAgenda() {
    ['counterparts', 'addresses', 'vehicles', 'drivers', 'authorizations'].forEach(function (categoria) {
        agendaRequest(categoria).done(function (response) {
            if (response.success && Array.isArray(response.data)) {
                datosEmisionAgenda[categoria] = response.data;
                poblarSelectoresEmision();
            }
        });
    });
}

function añadirOpciones($select, items, texto) {
    $select.find('option:not(:first)').remove();
    items.forEach(function (item) {
        $('<option></option>').val(item.public_id).text(texto(item)).appendTo($select);
    });
}

function poblarSelectoresEmision() {
    var contrapartes = datosEmisionAgenda.counterparts;
    añadirOpciones($('#decacargadoragenda'), contrapartes.filter(function (item) {
        return item.roles.indexOf('shipper') !== -1;
    }), function (item) { return item.name + ' (' + item.tax_id + ')'; });
    añadirOpciones($('#decatransportistaagenda'), contrapartes.filter(function (item) {
        return item.roles.indexOf('carrier') !== -1;
    }), function (item) { return item.name + ' (' + item.tax_id + ')'; });
    añadirOpciones($('#decaconductoragenda'), datosEmisionAgenda.drivers, function (item) {
        return item.name + ' (' + item.phone + ')';
    });
    añadirOpciones($('#decaorigenagenda, #decadestinoagenda'), datosEmisionAgenda.addresses, function (item) {
        return (item.alias || item.company_name || item.street) + ' — ' + item.locality;
    });
    añadirOpciones($('#decatractoragenda'), datosEmisionAgenda.vehicles.filter(function (item) {
        return item.vehicle_type === 'tractor';
    }), function (item) { return item.plate; });
    añadirOpciones($('#decaremolqueagenda'), datosEmisionAgenda.vehicles.filter(function (item) {
        return item.vehicle_type === 'trailer';
    }), function (item) { return item.plate; });
    añadirOpciones($('#decaautorizacionagenda'), datosEmisionAgenda.authorizations, function (item) {
        return item.name + ': ' + item.code;
    });
}

function buscarDatoAgenda(categoria, publicId) {
    return datosEmisionAgenda[categoria].find(function (item) {
        return item.public_id === publicId;
    });
}

function completarContraparte(selector, prefijo) {
    var item = buscarDatoAgenda('counterparts', $(selector).val());
    if (!item) return;
    $('#' + prefijo + 'nombre').val(item.name || '');
    $('#' + prefijo + 'nif').val(item.tax_id || '');
    $('#' + prefijo + 'via').val(item.street || '');
    $('#' + prefijo + 'localidad').val(item.locality || '');
    $('#' + prefijo + 'provincia').val(item.province || '');
    $('#' + prefijo + 'cp').val(item.postal_code || '');
    $('#' + prefijo + 'email').val(item.email || '');
}

function completarDireccion(selector, prefijo) {
    var item = buscarDatoAgenda('addresses', $(selector).val());
    if (!item) return;
    $('#' + prefijo + 'empresa').val(item.company_name || '');
    $('#' + prefijo + 'via').val(item.street || '');
    $('#' + prefijo + 'localidad').val(item.locality || '');
    $('#' + prefijo + 'provincia').val(item.province || '');
    $('#' + prefijo + 'cp').val(item.postal_code || '');
}

$('#decacargadoragenda').change(function () { completarContraparte(this, 'decacargador'); });
$('#decatransportistaagenda').change(function () { completarContraparte(this, 'decatransportista'); });
$('#decaconductoragenda').change(function () {
    var item = buscarDatoAgenda('drivers', $(this).val());
    if (item) {
        $('#decaconductornombre').val(item.name || '');
        $('#decaconductortelefono').val(item.phone || '');
    }
});
$('#decaorigenagenda').change(function () { completarDireccion(this, 'decaorigen'); });
$('#decadestinoagenda').change(function () { completarDireccion(this, 'decadestino'); });
$('#decatractoragenda').change(function () {
    var item = buscarDatoAgenda('vehicles', $(this).val());
    if (item) $('#decamatriculatractor').val(item.plate || '');
});
$('#decaremolqueagenda').change(function () {
    var item = buscarDatoAgenda('vehicles', $(this).val());
    if (item) $('#decamatricularemolque').val(item.plate || '');
});
$('#decaautorizacionagenda').change(function () {
    var item = buscarDatoAgenda('authorizations', $(this).val());
    if (item) $('#decaautorizacion').val(item.name + ': ' + item.code);
});

function mostrarAgenda(items, tipo) {
    var $estado = $('#decaagendaestado');
    if (!Array.isArray(items) || items.length === 0) {
        $estado.text('Todavía no tienes ' + tipo + '.');
        return;
    }

    var $lista = $('<ul class="deca-agenda-lista"></ul>');
    items.forEach(function (item) {
        var texto = item.name || item.alias || item.plate || item.code || item.public_id;
        $('<li></li>').text(texto).appendTo($lista);
    });
    $estado.empty().append($lista);
}

function cargarAgenda(categoria) {
    agendaAction = categoria;
    var nombres = {
        counterparts: 'contrapartes',
        addresses: 'direcciones',
        vehicles: 'vehículos',
        drivers: 'conductores',
        authorizations: 'autorizaciones'
    };
    $('#decaagendaestado').text('Cargando...');
    agendaRequest(categoria).done(function (response) {
        mostrarAgenda(response.data, nombres[categoria]);
        if (categoria === 'counterparts') {
            cargarContrapartes(response.data);
        }
    }).fail(function (xhr) {
        var mensaje = xhr.responseJSON && xhr.responseJSON.error
            ? xhr.responseJSON.error
            : 'No se pudo cargar la agenda.';
        $('#decaagendaestado').text(mensaje);
    });
}

function cargarContrapartes(counterparts) {
    var selects = $('#deca-direccion-contraparte, #deca-tractora-contraparte, #deca-remolque-contraparte, #deca-autorizacion-contraparte');
    selects.find('option:not(:first)').remove();
    (counterparts || []).forEach(function (counterpart) {
        $('<option></option>')
            .val(counterpart.public_id)
            .text(counterpart.name + ' (' + counterpart.tax_id + ')')
            .appendTo(selects);
    });
}

function enviarFormularioAgenda(formulario, accion, datos) {
    formulario.find('button[type="submit"]').prop('disabled', true);
    agendaRequest(accion, datos).done(function (response) {
        if (!response.success) {
            $('#decaagendaestado').text(response.data && response.data.detail ? response.data.detail : 'No se pudo guardar el registro.');
            return;
        }
        formulario[0].reset();
        $('#fconte_1_4_' + (accion === 'counterpart' ? '1' : accion === 'address' ? '2' : accion === 'vehicle' ? '3' : accion === 'driver' ? '5' : '6')).fadeOut();
        $('#fconte_1_4').fadeIn();
        cargarAgenda(agendaAction);
    }).fail(function (xhr) {
        var data = xhr.responseJSON || {};
        var mensaje = data.error || (data.data && data.data.detail) || 'No se pudo guardar el registro.';
        $('#decaagendaestado').text(mensaje);
    }).always(function () {
        formulario.find('button[type="submit"]').prop('disabled', false);
    });
}

$('#decaagendadirecciones').click(function () {
    cargarAgenda('addresses');
});

$('#decaagendacontrapartes').click(function () {
    cargarAgenda('counterparts');
});

$('#decaagendavehiculos').click(function () {
    cargarAgenda('vehicles');
});

$('#decaagendaconductores').click(function () {
    cargarAgenda('drivers');
});

$('#decaagendaautorizaciones').click(function () {
    cargarAgenda('authorizations');
});

$('#formulario-deca-contraparte').submit(function (event) {
    event.preventDefault();
    var roles = [
        $('input[name="deca-contraparte-rol-cargador"]').is(':checked') ? 'shipper' : null,
        $('input[name="deca-contraparte-rol-transportista"]').is(':checked') ? 'carrier' : null
    ].filter(Boolean);
    if (roles.length === 0) {
        $('#decaagendaestado').text('Selecciona al menos un papel para la contraparte.');
        return;
    }
    enviarFormularioAgenda($(this), 'counterpart', {
        name: $('#deca-contraparte-nombre').val(),
        tax_id: $('#deca-contraparte-nif').val(),
        roles: roles,
        email: $('#deca-contraparte-email').val() || null,
        phone: $('#deca-contraparte-telefono').val() || null,
        street: $('#deca-contraparte-via').val() || null,
        postal_code: $('#deca-contraparte-cp').val() || null,
        locality: $('#deca-contraparte-localidad').val() || null,
        province: $('#deca-contraparte-provincia').val() || null,
        notes: $('#deca-contraparte-notas').val() || null
    });
});

$('#formulario-deca-direccion').submit(function (event) {
    event.preventDefault();
    enviarFormularioAgenda($(this), 'address', {
        alias: $('#deca-direccion-alias').val() || null,
        company_name: $('#deca-direccion-empresa').val() || null,
        street: $('#deca-direccion-via').val(),
        postal_code: $('#deca-direccion-cp').val() || null,
        locality: $('#deca-direccion-localidad').val(),
        province: $('#deca-direccion-provincia').val() || null,
        counterpart_public_id: $('#deca-direccion-contraparte').val() || null,
        contact_email: $('#deca-direccion-email').val() || null,
        contact_phone: $('#deca-direccion-telefono').val() || null
    });
});

function enviarFormularioVehiculo(formulario, tipo) {
    var esContraparte = formulario.find('input[type="radio"]:checked').val() === 'contraparte';
    enviarFormularioAgenda(formulario, 'vehicle', {
        vehicle_type: tipo,
        plate: formulario.find('input[id$="-matricula"]').val(),
        description: formulario.find('input[id$="-descripcion"]').val() || null,
        owner_kind: esContraparte ? 'counterparty' : 'own',
        counterpart_public_id: esContraparte ? formulario.find('select').val() : null
    });
}

$('#formulario-deca-tractora').submit(function (event) {
    event.preventDefault();
    enviarFormularioVehiculo($(this), 'tractor');
});

$('#formulario-deca-remolque').submit(function (event) {
    event.preventDefault();
    enviarFormularioVehiculo($(this), 'trailer');
});

$('#formulario-deca-conductor').submit(function (event) {
    event.preventDefault();
    enviarFormularioAgenda($(this), 'driver', {
        name: $('#deca-conductor-nombre').val(),
        phone: $('#deca-conductor-telefono').val(),
        notes: $('#deca-conductor-notas').val() || null
    });
});

$('#formulario-deca-autorizacion').submit(function (event) {
    event.preventDefault();
    var esContraparte = $('input[name="deca-autorizacion-propiedad"]:checked').val() === 'contraparte';
    enviarFormularioAgenda($(this), 'authorization', {
        name: $('#deca-autorizacion-nombre').val(),
        code: $('#deca-autorizacion-codigo').val(),
        owner_kind: esContraparte ? 'counterparty' : 'own',
        counterpart_public_id: esContraparte ? $('#deca-autorizacion-contraparte').val() : null
    });
});

$('#decaagendaaddcontraparte').click(function () {
    $('#fconte_1_4').hide();
    $('#fconte_1_4_1').show();
    $('#deca-contraparte-nombre').trigger('focus');
});

$('#decaagendadirecciones').click(function () {
    $('.deca-agenda-categoria').removeClass('deca-agenda-categoria-activa').attr('aria-selected', 'false');
    $(this).addClass('deca-agenda-categoria-activa').attr('aria-selected', 'true');
    $('#decaagendaaddcontraparte, #decaagendaaddtractora, #decaagendaaddremolque, #decaagendaaddconductor, #decaagendaaddautorizacion').hide();
    $('#decaagendaadddireccion').show();
    $('#decaagendaestado').text('Todavía no tienes direcciones.');
});

$('#decaagendacontrapartes').click(function () {
    $('.deca-agenda-categoria').removeClass('deca-agenda-categoria-activa').attr('aria-selected', 'false');
    $(this).addClass('deca-agenda-categoria-activa').attr('aria-selected', 'true');
    $('#decaagendaadddireccion, #decaagendaaddtractora, #decaagendaaddremolque, #decaagendaaddconductor, #decaagendaaddautorizacion').hide();
    $('#decaagendaaddcontraparte').show();
    $('#decaagendaestado').text('Todavía no tienes contrapartes.');
});

$('#decaagendavehiculos').click(function () {
    $('.deca-agenda-categoria').removeClass('deca-agenda-categoria-activa').attr('aria-selected', 'false');
    $(this).addClass('deca-agenda-categoria-activa').attr('aria-selected', 'true');
    $('#decaagendaaddcontraparte, #decaagendaadddireccion, #decaagendaaddconductor, #decaagendaaddautorizacion').hide();
    $('#decaagendaaddtractora, #decaagendaaddremolque').show();
    $('#decaagendaestado').text('Todavía no tienes vehículos.');
});

$('#decaagendaconductores').click(function () {
    $('.deca-agenda-categoria').removeClass('deca-agenda-categoria-activa').attr('aria-selected', 'false');
    $(this).addClass('deca-agenda-categoria-activa').attr('aria-selected', 'true');
    $('#decaagendaaddcontraparte, #decaagendaadddireccion, #decaagendaaddtractora, #decaagendaaddremolque, #decaagendaaddautorizacion').hide();
    $('#decaagendaaddconductor').show();
    $('#decaagendaestado').text('Todavía no tienes conductores.');
});

$('#decaagendaautorizaciones').click(function () {
    $('.deca-agenda-categoria').removeClass('deca-agenda-categoria-activa').attr('aria-selected', 'false');
    $(this).addClass('deca-agenda-categoria-activa').attr('aria-selected', 'true');
    $('#decaagendaaddcontraparte, #decaagendaadddireccion, #decaagendaaddtractora, #decaagendaaddremolque, #decaagendaaddconductor').hide();
    $('#decaagendaaddautorizacion').show();
    $('#decaagendaestado').text('Todavía no tienes autorizaciones.');
});

$('#decaagendaadddireccion').click(function () {
    $('#fconte_1_4').hide();
    $('#fconte_1_4_2').show();
    $('#deca-direccion-alias').trigger('focus');
});

$('#decaagendaaddtractora').click(function () {
    $('#fconte_1_4').hide();
    $('#fconte_1_4_3').appendTo('body').show();
    $('#deca-tractora-matricula').trigger('focus');
});

$('#decaagendaaddremolque').click(function () {
    $('#fconte_1_4').hide();
    $('#fconte_1_4_4').appendTo('body').show();
    $('#deca-remolque-matricula').trigger('focus');
});

$('#decaagendaaddconductor').click(function () {
    $('#fconte_1_4').hide();
    $('#fconte_1_4_5').appendTo('body').show();
    $('#deca-conductor-nombre').trigger('focus');
});

$('#decaagendaaddautorizacion').click(function () {
    $('#fconte_1_4').hide();
    $('#fconte_1_4_6').appendTo('body').show();
    $('#deca-autorizacion-nombre').trigger('focus');
});

$('#deca-contraparte-cancelar').click(function () {
    $('#fconte_1_4').fadeIn();
    $('#fconte_1_4_1').fadeOut();
});

$('#deca-direccion-cancelar').click(function () {
    $('#fconte_1_4').fadeIn();
    $('#fconte_1_4_2').fadeOut();
});

$('#deca-tractora-cancelar, #deca-remolque-cancelar').click(function () {
    var formulario = $(this).attr('id').replace('deca-', '').replace('-cancelar', '');
    $('#fconte_1_4').fadeIn();
    $('#fconte_1_4_' + (formulario === 'tractora' ? '3' : '4')).fadeOut();
});

$('#deca-conductor-cancelar').click(function () {
    $('#fconte_1_4').fadeIn();
    $('#fconte_1_4_5').fadeOut();
});

$('#deca-autorizacion-cancelar').click(function () {
    $('#fconte_1_4').fadeIn();
    $('#fconte_1_4_6').fadeOut();
});
