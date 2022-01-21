<?php

namespace App\Exports;

use App\Usuario as user;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class reporteriaProduccion implements FromCollection, WithHeadings, ShouldAutoSize{
	use Exportable;
	protected $registros;

	public function __construct($registros = null){
		$this->registros = $registros;
	}

	public function headings(): array{
		return [
			'OPP',
			'RUT Cliente',
			'Fecha recepción final',
			'Usuario',
			'Estado',
			'Fecha entrada',
			'Fecha salida',
			'ID Nodo',
			'Días',
			'Horas',
			'Minutos',
			'Horas totales',
			'Actividad',
			'Subactividad',
			'Flujo',
			'Observaciones',
			'Proyecto',
			'Etapa',
			'Serviu',
			'Marca',
			'Modelo',
			'Unidad principal',
			'Estacionamiento',
			'Bodega',
			'Promesado',
			'Usuario termina',
			'Fecha promesa',
			'Primer nombre',
			'Segundo nombre',
			'Apellido paterno',
			'Apellido materno',
			'Tipo crédito',
			'Num nodo',
			'Subtarea',
			'Subtarea1',
			'fecha_subtarea1'
		];
	}

	public function collection(){
		return collect($this->registros);
	}
}
