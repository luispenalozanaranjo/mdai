<?php

use Illuminate\Database\Seeder;
use App\Cargo;

class cargosSeed extends Seeder{

	public function run(){
		Cargo::insert([
			['nombre' => 'Abogado'],
			['nombre' => 'Analista Control de Gestión'],
			['nombre' => 'Analista Finanzas'],
			['nombre' => 'Analista Riesgo'],
			['nombre' => 'Asistente Social'],
			['nombre' => 'Community Manager'],
			['nombre' => 'Ejecutivo Procesos'],
			['nombre' => 'Ejecutivo TI'],
			['nombre' => 'Ejecutivo Ventas'],
			['nombre' => 'Gerente Comercial'],
			['nombre' => 'Gerente Finanzas'],
			['nombre' => 'Jefe Comercial'],
			['nombre' => 'Jefe Control de Gestión'],
			['nombre' => 'Jefe de Canales'],
			['nombre' => 'Jefe Procesos y Operaciones'],
			['nombre' => 'Subgerente Comercial'],
			['nombre' => 'Subgerente Finanzas'],
			['nombre' => 'Supervisor de Riesgo'],
			['nombre' => 'Test']
		]);
	}

}