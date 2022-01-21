<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Proyecto extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request){
		return  [
			'id_proyecto' => $this->id,
			'nombre' => $this->nombre,
			'etapas' => $this->etapas,
			'promesas' => $this->data,
			'codigo' => $this->codigo,
		];
	}
}
