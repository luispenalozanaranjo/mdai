<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use App\Http\Helpers\Common;
use App\Workflow;
use App\workflowDetalle;
use App\Nodo;
use App\nodoDetalle;

class Data extends Model{

	protected $table = 'data';
	protected $primaryKey = 'opp';
	protected $fillable = [
		'opp',
		'proyecto',
		'ejecutivo',
		'fecha_opp',
		'lote',
		'modelo',
		'frente',
		'serviu',
		'estado',
		'precio_lista_opp',
		'precio_final_opp',
		'descuento_unidad',
		'marca',
		'rut_cliente',
		'primer_nombre',
		'segundo_nombre',
		'apellido_paterno',
		'apellido_materno',
		'estado_civil',
		'telefonos',
		'comuna_cliente',
		'email',
		'canal',
		'medio',
		'unidad_principal',
		'precio_unidad_principal',
		'descuento_unidad_principal',
		'estacionamiento',
		'precio_estacionamiento',
		'descuento_estacionamiento',
		'bodega',
		'precio_bodega',
		'descuento_bodega',
		'estado_riesgo',
		'nombre_riesgo',
		'preaprobacion_riesgo',
		'fecha_cotizacion',
		'fecha_reserva',
		'fecha_cierre',
		'fecha_promesa',
		'pie',
		'cuotas_pie',
		'pie_cuota_1',
		'pie_cuota_2',
		'pie_restante',
		'pago_contra_promesa',
		'promesa_pagada',
		'escritura',
		'escritura_pagada',
		'pie_pagado',
		'gops_pagados',
		'cupon_gops',
		'chip',
		'ahorro',
		'subsidio',
		'bono_captación',
		'bono_integración',
		'reserva',
		'gops',
		'num_cuotas_gops',
		'gops_cuota_1',
		'gops_cuota_2',
		'gop_restante',
		'vencimiento_subsidio',
		'serie_subsidio',
		'num_subsidio',
		'llamado_subsidio',
		'anio_subsidio',
		'banco',
		'cupon_unidad_principal',
		'cupon_estacionamiento',
		'cupon_bodega',
		'cupon_ahorro_previo',
		'cupon_pago_contra_escritura',
		'cupon_giftcard',
		'rut_conyuge',
		'nombre_conyuge',
		'rent_conyuge',
		'rut_aval',
		'nombre_aval',
		'renta_aval',
		'rut_codeudor',
		'nombre_codeudor',
		'renta_codeudor',
		'cambio_unidad_tipo',
		'cliente_desiste',
		'pis_1',
		'pis_2',
		'pis_3',
		'pis_4',
		'pis_5'
	];

	public function getPromesa($opp){
		// Obtenemos el detalle de una promesa
		try{
			return $this->where('opp', $opp)->first();
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function getPromesaFull($opp){
		// Obtenemos el detalle de una promesa
		try{
			$promesa = $this->where('opp', $opp)->first();
			$promesa->proyectos;
			$promesa->etapas;
			$promesa->estados;
			return $promesa;
		}
		catch(\Exception $e){
			return false;
		}
	}

	public function marcasList(){
		// Agrupa y devuelve todas las marcas
		$marcas = $this->select('marca')->groupBy('marca')->orderBy('marca')->get();
		return ( !$marcas->isEmpty() ) ? $marcas : [];
	}

	public function ejecutivosList(){
		// Agrupa y devuelve todas las marcas
		$ejecutivos = $this->select('ejecutivo')->groupBy('ejecutivo')->orderBy('ejecutivo')->get();
		return ( !$ejecutivos->isEmpty() ) ? $ejecutivos : [];
	}

	public function proyectos() {
		// Relacion de la tabla de promesas con la de los proyectos
		return $this->belongsTo('App\Proyecto', 'id_proyecto');
	}

	public function etapas(){
		// Relacion de la tabla de promesas con la de las etapas
		return $this->belongsTo('App\Etapa', 'id_etapa');
	}

	public function estados(){
		// Relacion de la tabla de promesas con la de los estados
		return $this->belongsTo('App\Estado', 'estado', 'descripcion');
	}

	public function estadoWorkflow($opp){
		// Obtenemos el estado de un workflow de acuerdo a la opp
		$workflow = Workflow::where('opp', $opp)->first();

		// No se encontró el workflow
		if( !$workflow ) return false;
		
		// Buscamos la demas información
		$detalleWorkflow = workflowDetalle::where('id_workflow', $workflow->id)->first();
		$lastNodo = Nodo::where('etapa', 4)->where('num_nodo', 1000)->first();
		// Retornamos el detalle
		$detalle = nodoDetalle::where('id_nodo', $lastNodo->id)->where('id_dw', $detalleWorkflow->id)->first();
		return (!empty($detalle)) ? true : false;
	}

	public function tieneWorkflow($opp){
		$workflow = Workflow::where('opp', $opp)->first();
		return (!empty($workflow)) ? true : false;
	}

}