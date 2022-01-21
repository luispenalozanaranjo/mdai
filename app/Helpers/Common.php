<?php

use Carbon\Carbon;


function searchInArray($needle, $haystack){
	// Verificamos si hay algun valor del array 1 (needle) en el array 2 (haystack)
	$found = [];

	foreach( $needle as $item ){
		if( in_array($item, $haystack) ) array_push($found, $item);
	}

	return count($found) ? $found : false;
}

function showTotal($total, $singular, $plural){
	// Devuelve el texto con el conteo
	if( $total === 0 ) return "No se encontraron $plural.";
	elseif( $total === 1) return "Se encontró 1 $singular.";
	else return "Se encontraron $total $plural.";
}

function dateNow(){
	//return Carbon::now()->subHours(3);
	return Carbon::now()->toDateTimeString();
}

function getPageTitle(){
	// Obtenemos el title que viene definido en la página (blade)
	$page_title = app()->view->getSections()['title'];
	
	if ( Request::is( '/' ) ){
		// Es el home
		return config('app.name') . ' | ' . $page_title;
	}
	else{
		// Cualquier otro
		return $page_title . ' | ' . config('app.name');
	}
}

function getPageDescription(){
	// Obtenemos el description que viene definido en la página (blade)
	$page_description = app()->view->getSections()['description'];
	
	if( !$page_description || $page_description === '' ){
		// Si no tiene nada, definimos como description el que esta
		// en el config de la aplicación
		return config('app.short_desc');
	}
	else{
		// Mostramos el que se definió
		return $page_description;
	}
}

function parseNow(){
	// Obtenemos el datetime mediante Carbon
	Carbon::setLocale('es');
	$now = Carbon::now();
	$diaN = $now->getTranslatedDayName('dddd');
	$dia = $now->isoFormat('DD');
	$mes = $now->isoFormat('MMMM');
	$anio = $now->isoFormat('YYYY');
	// Devolvemos la fecha formateada
	return "capitalize($diaN) capitalize($dia) de capitalize($mes) del $anio";
}

function parseDate($raw_date, $separator = '/'){
	// Formateamos una fecha (string) y devolvemos un datetime
	$trim_date = trim($raw_date);
	$date = explode($separator, $trim_date);

	// Está vacío
	if( empty($trim_date) || $trim_date === null ) return '';

	// El explode funciono y tenemos más de un elemento
	if( $date && count($date) > 1 ){
		$day = $date[0];
		$month = $date[1];
		$year = $date[2];

		// Formateamos y devolvemos parseado
		$new_date = "$year-$month-$day";
		return Carbon::parse($new_date);
	}
	else return null;
}

function getDV($rut){
	$rut = strval($rut);
    while($rut[0] == "0") {
        $rut = substr($rut, 1);
    }
    $factor = 2;
    $suma = 0;
    for($i = strlen($rut) - 1; $i >= 0; $i--) {
        $suma += $factor * $rut[$i];
        $factor = $factor % 7 == 0 ? 2 : $factor + 1;
    }
    $dv = 11 - $suma % 11;
    $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
    return $dv;
}

function addDV($rut){
	if( !$rut ) return $rut;
	return $rut . getDV($rut);
}

function parseRUT($raw_rut){
	// Formateamos un RUT (string) y añadimos los puntos y el guión
	$actual = preg_replace('/^0+/', "", $raw_rut);
	if( $actual !== '' && strlen($actual) > 1 ){
		$sinPuntos = str_replace('/\./g', "", $actual);
		$actualLimpio = str_replace('/-/g', "", $sinPuntos);

		$inicio = substr($actualLimpio, 0, strlen($actualLimpio) - 1);
		$rutPuntos = "";
		$i = 0;
		$j = 1;
		for ($i = strlen($inicio) - 1; $i >= 0; $i--){
			$letra = $inicio[$i];
			$rutPuntos = $letra . $rutPuntos;
			if( $j % 3 == 0 && $j <= strlen($inicio) - 1 ){
				$rutPuntos = "." . $rutPuntos;
			}
			$j++;
		}
		$dv = substr($actualLimpio, strlen($actualLimpio) - 1);
		$rutPuntos = $rutPuntos . "-" . strtoupper($dv);
	}
	return $rutPuntos;
}

function capitalize($string){
	// Devuelve un string capitalizado
	$value = mb_strtolower($string);
	return ucwords($value);
}

function formatBytes($bytes, $size = true, $int = false) {
	// Devolvemos un string formateado como bytes
	$size = $bytes;
    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $power = $size > 0 ? floor(log($size, 1024)) : 0;
    $number = number_format($size / pow(1024, $power), 0, '.', '.');
    return ($int) ? intval($number) : $number + (($size) ? $units[$power] : '');
} 