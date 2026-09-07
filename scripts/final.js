$( '#confirmacionokboton a' ).click(function() {
	$( '#confirmacionok' ).fadeOut( '500', function() {
	// Animation complete.
	});
});

$( '#confirmacionerrorboton a' ).click(function() {
	$( '#confirmacionerror' ).fadeOut( '500', function() {
	// Animation complete.
	});
});

$( '#confirmacionblancoboton a' ).click(function() {
	$( '#confirmacionblanco' ).fadeOut( '500', function() {
	// Animation complete.
	});
});

$( '#confirmaciondudaboton #confirmaciondudabotonno' ).click(function() {
	$( '#confirmacionduda' ).fadeOut( '500', function() {
	// Animation complete.
	});
	$( '#confirmaciondudaformulario' ).html( '' );
});

/*$( '#confirmaciondudaboton #confirmaciondudabotonsi' ).click(function() {
	$( '#confirmaciondudaformulario' ).submit();
});*/


$('#menullamaicono').click(function(){
	$('#menu').fadeToggle();
});
