<?php

use Illuminate\Database\Seeder;
use App\Estado;

class estadosSeed extends Seeder{

    public function run(){
        Estado::insert([
            [ 'descripcion' => 'Aprobado'],
            [ 'descripcion' => 'Rechazado'],
            [ 'descripcion' => 'Pendiente'],
            [ 'descripcion' => 'En Proceso'],
            [ 'descripcion' => 'Cerrada'],
            [ 'descripcion' => 'Listo'],
            [ 'descripcion' => 'Desistida'],
            [ 'descripcion' => 'Promesada'],
            [ 'descripcion' => 'Caducada'],
            [ 'descripcion' => 'Cotización'],
            [ 'descripcion' => 'Anulada'],
            [ 'descripcion' => 'Pre-Reservada'],
            [ 'descripcion' => 'Terminada'],
            [ 'descripcion' => 'Escriturada'],
            [ 'descripcion' => 'Reservada']
        ]);
    }
    
}