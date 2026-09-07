function comprueba(local){
	if( $( local ).html()=="La sesión ha caducado." ){
		location.href="salir.php?error=2";
	}
}

// Elimina los diacríticos de un texto (ES6)
//
function eliminarDiacriticos(texto) {
    return texto.normalize('NFD').replace(/[\u0300-\u036f]/g,"");
}
