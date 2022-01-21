<?php

use Illuminate\Database\Seeder;
use App\workflowEtapas;

class workflowEtapasSeed extends Seeder{

    public function run(){
        workflowEtapas::insert([
        	['nombre' => 'Etapa 1'],
        	['nombre' => 'Etapa 2'],
        	['nombre' => 'Etapa 3'],
        	['nombre' => 'Etapa 4'],
        	['nombre' => 'Cambio de Unidad'],
        	['nombre' => 'Excepciones'],
        	['nombre' => 'Desistimiento'],
            ['nombre' => 'Otros'],
            ['nombre' => 'Escrituración']
        ]);
    }
	
}