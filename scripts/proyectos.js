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

function empresa() {
    $('#cargando').fadeIn('500', function () {
        $('#fconte_1').hide();
        $('#fconte_2').show();
        $('#cargando').fadeOut('500', function () {
            // Animation complete.
        });
    });
}

function proyectos() {
    $('#cargando').fadeIn('500', function () {
        $('#fconte_2').hide();
        $('#fconte_2_1').show();
        $('#cargando').fadeOut('500', function () {
            // Animation complete.
        });
    });
}

function partes() {
    $('#cargando').fadeIn('500', function () {
        $('#fconte_2').hide();
        $('#fconte_2_2').show();
        $('#cargando').fadeOut('500', function () {
            // Animation complete.
        });
    });
}

function clientes() {
    $('#cargando').fadeIn('500', function () {
        $('#fconte_2').hide();
        $('#fconte_2_3').show();
        $('#cargando').fadeOut('500', function () {
            // Animation complete.
        });
    });
}

function planificador() {
    $('#cargando').fadeIn('500', function () {
        $('#fconte_2').hide();
        $('#fconte_2_4').show();
        $('#cargando').fadeOut('500', function () {
            // Animation complete.
        });
    });
}

function historial() {
    $('#cargando').fadeIn('500', function () {
        $('#fconte_2').hide();
        $('#fconte_2_5').show();
        $('#cargando').fadeOut('500', function () {
            // Animation complete.
        });
    });
}

function avisos() {
    $('#cargando').fadeIn('500', function () {
        $('#fconte_2').hide();
        $('#fconte_2_6').show();
        $('#cargando').fadeOut('500', function () {
            // Animation complete.
        });
    });
}