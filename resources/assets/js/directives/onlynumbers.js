var config = {
	no_permitidas: [ '!', '"', '$', '%', '&', '/', '(', ')', '=', '?', '¿', '*', '¨', '^', '{', '}', 'Ç', 'ç', 'ª', 'º', ',', 'Dead', '`', '+', '`', '_', '@', '#', '|', '¢', '∞', '¬', '÷', '”', '≠', '´'],
	no_permitidas_eventkey: [192, 222, 16, 220, 187],
	permitidas_eventkey: [224, 86]
};

export default {
	inserted: function (el, binding){
		// Cuando el elemento enlazado es insertado en el DOM
		if( binding.value || binding.value === undefined ){
			el.addEventListener('keydown', function(event){
				if( config.no_permitidas_eventkey.includes(event.keyCode) || config.no_permitidas.includes(event.key) ){
					// Verifica si el caracter ingresado esta dentro del array de las no permitidas
					this.blur();
				}

				if( event.keyCode !== 8 && event.keyCode !== 9 && event.keyCode !== 37 && event.keyCode !== 39 ){
					// Permite el ingreso de Borrar, Tab, Flecha a la izquierda, Flecha a la derecha
					if( (event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || config.permitidas_eventkey.includes( event.keyCode) ){
						// Si es numero, permite la accion
						return true;
					}
					else{
						// Si no es numero, previene la escritura en el input
						event.preventDefault();
						return false;
					}
				}
			});
		}
	}
}