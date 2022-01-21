<?php

use Illuminate\Database\Seeder;
use App\Area;

class areasSeed extends Seeder{
	
	public function run(){
		Area::insert([
			['nombre' => 'Legal'],
			['nombre' => 'Operaciones'],
			['nombre' => 'Finanzas'],
			['nombre' => 'Asistente Social'],
			['nombre' => 'Tecnologia'],
			['nombre' => 'Comercial']
		]);
	}

}