$('#cerrar_2').click(function () {
    $('#fconte_1').fadeIn();
    $('#fconte_2').fadeOut();
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