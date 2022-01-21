<?php

use Illuminate\Database\Seeder;
use App\Region;

class regionesSeed extends Seeder{

    public function run(){
        Region::insert([
            ['num_region' => '1', 'nombre' => 'Arica y Parinacota'],
            ['num_region' => '2', 'nombre' => 'Tarapacá'],
            ['num_region' => '3', 'nombre' => 'Antofagasta'],
            ['num_region' => '4', 'nombre' => 'Atacama'],
            ['num_region' => '5', 'nombre' => 'Coquimbo'],
            ['num_region' => '6', 'nombre' => 'Valparaíso'],
            ['num_region' => '7', 'nombre' => "Libertador General Bernardo O'Higgins"],
            ['num_region' => '8', 'nombre' => 'Maule'],
            ['num_region' => '9', 'nombre' => 'Ñuble'],
            ['num_region' => '10', 'nombre' => 'Biobío'],
            ['num_region' => '11', 'nombre' => 'Araucanía'],
            ['num_region' => '12', 'nombre' => 'De Los Ríos'],
            ['num_region' => '13', 'nombre' => 'De Los Lagos'],
            ['num_region' => '14', 'nombre' => 'Aysén del General Carlos Ibáñez del Campo'],
            ['num_region' => '15', 'nombre' => 'Magallanes y de la Antártica Chilena'],
            ['num_region' => '16', 'nombre' => 'Metropolitana de Santiago'],
        ]);
    }
    
}