<?php

use Illuminate\Database\Seeder;
use App\Formulario;

class formulariosSeed extends Seeder{

    public function run(){
        Formulario::insert([
            // Etapa 1
            [ 'id' => 1, 'tipo' => 'Vulnerable', 'etapa' => 1, 'num_nodo' => 230 ],
            [ 'id' => 2, 'tipo' => 'Medio', 'etapa' => 1, 'num_nodo' => 240 ],
            [ 'id' => 3, 'tipo' => 'Privado', 'etapa' => 1, 'num_nodo' => 250 ],
            [ 'id' => 4, 'tipo' => 'Privado Supervisor', 'etapa' => 1, 'num_nodo' => 251 ],
            // Etapa 2
            [ 'id' => 5, 'tipo' => 'Vulnerable V1', 'etapa' => 2, 'num_nodo' => 340 ],
            [ 'id' => 6, 'tipo' => 'Medio V1', 'etapa' => 2, 'num_nodo' => 350 ],
            [ 'id' => 7, 'tipo' => 'Medio V1 Finanzas', 'etapa' => 2, 'num_nodo' => 370 ],
            [ 'id' => 8, 'tipo' => 'Privado V1', 'etapa' => 2, 'num_nodo' => 360 ],
            [ 'id' => 9, 'tipo' => 'Privado V1 Finanzas', 'etapa' => 2, 'num_nodo' => 370 ],
            [ 'id' => 10, 'tipo' => 'Vulnerable - Medio contado V2', 'etapa' => 2, 'num_nodo' => 410 ],
            [ 'id' => 11, 'tipo' => 'Medio Serviu+ Chip V2', 'etapa' => 2, 'num_nodo' => 420 ],
            [ 'id' => 12, 'tipo' => 'Chip Privado V2', 'etapa' => 2, 'num_nodo' => 430 ],
            [ 'id' => 13, 'tipo' => 'Check Carpeta V2 Riesgo', 'etapa' => 2, 'num_nodo' => NULL ],
            [ 'id' => 14, 'tipo' => 'Check V2 Finanzas Vulnerable Medio Contado', 'etapa' => 2, 'num_nodo' => 460 ],
            [ 'id' => 15, 'tipo' => 'Check V2 Finanzas Medio Gestión Propia Gestión MDAI', 'etapa' => 2, 'num_nodo' => 460 ],
            [ 'id' => 16, 'tipo' => 'Check V2 Finanzas Privado Contado Gestión Propia Gestión MDAI', 'etapa' => 2, 'num_nodo' => 460 ],
            // Etapa 4
            [ 'id' => 17, 'tipo' => 'Check Confeccion carpeta vulnerable medio contado privado', 'etapa' => 4, 'num_nodo' => 500 ],
            [ 'id' => 18, 'tipo' => 'Check Nominación y adjudicación medio vulnerable privado', 'etapa' => 4, 'num_nodo' => 510 ]
        ]);
    }
    
}