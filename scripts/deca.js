
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
}

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
