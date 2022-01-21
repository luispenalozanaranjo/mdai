<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntidadFinanciera extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return [
            'id_entidades' => $this->id_entidades,
            'entidad' => $this->entidad,
            'tipo' => $this->tipo,
            'estado' => (int) $this->estado,
        ];
    }
}
