<?php

use Illuminate\Database\Seeder;
use App\EntidadFinanciera;

class entidadesSeed extends Seeder{

    public function run(){
    	EntidadFinanciera::insert([
	        ['nombre' => 'Banco De Chile', 'tipo' => 'Banco'],
			['nombre' => 'Banco Internacional', 'tipo' => 'Banco'],
			['nombre' => 'Scotiabank Chile', 'tipo' => 'Banco'],
			['nombre' => 'Banco De Creditos E Inversiones', 'tipo' => 'Banco'],
			['nombre' => 'Banco BICE', 'tipo' => 'Banco'],
			['nombre' => 'HSBC Bank (Chile)', 'tipo' => 'Banco'],
			['nombre' => 'Banco Santander-Chile', 'tipo' => 'Banco'],
			['nombre' => 'Itaú Corpbanca', 'tipo' => 'Banco'],
			['nombre' => 'Banco Security', 'tipo' => 'Banco'],
			['nombre' => 'Banco Falabella', 'tipo' => 'Banco'],
			['nombre' => 'Banco Ripley', 'tipo' => 'Banco'],
			['nombre' => 'Banco Consorcio', 'tipo' => 'Banco'],
			['nombre' => 'Scotiabank Azul (ex BBVA)', 'tipo' => 'Banco'],
			['nombre' => 'Banco BTG Pactual Chile', 'tipo' => 'Banco'],
			['nombre' => 'Banco Estado', 'tipo' => 'Banco'],
			['nombre' => 'Coopeuch', 'tipo' => 'Otro'],
			['nombre' => 'Caja Los Andes', 'tipo' => 'Otro'],
			['nombre' => 'JAVE (jefatura De Ahorro Para La Vivienda Del Ejército)', 'tipo' => 'Otro'],
			['nombre' => 'Mutuario Concreces', 'tipo' => 'Otro'],
			['nombre' => 'Mutuaria Hipotecaria', 'tipo' => 'Otro'],
			['nombre' => 'Mutuaria Casanuestra', 'tipo' => 'Otro'],
			['nombre' => 'Mutuaria MYV', 'tipo' => 'Otro'],
			['nombre' => 'Unidad Leasing Habitacional', 'tipo' => 'Otro'],
			['nombre' => 'Mutuaria Hipotecaria', 'tipo' => 'Otro'],
			['nombre' => 'Notaria Myriam Amigo', 'tipo' => 'Notaria'],
		]);
    }
	
}