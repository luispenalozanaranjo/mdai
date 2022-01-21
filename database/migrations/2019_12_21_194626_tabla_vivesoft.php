<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaVivesoft extends Migration{

	public function up(){
		Schema::create('data', function(Blueprint $table){
			// Creacion de la tabla data, la que contiene la informacion de las promesas
			$table->charset = 'utf8';
			$table->collation = 'utf8_unicode_ci';

			$table->bigIncrements('opp');
			//$table->string('codigo_proyecto', 255);
			$table->unsignedBigInteger('id_proyecto');
			$table->unsignedBigInteger('id_etapa');
			$table->string('ejecutivo', 255);
			//$table->string('etapa', 255);
			$table->datetime('fecha_opp');
			$table->string('lote', 255);
			$table->string('modelo', 255)->nullable();
			$table->string('frente', 255)->nullable();
			$table->string('serviu', 255)->nullable();
			$table->string('estado', 255);
			$table->integer('precio_lista_opp');
			$table->float('precio_final_opp');
			$table->float('descuento_unidad');
			$table->string('marca', 255);
			$table->string('rut_cliente');
			$table->string('primer_nombre', 255);
			$table->string('segundo_nombre', 255)->nullable();
			$table->string('apellido_paterno', 255);
			$table->string('apellido_materno', 255)->nullable();
			$table->string('estado_civil', 255)->nullable();
			$table->string('telefonos')->nullable();
			$table->string('comuna_cliente', 255)->nullable();
			$table->string('email', 255);
			$table->string('canal', 255)->nullable();
			$table->string('medio', 255)->nullable();
			$table->string('unidad_principal', 255)->nullable();
			$table->float('precio_unidad_principal')->nullable();
			$table->float('descuento_unidad_principal')->nullable();
			$table->string('estacionamiento', 255)->nullable();
			$table->string('precio_estacionamiento', 255)->nullable();
			$table->string('descuento_estacionamiento', 255)->nullable();
			$table->string('bodega', 255)->nullable();
			$table->string('precio_bodega', 255)->nullable();
			$table->string('descuento_bodega', 255)->nullable();
			$table->string('estado_riesgo', 255)->nullable();
			$table->string('nombre_riesgo', 255)->nullable();
			$table->string('preaprobacion_riesgo', 255)->nullable();
			$table->date('fecha_cotizacion');
			$table->date('fecha_reserva');
			$table->date('fecha_cierre');
			$table->date('fecha_promesa');
			$table->float('pie');
			$table->float('cuotas_pie');
			$table->float('pie_cuota_1');
			$table->float('pie_cuota_2');
			$table->float('pie_restante');
			$table->float('pago_contra_promesa');
			$table->float('promesa_pagada')->nullable();
			$table->float('pie_pagado')->nullable();
			$table->float('gops_pagados')->nullable();
			$table->float('cupon_gops')->nullable();
			$table->float('escritura');
			$table->float('escritura_pagada')->nullable();
			$table->float('chip')->nullable();
			$table->float('ahorro')->nullable();
			$table->float('subsidio')->nullable();
			$table->float('bono_captación')->nullable();
			$table->float('bono_integración')->nullable();
			$table->integer('reserva')->nullable();
			$table->float('gops')->nullable();
			$table->integer('num_cuotas_gops')->nullable();
			$table->float('gops_cuota_1')->nullable();
			$table->float('gops_cuota_2')->nullable();
			$table->float('gop_restante')->nullable();
			$table->date('vencimiento_subsidio')->nullable();
			$table->string('serie_subsidio', 255)->nullable();
			$table->string('num_subsidio')->nullable();
			$table->string('llamado_subsidio', 255)->nullable();
			$table->integer('anio_subsidio')->nullable();
			$table->string('banco', 255)->nullable();
			$table->float('cupon_unidad_principal');
			$table->float('cupon_estacionamiento');
			$table->float('cupon_bodega');
			$table->float('cupon_ahorro_previo');
			$table->float('cupon_pago_contra_escritura');
			$table->float('cupon_giftcard');
			$table->string('rut_conyuge', 255)->nullable();
			$table->string('nombre_conyuge', 255)->nullable();
			$table->string('rent_conyuge', 255)->nullable();
			$table->string('rut_aval', 255)->nullable();
			$table->string('nombre_aval', 255)->nullable();
			$table->string('renta_aval', 255)->nullable();
			$table->string('rut_codeudor', 255)->nullable();
			$table->string('nombre_codeudor', 255)->nullable();
			$table->string('renta_codeudor', 255)->nullable();
			$table->string('tipo_credito', 45)->nullable();
			$table->string('cambio_unidad_tipo', 45)->nullable();
			$table->string('cliente_desiste',45)->nullable();
			$table->string('pis_1',45)->nullable();
			$table->string('pis_2',45)->nullable();
			$table->string('pis_3',45)->nullable();
			$table->string('pis_4',45)->nullable();
			$table->string('pis_5',45)->nullable();

			$table->timestamps();
		});
	}

	public function down(){
	}
}
