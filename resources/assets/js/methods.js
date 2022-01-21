export default{
	showTotal: function(total, singular, plural){
		// Devuelve el texto con el conteo
		if( total === 0 ) return `No se encontraron ${plural}.`;
		else if( total === 1) return `Se encontró 1 ${singular}.`;
		else return `Se encontraron ${total} ${plural}.`;
	},
	numRandom: function(min, max){
		// Devuelve un número random entre dos rangos
		return Math.floor(Math.random() * (max - min)) + min;
	},
	isEmpty: function(value){
		// Retorna si la propiedad esta defina, null o no tiene valor
		return value === undefined || value === null || value === '';
	},
	checkEmail: function(email){
		// Verifica si un string tiene formato de email
		let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	},
	getParents: function(node){
		let current = node, list = [];

		while( current.parentNode !== null && current !== document.documentElement ){
			list.push(current.parentNode);
			current = current.parentNode;
		}

		return list;
	},
	toURL: function(obj){
		let str = Object.keys(obj).map((key) =>  key + '=' + obj[key]);
		return '?' + str.join('&');
	},
	arraySort: function(arr, key){
		return arr.sort((a, b) => {
			if( key ){
				if( a[key] > b[key] ) return 1;
				if( b[key] > a[key] ) return -1;
			}
			else{
				if( a > b ) return 1;
				if( b > a ) return -1;
			}
			return 0;
		});
	},
	checkNullEmpty: function(string){
		// Verificamos que un string esté vacio, null o undefined
		if( string === null || string === '' || string === undefined ) return true;
		return false;
	},
	bytesToSize: function(bytes, size = true){
		// Parsea un string a formato de tamaño
		let sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		if( bytes == 0 ) return '0' + (size) ? ' bytes' : '';
		let i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return Math.round(bytes / Math.pow(1024, i), 2) + ((size) ? ' ' + sizes[i] : '');
	}
}