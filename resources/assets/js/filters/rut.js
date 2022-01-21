export default function( value ){
	if( !value ) return '';

	let actual = value.toString().replace(/^0+/, "");
	if( actual !== '' && actual.length){
		let sinPuntos = actual.replace(/\./g, "");
		let actualLimpio = sinPuntos.replace(/-/g, "");
		let inicio = actualLimpio.substring(0, actualLimpio.length - 1);
		let rutPuntos = "";
		let j = 1;

		for( let i = inicio.length - 1; i >= 0; i-- ){
			let letra = inicio.charAt(i);
			rutPuntos = letra + rutPuntos;
			if (j % 3 == 0 && j <= inicio.length - 1) {
				rutPuntos = "." + rutPuntos;
			}
			j++;
		}

		let dv = actualLimpio.substring(actualLimpio.length - 1);
		return rutPuntos + "-" + dv.toUpperCase();
	}
}