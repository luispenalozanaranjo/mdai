<?php

use Illuminate\Database\Seeder;
use App\Almacen;

class workflowDatosSeed extends Seeder{

    public function run(){
        Almacen::insert([
            ['slug' => 'observaciones', 'nombre' => 'Observaciones', 'type' => 'text'],
            ['slug' => 'tipo_envio', 'nombre' => 'Tipo de envio', 'type' => 'text'],
            ['slug' => 'chilexpress', 'nombre' => 'Nº comprobante Chilexpress', 'type' => 'text'],
            ['slug' => 'recibido', 'nombre' => 'Recibido', 'type' => 'text'],
            ['slug' => 'asignado', 'nombre' => 'Asignado', 'type' => 'select'],
            ['slug' => 'autoriza', 'nombre' => 'Autoriza', 'type' => 'text'],
            ['slug' => 'visado_carpeta', 'nombre' => 'Visado carpeta', 'type' => 'text'],
            ['slug' => 'retiro_mdai', 'nombre' => 'Retiro MDAI', 'type' => 'text'],
            ['slug' => 'responsable', 'nombre' => 'Nombre Responsable', 'type' => 'text'],
            ['slug' => 'stock_manual', 'nombre' => 'Stock Manual', 'type' => 'text'],
            ['slug' => 'recepcionado', 'nombre' => 'Recepcionado', 'type' => 'text'],
            ['slug' => 'promesa_entregada', 'nombre' => 'Promesa entregada', 'type' => 'text'],
            ['slug' => 'orden_escrituracion', 'nombre' => 'Orden de escrituración', 'type' => 'text'],
            ['slug' => 'recepcion_escrituracion', 'nombre' => 'Recepción orden escrituración', 'type' => 'text'],
            ['slug' => 'carpeta_entregada', 'nombre' => 'Carpeta entregada a abogado', 'type' => 'text'],
            ['slug' => 'carpeta_revisada', 'nombre' => 'Carpeta revisada por abogado', 'type' => 'text'],
            ['slug' => 'enviado_notaria', 'nombre' => 'Enviado a Notaria', 'type' => 'text'],
            ['slug' => 'recepcionado_notaria', 'nombre' => 'Recepcionado de Notaria', 'type' => 'text'],
            ['slug' => 'instruccion_notarial', 'nombre' => 'Instrucción notarial', 'type' => 'text'],
            ['slug' => 'nombre_notaria', 'nombre' => 'Nombre notaria', 'type' => 'text'],
            ['slug' => 'envio_escritura', 'nombre' => 'Envio Escritura a Notaria', 'type' => 'text'],
            ['slug' => 'recepcion_escritura', 'nombre' => 'Recepción Escritura Notaria', 'type' => 'text'],
            ['slug' => 'firma_escritura', 'nombre' => 'Firma escritura (Representante-Cliente-Banco)', 'type' => 'text'],
            ['slug' => 'representante1', 'nombre' => 'Representante 1', 'type' => 'select'],
            ['slug' => 'representante2', 'nombre' => 'Representante 2', 'type' => 'select'],
            ['slug' => 'comprador', 'nombre' => 'Comprador', 'type' => 'text'],
            ['slug' => 'firma_revision_abogado', 'nombre' => 'Firma revisión Abogado Banco Alzante', 'type' => 'text'],
            ['slug' => 'firma_revision_banco', 'nombre' => 'Firma revisión Banco Financiante Comprador', 'type' => 'text'],
            ['slug' => 'firma_apoderado', 'nombre' => 'Firma apoderado Banco Alzante', 'type' => 'text'],
            ['slug' => 'copia_notaria', 'nombre' => 'Solicitar copia a Notaria', 'type' => 'text'],
            ['slug' => 'notificar_creacion_carpeta', 'nombre' => 'Notificar creación carpeta serviu (Área Finanzas)', 'type' => 'text'],
            ['slug' => 'num_caratura', 'nombre' => 'Nº Caratula', 'type' => 'text'],
            ['slug' => 'solicitud_carpeta', 'nombre' => 'Solicitud de carpeta Serviu a Finanzas', 'type' => 'text'],
            ['slug' => 'cobro_instrucciones', 'nombre' => 'Cobro de instrucciones notariales', 'type' => 'text'],
            ['slug' => 'entrega_escritura', 'nombre' => 'Entrega escritura cliente', 'type' => 'text'],
            ['slug' => 'entrega_escritura_mdai', 'nombre' => 'Entrega escritura MDA', 'type' => 'text'],
            ['slug' => 'notificacion_pago', 'nombre' => 'Notificación de pago', 'type' => 'text'],
            ['slug' => 'contactar_cliente', 'nombre' => 'Contactar a cliente', 'type' => 'text'],
            ['slug' => 'notificacion_constructura', 'nombre' => 'Notificación a constructora', 'type' => 'text'],
            ['slug' => 'entrega_acta', 'nombre' => 'Entrega acta digital', 'type' => 'text'],
            ['slug' => 'entrega_sin_observaciones', 'nombre' => 'Entrega sin observaciones', 'type' => 'text'],
            ['slug' => 'entregada_reparos', 'nombre' => 'Entregada con reparos', 'type' => 'text'],
            ['slug' => 'disconforme', 'nombre' => 'Disconforme', 'type' => 'text'],
            ['slug' => 'seleccion_nueva_unidad', 'nombre' => 'Selección nueva unidad', 'type' => 'text'],
            ['slug' => 'generar_nueva_cotizacion', 'nombre' => 'Generar nueva cotización', 'type' => 'text'],
            ['slug' => 'solicitar_pre_aprobacion_bancaria', 'nombre' => 'Solicitar pre aprobación bancaria', 'type' => 'text'],
            ['slug' => 'cambio_unidad_tipo', 'nombre' => 'Mayor o menor valor', 'type' => 'text'],
            ['slug' => 'cliente_firma', 'nombre' => 'Cliente firma documentación', 'type' => 'text'],
            ['slug' => 'envio_comprobante_email', 'nombre' => 'Envío comprobante por email', 'type' => 'text'],
            ['slug' => 'solicitud_informacion', 'nombre' => 'Solicitud información', 'type' => 'text'],
            ['slug' => 'aprobacion_bancaria', 'nombre' => 'Aprobación bancaria', 'type' => 'text'],
            ['slug' => 'constatacion_renuncia', 'nombre' => 'Constatación de renuncia', 'type' => 'text'],
            ['slug' => 'fotocopia_carnet', 'nombre' => 'Fotocopia carnet - firmada ambos lados + huella', 'type' => 'text'],
            ['slug' => 'cliente_desiste', 'nombre' => 'Cliente desiste / Cliente no desiste', 'type' => 'text'],
            ['slug' => 'tiene_gops', 'nombre' => 'Con GOPS / Sin GOPS', 'type' => 'text'],
            ['slug' => 'constatacion_fisica', 'nombre' => 'Constatación física', 'type'=> 'text'],
            ['slug' => 'notificacion_renuncia', 'nombre' => '1 notificación de renuncia', 'type' => 'text'],
            ['slug' => 'copia_resciliacion', 'nombre' => '2 copias resciliación', 'type' => 'text'],
            ['slug' => 'de_notificar_finanzas_devolucion', 'nombre' => 'Notificar a finanzas (Soló si hay devolución)', 'type' => 'text'],
            ['slug' => 'devolucion_cliente', 'nombre' => 'Devolución a cliente', 'type' => 'text'],
            ['slug' => 'devolucion_cliente_fecha', 'nombre' => 'Fecha devolución a cliente', 'type' => 'text'],
            ['slug' => 'estado_escrituracion', 'nombre' => 'Estado escrituración', 'type' => 'text'],
            ['slug' => 'orden_escrituracion_banco', 'nombre' => 'Orden de escrituración Banco', 'type' => 'text'],
            ['slug' => 'ejecutivo_nombre', 'nombre' => 'Nombre ejecutivo', 'type' => 'text'],
            ['slug' => 'ejecutivo_email', 'nombre' => 'Email ejecutivo', 'type' => 'text'],
            ['slug' => 'ejecutivo_telefono', 'nombre' => 'Teléfono ejecutivo', 'type' => 'text'],
            ['slug' => 'envio_correo_cliente', 'nombre' => 'Envío correo cliente', 'type' => 'text'],
            ['slug' => 'entidad_1', 'nombre' => 'Entidad 1', 'type' => 'text'],
            ['slug' => 'entidad_1_fecha', 'nombre' => 'Entidad 1 - Fecha de envío', 'type' => 'text'],
            ['slug' => 'entidad_1_estado', 'nombre' => 'Entidad 1 - Estado', 'type' => 'text'],
            ['slug' => 'entidad_2', 'nombre' => 'Entidad 2', 'type' => 'text'],
            ['slug' => 'entidad_2_fecha', 'nombre' => 'Entidad 2 - Fecha de envío', 'type' => 'text'],
            ['slug' => 'entidad_2_estado', 'nombre' => 'Entidad 2 - Estado', 'type' => 'text'],
            ['slug' => 'entidad_3', 'nombre' => 'Entidad 3', 'type' => 'text'],
            ['slug' => 'entidad_3_fecha', 'nombre' => 'Entidad 3 - Fecha de envío', 'type' => 'text'],
            ['slug' => 'entidad_3_estado', 'nombre' => 'Entidad 3 - Estado', 'type' => 'text'],
            ['slug' => 'pis_1', 'nombre' => 'PIS 1', 'type' => 'text'],
            ['slug' => 'pis_2', 'nombre' => 'PIS 2', 'type' => 'text'],
            ['slug' => 'pis_3', 'nombre' => 'PIS 3', 'type' => 'text'],
            ['slug' => 'pis_4', 'nombre' => 'PIS 4', 'type' => 'text'],
            ['slug' => 'pis_5', 'nombre' => 'PIS 5', 'type' => 'text'],
            ['slug' => 'tasacion', 'nombre' => 'Tasación', 'type' => 'text'],
            ['slug' => 'titulos', 'nombre' => 'Títulos', 'type' => 'text'],
            ['slug' => 'notariales', 'nombre' => 'Notariales', 'type' => 'text'],
            ['slug' => 'escrituracion', 'nombre' => 'Escrituración', 'type' => 'text'],
            ['slug' => 'bienes_raices', 'nombre' => 'Bienes Raíces', 'type' => 'text'],
            ['slug' => 'impuesto_credito', 'nombre' => 'Impuesto Crédito', 'type' => 'text'],
            ['slug' => 'iva', 'nombre' => 'IVA', 'type' => 'text'],
            ['slug' => 'entidades', 'nombre' => 'Entidades', 'type' => 'select'],
            ['slug' => 'administracion', 'nombre' => 'Administración', 'type' => 'text'],
            ['slug' => 'seguros', 'nombre' => 'Seguros', 'type' => 'text'],
            ['slug' => 'gastos_varios', 'nombre' => 'Gastos varios', 'type' => 'text'],
            ['slug' => 'total_gastos_op', 'nombre' => 'Total Gastos OPP', 'type' => 'text'],
            ['slug' => 'diferencia_por_pagar', 'nombre' => 'Diferencia por pagar', 'type' => 'text'],
            ['slug' => 'credito_enlace_0', 'nombre' => 'Crédito enlace 0', 'type' => 'text'],
            ['slug' => 'credito_enlace_1', 'nombre' => 'Crédito enlace 1', 'type' => 'text'],
            ['slug' => 'credito_enlace_2', 'nombre' => 'Crédito enlace 2', 'type' => 'text'],
            ['slug' => 'credito_enlace_3', 'nombre' => 'Crédito enlace 3', 'type' => 'text'],
            ['slug' => 'credito_enlace_4', 'nombre' => 'Crédito enlace 4', 'type' => 'text'],
            ['slug' => 'credito_enlace_5', 'nombre' => 'Crédito enlace 5', 'type' => 'text'],
            ['slug' => 'credito_enlace_6', 'nombre' => 'Crédito enlace 6', 'type' => 'text'],
            ['slug' => 'credito_enlace_7', 'nombre' => 'Crédito enlace 7', 'type' => 'text'],
            ['slug' => 'credito_enlace_8', 'nombre' => 'Crédito enlace 8', 'type' => 'text'],
            ['slug' => 'credito_enlace_9', 'nombre' => 'Crédito enlace 9', 'type' => 'text'],
            ['slug' => 'otros_creditos_0', 'nombre' => 'Otros créditos 0', 'type' => 'text'],
            ['slug' => 'otros_creditos_1', 'nombre' => 'Otros créditos 1', 'type' => 'text'],
            ['slug' => 'otros_creditos_2', 'nombre' => 'Otros créditos 2', 'type' => 'text'],
            ['slug' => 'otros_creditos_3', 'nombre' => 'Otros créditos 3', 'type' => 'text'],
            ['slug' => 'otros_creditos_4', 'nombre' => 'Otros créditos 4', 'type' => 'text'],
            ['slug' => 'otros_creditos_5', 'nombre' => 'Otros créditos 5', 'type' => 'text'],
            ['slug' => 'otros_creditos_6', 'nombre' => 'Otros créditos 6', 'type' => 'text'],
            ['slug' => 'otros_creditos_7', 'nombre' => 'Otros créditos 7', 'type' => 'text'],
            ['slug' => 'otros_creditos_8', 'nombre' => 'Otros créditos 8', 'type' => 'text'],
            ['slug' => 'otros_creditos_9', 'nombre' => 'Otros créditos 9', 'type' => 'text'],
            ['slug' => 'suma_total_0', 'nombre' => 'Suma Total 0', 'type' => 'text'],
            ['slug' => 'suma_total_1', 'nombre' => 'Suma Total 1', 'type' => 'text'],
            ['slug' => 'suma_total_2', 'nombre' => 'Suma Total 2', 'type' => 'text'],
            ['slug' => 'suma_total_3', 'nombre' => 'Suma Total 3', 'type' => 'text'],
            ['slug' => 'suma_total_4', 'nombre' => 'Suma Total 4', 'type' => 'text'],
            ['slug' => 'suma_total_5', 'nombre' => 'Suma Total 5', 'type' => 'text'],
            ['slug' => 'suma_total_6', 'nombre' => 'Suma Total 6', 'type' => 'text'],
            ['slug' => 'suma_total_7', 'nombre' => 'Suma Total 7', 'type' => 'text'],
            ['slug' => 'suma_total_8', 'nombre' => 'Suma Total 8', 'type' => 'text'],
            ['slug' => 'suma_total_9', 'nombre' => 'Suma Total 9', 'type' => 'text'],
            ['slug' => 'estado_0', 'nombre' => 'Estado 0', 'type' => 'text'],
            ['slug' => 'estado_1', 'nombre' => 'Estado 1', 'type' => 'text'],
            ['slug' => 'estado_2', 'nombre' => 'Estado 2', 'type' => 'text'],
            ['slug' => 'estado_3', 'nombre' => 'Estado 3', 'type' => 'text'],
            ['slug' => 'estado_4', 'nombre' => 'Estado 4', 'type' => 'text'],
            ['slug' => 'estado_5', 'nombre' => 'Estado 5', 'type' => 'text'],
            ['slug' => 'estado_6', 'nombre' => 'Estado 6', 'type' => 'text'],
            ['slug' => 'estado_7', 'nombre' => 'Estado 7', 'type' => 'text'],
            ['slug' => 'estado_8', 'nombre' => 'Estado 8', 'type' => 'text'],
            ['slug' => 'estado_9', 'nombre' => 'Estado 9', 'type' => 'text'],
            ['slug' => 'observaciones_0', 'nombre' => 'Observaciones 0', 'type' => 'text'],
            ['slug' => 'observaciones_1', 'nombre' => 'Observaciones 1', 'type' => 'text'],
            ['slug' => 'observaciones_2', 'nombre' => 'Observaciones 2', 'type' => 'text'],
            ['slug' => 'observaciones_3', 'nombre' => 'Observaciones 3', 'type' => 'text'],
            ['slug' => 'observaciones_4', 'nombre' => 'Observaciones 4', 'type' => 'text'],
            ['slug' => 'observaciones_5', 'nombre' => 'Observaciones 5', 'type' => 'text'],
            ['slug' => 'observaciones_6', 'nombre' => 'Observaciones 6', 'type' => 'text'],
            ['slug' => 'observaciones_7', 'nombre' => 'Observaciones 7', 'type' => 'text'],
            ['slug' => 'observaciones_8', 'nombre' => 'Observaciones 8', 'type' => 'text'],
            ['slug' => 'observaciones_9', 'nombre' => 'Observaciones 9', 'type' => 'text'],
            ['slug' => 'diferencia_favor_mda', 'nombre' => 'Diferencia favor MDA', 'type' => 'text'],
            ['slug' => 'privado_monto_pagado', 'nombre' => 'Privado monto pagado', 'type' => 'text'],
            ['slug' => 'monto_pagado_entidad', 'nombre' => 'Monto pagado entidad', 'type' => 'text'],
            ['slug' => 'monto_pagado_financiadora_comprador', 'nombre' => 'Monto pagado financiadora/comprador', 'type' => 'text'],
            ['slug' => 'entrega_unidad', 'nombre' => 'Entrega de unidad', 'type' => 'text'],
            ['slug' => 'notificacion_pago_finanzas', 'nombre' => 'Notificación de pago a finanzas', 'type' => 'text'],
            ['slug' => 'recepcion_documentacion', 'nombre' => 'Recepción documentación de cliente', 'type' => 'text'],
            ['slug' => 'entrega_documentacion', 'nombre' => 'Entrega documentación de cliente', 'type' => 'text'],
            ['slug' => 'valor_venta', 'nombre' => 'Validar Valor final venta', 'type' => 'text'],
            ['slug' => 'subsidio', 'nombre' => 'Validar Subsidio', 'type' => 'text'],
            ['slug' => 'credito_enlace', 'nombre' => 'Crédito Enlace', 'type' => 'text'],
            ['slug' => 'bono_captacion', 'nombre' => 'Validar Bono Captación', 'type' => 'text'],
            ['slug' => 'bono_integracion', 'nombre' => 'Validar Bono Integración', 'type' => 'text'],
            ['slug' => 'cupon_unidad_principal', 'nombre' => 'Validar Cupón Unidad Principal', 'type' => 'text'],
            ['slug' => 'cupon_estacionamiento', 'nombre' => 'Validar Cupón Estacionamiento', 'type' => 'text'],
            ['slug' => 'cupon_bodega', 'nombre' => 'Validar Cupón Bodega', 'type' => 'text'],
            ['slug' => 'cupon_ahorro_previo', 'nombre' => 'Validar Cupón Ahorro Previo', 'type' => 'text'],
            ['slug' => 'cupon_pago_contra_escritura', 'nombre' => 'Validar Cupón Pago contra Escritura', 'type' => 'text'],
            ['slug' => 'ahorro', 'nombre' => 'Validar Ahorro', 'type' => 'text'],
            ['slug' => 'escritura_pagada', 'nombre' => 'Validar Pago contra Escritura', 'type' => 'text'],
            ['slug' => 'pago_contra_promesa', 'nombre' => 'Validar Pago contra Promesa', 'type' => 'text'],
            ['slug' => 'chip', 'nombre' => 'Validar Crédito Hipotecario', 'type' => 'text'],
            ['slug' => 'pie', 'nombre' => 'Validar Pie', 'type' => 'text'],
            ['slug' => 'entidad_4', 'nombre' => 'Entidad 4', 'type' => 'text'],
            ['slug' => 'entidad_4_fecha', 'nombre' => 'Entidad 4 - Fecha de envío', 'type' => 'text'],
            ['slug' => 'entidad_4_estado', 'nombre' => 'Entidad 4 - Estado', 'type' => 'text'],
            ['slug' => 'entidad_5', 'nombre' => 'Entidad 5', 'type' => 'text'],
            ['slug' => 'entidad_5_fecha', 'nombre' => 'Entidad 5 - Fecha de envío', 'type' => 'text'],
            ['slug' => 'entidad_5_estado', 'nombre' => 'Entidad 5 - Estado', 'type' => 'text'],
            ['slug' => 'entidad_6', 'nombre' => 'Entidad 6', 'type' => 'text'],
            ['slug' => 'entidad_6_fecha', 'nombre' => 'Entidad 6 - Fecha de envío', 'type' => 'text'],
            ['slug' => 'entidad_6_estado', 'nombre' => 'Entidad 6 - Estado', 'type' => 'text'],
            ['slug' => 'credito_aprobado', 'nombre' => 'Credito Aprobado', 'type' => 'text'],
            ['slug' => 'en_formalizacion_credito', 'nombre' => 'En formalización de crédito', 'type' => 'text'],
            ['slug' => 'set_credito_firmado', 'nombre' => 'Set de crédito firmado', 'type' => 'text'],
            ['slug' => 'cliente_listo_escriturar', 'nombre' => 'Cliente listo para escriturar', 'type' => 'text'],
            ['slug' => 'pre_ode', 'nombre' => 'PRE ODE', 'type' => 'text'],
            ['slug' => 'ode_final','nombre' => 'ODE FINAL', 'type' => 'text'],
            ['slug' => 'ode_final_en_recepcion_final','nombre' => 'ODE FINAL CON RECEPCIÓN FINAL OK INSCRITA EN CBR', 'type' => 'text'],
            ['slug' => 'ode_recibido', 'nombre' => 'ODE RECIBIDO', 'type' => 'text'],
            ['slug' => 'ode_revisada_ok', 'nombre' => 'ODE REVISADA OK', 'type' => 'text'],
            ['slug' => 'cliente_notificado', 'nombre' => 'Cliente notificado', 'type' => 'select'],
            ['slug' => 'firma_cliente', 'nombre' => 'Firma cliente', 'type' => 'text'],
            ['slug' => 'envio_copia_fiscalia_banco', 'nombre' => 'envío copia fiscalia a banco alzante', 'type' => 'text'],
            ['slug' => 'firma_banco_alzante', 'nombre' => 'Firma banco alzante ', 'type' => 'text'],
            ['slug' => 'firma_banco_cliente', 'nombre' => 'Firma banco cliente', 'type' => 'text'],
            ['slug' => 'cierre_copias_ok', 'nombre' => 'Cierre de copias OK', 'type' => 'text'],
            ['slug' => 'ingreso_cbr_ok', 'nombre' => 'Ingreso cbr ok', 'type' => 'text'],
            ['slug' => 'egreso_cbr_ok', 'nombre' => 'Egreso CBR ok', 'type' => 'text'],
            ['slug' => 'carpeta_ahorro_completa', 'nombre' => 'Carpeta ahorro completa', 'type' => 'text'],
            ['slug' => 'presentacion_cobro_serviu', 'nombre' => 'Presentación de cobro Serviu ', 'type' => 'text'],
            ['slug' => 'pago_serviu', 'nombre' => 'Pago serviu', 'type' => 'text'],
            ['slug' => 'presentacion_cobro_ahorro', 'nombre' => 'Presentación de cobro ahorro', 'type' => 'text'],
            ['slug' => 'pago_ahorro', 'nombre' => 'Pago ahorro', 'type' => 'text'],
            ['slug' => 'copias_compraventa', 'nombre' => 'copias compraventa ok', 'type' => 'text'],
            ['slug' => 'carpeta_serviu_completa', 'nombre' => 'carpeta Serviu completa', 'type' => 'text'],
            ['slug' => 'ingreso_serviu_ok', 'nombre' => 'Ingreso a Serviu OK', 'type' => 'text'],
            ['slug' => 'pago_serviu_ok', 'nombre' => 'Pago serviu ok', 'type' => 'text'],
            ['slug' => 'ingreso_ahorro_ok', 'nombre' => 'Ingreso a ahorro OK', 'type' => 'text'],
            ['slug' => 'pago_ahorro_ok', 'nombre' => ' Pago ahorro ok', 'type' => 'text'],
            ['slug' => 'pago_chip_ok', 'nombre' => 'Pago Chip OK', 'type' => 'text'],
            ['slug' => 'pago_vale_notaria_ok', 'nombre' => 'Pagos vale vista notaria ok', 'type' => 'text'],
            ['slug' => 'medidor_agua_fria', 'nombre' => 'Medidor de agua fría', 'type' => 'text'],
            ['slug' => 'medidor_agua', 'nombre' => 'Medidor de agua', 'type' => 'text'],
            ['slug' => 'medidor_gas', 'nombre' => 'Medidor de gas', 'type' => 'text'],
            ['slug' => 'medidor_electrico', 'nombre' => 'Medidor Eléctrico', 'type' => 'text'],
            ['slug' => 'Instruccion_notarial_pago_en_notaria', 'nombre' => 'Instrucción notarial pago en notaría', 'type' => 'text'],
            ['slug' => 'instruccion_notarial_pago_egreso_CBR', 'nombre' => 'Instrucción notarial pago egreso CBR', 'type' => 'text'],
            ['slug' => 'fecha_ingreso_cbr', 'nombre' => 'Fecha de Ingreso CBR', 'type' => 'text'],
            ['slug' => 'entidad_formalizadora', 'nombre' => 'Entidad Formalizadora', 'type' => 'text'],
            ['slug' => 'monto_aprobado', 'nombre' => 'Monto Aprobado', 'type' => 'text'],
        ]);
    }

}