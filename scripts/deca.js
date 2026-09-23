
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