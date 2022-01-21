<?php

use Illuminate\Database\Seeder;
use App\Permisos;

use App\Nodo as Nodos;

class permissionsTableSeed extends Seeder{
	public function run(){
		foreach( Nodos::all() as $nodo ){
			// Recorremos los nodos y los insertamos
			Permisos::create([ 'num_nodo' => $nodo->num_nodo ]);
		}
	}
}
