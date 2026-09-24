
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
