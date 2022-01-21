<?php

use Illuminate\Database\Seeder;
use App\Nodo;

class configNodosSeed extends Seeder{
    
    public function run(){
        Nodo::insert([
            [
                'num_nodo' => 50,
                'nombre_nodo' => 'n50',
                'actividad' => 'Subir documento',
                'subactividad' => 'Subir documento',
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            
            // Etapa 1 //
            [
                'num_nodo' => 99,
                'nombre_nodo' => 'n99',
                'actividad' => 'Promesado',
                'subactividad' => 'Inicio',
                'num_nodo_salida' => 200,
                'etapa' => 1,
                'exclude' => 1
            ],
            [
                'num_nodo' => 200,
                'nombre_nodo' => 'n200',
                'actividad' => 'Envío documentación oficina central',
                'subactividad' => 'Envío documentación',
                'num_nodo_salida' => 210,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 210,
                'nombre_nodo' => 'n210',
                'actividad' => 'Recepcion documentación oficina central',
                'subactividad' => 'Recepción documentación',
                'num_nodo_salida' => 211,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 211,
                'nombre_nodo' => 'n211',
                'actividad' => 'Recepción documentación oficina central',
                'subactividad' => 'Asignación de Revisor',
                'num_nodo_salida' => 220,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 220,
                'nombre_nodo' => 'n220',
                'actividad' => 'Revisión Checklist',
                'subactividad' => 'Checklist',
                'num_nodo_salida' => 0,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 230,
                'nombre_nodo' => 'n230',
                'actividad' => 'Revisión Checklist Vulnerable',
                'subactividad' => 'Checklist Vulnerable',
                'num_nodo_salida' => 260,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 240,
                'nombre_nodo' => 'n240',
                'actividad' => 'Revisión Checklist Medio',
                'subactividad' => 'Checklist Medio',
                'num_nodo_salida' => 260,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 250,
                'nombre_nodo' => 'n250',
                'actividad' => 'Revisión Checklist Privado',
                'subactividad' => 'Checklist Privado',
                'num_nodo_salida' => 251,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 251,
                'nombre_nodo' => 'n251',
                'actividad' => 'Revisión Checklist Privado',
                'subactividad' => 'Poliza Seguro',
                'num_nodo_salida' => 261,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 260,
                'nombre_nodo' => 'n260',
                'actividad' => 'Visado',
                'subactividad' => 'Visado Carpeta',
                'num_nodo_salida' => 270,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 261,
                'nombre_nodo' => 'n261',
                'actividad' => 'Visado',
                'subactividad' => 'Visado Carpeta',
                'num_nodo_salida' => 271,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 270,
                'nombre_nodo' => 'n270',
                'actividad' => 'Firma Gerencia',
                'subactividad' => 'Firma Representante',
                'num_nodo_salida' => 280,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 271,
                'nombre_nodo' => 'n271',
                'actividad' => 'Firma Gerencia',
                'subactividad' => 'Firma Representante',
                'num_nodo_salida' => 281,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 280,
                'nombre_nodo' => 'n280',
                'actividad' => 'Digitaliza Carpeta',
                'subactividad' => 'Digitaliza Carpeta (V / M)',
                'num_nodo_salida' => 300,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 281,
                'nombre_nodo' => 'n281',
                'actividad' => 'Digitaliza Carpeta',
                'subactividad' => 'Digitaliza Carpeta ( P ) ',
                'num_nodo_salida' => 290,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 290,
                'nombre_nodo' => 'n290',
                'actividad' => 'Revisión Carpeta Notaria',
                'subactividad' => 'Revisión de Abogado',
                'num_nodo_salida' => 291,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 291,
                'nombre_nodo' => 'n291',
                'actividad' => 'Revisión Carpeta Notaria',
                'subactividad' => 'Revisión de Notaria',
                'num_nodo_salida' => 301,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 300,
                'nombre_nodo' => 'n300',
                'actividad' => 'Digitaliza Promesa',
                'subactividad' => 'Digitaliza Promesa',
                'num_nodo_salida' => 310,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 301,
                'nombre_nodo' => 'n301',
                'actividad' => 'Digitaliza Promesa',
                'subactividad' => 'Digitaliza Promesa y Poliza',
                'num_nodo_salida' => 321,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 310,
                'nombre_nodo' => 'n310',
                'actividad' => 'Envío Oficina Venta',
                'subactividad' => 'Envío Promesa',
                'num_nodo_salida' => 320,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 320,
                'nombre_nodo' => 'n320',
                'actividad' => 'Recepción Oficina Venta',
                'subactividad' => 'Recepción documentos',
                'num_nodo_salida' => 330,
                'etapa' => 1,
                'exclude' => 0
            ],
            [
                'num_nodo' => 321,
                'nombre_nodo' => 'n321',
                'actividad' => 'Recepción Oficina Venta',
                'subactividad' => 'Enviado a Cliente',
                'num_nodo_salida' => 330,
                'etapa' => 1,
                'exclude' => 0
            ],
            // Fin Etapa 1 //
            
            // Etapa 2 //
            [
                'num_nodo' => 330,
                'nombre_nodo' => 'n330',
                'actividad' => 'Vigenteo 1 Revisión Checklist',
                'subactividad' => 'Checklist V1',
                'num_nodo_salida' => NULL,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 340,
                'nombre_nodo' => 'n340',
                'actividad' => 'Revisión Checklist Vulnerable',
                'subactividad' => 'Checklist Vulnerable V1',
                'num_nodo_salida' => 381,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 350,
                'nombre_nodo' => 'n350',
                'actividad' => 'Revisión Checklist Medio',
                'subactividad' => 'Checklist Medio V1',
                'num_nodo_salida' => 370,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 360,
                'nombre_nodo' => 'n360',
                'actividad' => 'Revisión Checklist Privado',
                'subactividad' => 'Checklist Privado V1',
                'num_nodo_salida' => 370,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 370,
                'nombre_nodo' => 'n370',
                'actividad' => 'Revisión Finanzas',
                'subactividad' => 'Checklist Finanzas ( M / P )',
                'num_nodo_salida' => 380,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 380,
                'nombre_nodo' => 'n380',
                'actividad' => 'Digitalizar Carpeta',
                'subactividad' => 'Digitalizar Carpeta',
                'num_nodo_salida' => 390,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 381,
                'nombre_nodo' => 'n380',
                'actividad' => 'Digitalizar Carpeta',
                'subactividad' => 'Digitalizar Carpeta',
                'num_nodo_salida' => 410,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 390,
                'nombre_nodo' => 'n390',
                'actividad' => 'Vigenteo 2',
                'subactividad' => 'Tipo de crédito',
                'num_nodo_salida' => 400,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 400,
                'nombre_nodo' => 'n400',
                'actividad' => 'Vigenteo 2 Revisión Checklist',
                'subactividad' => 'Checklist',
                'num_nodo_salida' => NULL,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 410,
                'nombre_nodo' => 'n410',
                'actividad' => 'Revisión Contado',
                'subactividad' => 'Checklist V2',
                'num_nodo_salida' => 460,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 420,
                'nombre_nodo' => 'n420',
                'actividad' => 'Revisión Gestión MDAI',
                'subactividad' => 'Checklist Medio V2 MDAI',
                'num_nodo_salida' => 440,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 430,
                'nombre_nodo' => 'n430',
                'actividad' => 'Revisión Gestión MDAI',
                'subactividad' => 'Checklist Privado V2 MDAI',
                'num_nodo_salida' => 440,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 440,
                'nombre_nodo' => 'n440',
                'actividad' => 'Revisión Riesgo',
                'subactividad' => 'Revisión Riesgo',
                'num_nodo_salida' => 460,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 450,
                'nombre_nodo' => 'n450',
                'actividad' => 'Solicitud Información Banco',
                'subactividad' => 'Solicitud Información Banco',
                'num_nodo_salida' => 460,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 460,
                'nombre_nodo' => 'n460',
                'actividad' => 'Revisión Finanzas',
                'subactividad' => 'Checklist Finanzas',
                'num_nodo_salida' => 470,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 470,
                'nombre_nodo' => 'n470',
                'actividad' => 'Digitalizar Carpeta',
                'subactividad' => 'Digitalizar Carpeta',
                'num_nodo_salida' => 471,
                'etapa' => 2,
                'exclude' => 0
            ],
            [
                'num_nodo' => 471,
                'nombre_nodo' => 'n471',
                'actividad' => 'Digitalizar Carpeta',
                'subactividad' => 'A Escriturar',
                'num_nodo_salida' => null,
                'etapa' => 2,
                'exclude' => 0
            ],
            // Fin Etapa 2 //


            // Etapa 4 //
            [
                'num_nodo' => 500,
                'nombre_nodo' => 'n500',
                'actividad' => 'Escrituración',
                'subactividad' => 'Confección de carpeta',
                'num_nodo_salida' => 510,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 510,
                'nombre_nodo' => 'n510',
                'actividad' => 'Escrituración',
                'subactividad' => 'Nominación y Adjudicación',
                'num_nodo_salida' => 511,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 511,
                'nombre_nodo' => 'n511',
                'actividad' => 'Escrituración',
                'subactividad' => 'Estado escrituración',
                'num_nodo_salida' => 512,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 512,
                'nombre_nodo' => 'n512',
                'actividad' => 'Escrituración',
                'subactividad' => 'Orden de escrituración',
                'num_nodo_salida' => NULL,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 520,
                'nombre_nodo' => 'n520',
                'actividad' => 'Escrituración',
                'subactividad' => 'Orden de escrituración V/M/P Contado',
                'num_nodo_salida' => 530,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 521,
                'nombre_nodo' => 'n521',
                'actividad' => 'Escrituración',
                'subactividad' => 'Orden de escrituración Banco',
                'num_nodo_salida' => 540,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 530,
                'nombre_nodo' => 'n530',
                'actividad' => 'Escrituración',
                'subactividad' => 'Borrador Escritura',
                'num_nodo_salida' => 540,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 540,
                'nombre_nodo' => 'n540',
                'actividad' => 'Escrituración',
                'subactividad' => 'Notificación Cliente Notaria',
                'num_nodo_salida' => 550,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 550,
                'nombre_nodo' => 'n550',
                'actividad' => 'Escrituración',
                'subactividad' => 'Comprobación de Firma',
                'num_nodo_salida' => 560,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 560,
                'nombre_nodo' => 'n560',
                'actividad' => 'Escrituración',
                'subactividad' => 'Cierre de copias',
                'num_nodo_salida' => 570,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 570,
                'nombre_nodo' => 'n570',
                'actividad' => 'Escrituración',
                'subactividad' => 'Ingreso Conservador Bienes Raíces',
                'num_nodo_salida' => 571,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 571,
                'nombre_nodo' => 'n571',
                'actividad' => 'Escrituración',
                'subactividad' => 'Egreso Conservador Bienes Raíces',
                'num_nodo_salida' => NULL,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 580,
                'nombre_nodo' => 'n580',
                'actividad' => 'Escrituración',
                'subactividad' => 'Egreso CBR VMP Contado',
                'num_nodo_salida' => 1000,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 581,
                'nombre_nodo' => 'n581',
                'actividad' => 'Escrituración',
                'subactividad' => 'Egreso CBR MP CHIP',
                'num_nodo_salida' => 1000,
                'etapa' => 4,
                'exclude' => 0
            ],
            [
                'num_nodo' => 590,
                'nombre_nodo' => 'n590',
                'actividad' => 'Escrituración',
                'subactividad' => 'Entrega de Unidad',
                'num_nodo_salida' => 591,
                'etapa' => 9,
                'exclude' => 0
            ],
            [
                'num_nodo' => 600,
                'nombre_nodo' => 'n600',
                'actividad' => 'Finanzas',
                'subactividad' => 'Liquidación de gastos',
                'num_nodo_salida' => 610,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 610,
                'nombre_nodo' => 'n610',
                'actividad' => 'Finanzas',
                'subactividad' => 'Pago operación',
                'num_nodo_salida' => 0,
                'etapa' => 8,
                'exclude' => 0
            ],
            // Fin etapa 4 //

            // Etapa 5 (Cambio de unidad) //
            [
                'num_nodo' => 115,
                'nombre_nodo' => 'n115',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Solicitud cambio de unidad',
                'num_nodo_salida' => 116,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 116,
                'nombre_nodo' => 'n116',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Aprobación comercial',
                'num_nodo_salida' => 128,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 117,
                'nombre_nodo' => 'n117',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Análisis de riesgo',
                'num_nodo_salida' => 129,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 118,
                'nombre_nodo' => 'n118',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Rechazo cambio de unidad',
                'num_nodo_salida' => 999,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 119,
                'nombre_nodo' => 'n119',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Generación nueva poliza',
                'num_nodo_salida' => 120,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 120,
                'nombre_nodo' => 'n120',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Generación de modificación unidad',
                'num_nodo_salida' => 121,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 121,
                'nombre_nodo' => 'n121',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Firma de cliente',
                'num_nodo_salida' => 122,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 122,
                'nombre_nodo' => 'n122',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Envío copia oficina central',
                'num_nodo_salida' => 123,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 123,
                'nombre_nodo' => 'n123',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Recepción documentos oficina central',
                'num_nodo_salida' => 124,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 124,
                'nombre_nodo' => 'n124',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Firma gerencia',
                'num_nodo_salida' => 125,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 125,
                'nombre_nodo' => 'n125',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Modifica Stock',
                'num_nodo_salida' => 126,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 126,
                'nombre_nodo' => 'n126',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Envío de copia a SDV',
                'num_nodo_salida' => 127,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 127,
                'nombre_nodo' => 'n127',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Entrega documentacion a cliente',
                'num_nodo_salida' => 999,
                'etapa' => 5,
                'exclude' => 0
            ],
            [
                'num_nodo' => 128,
                'nombre_nodo' => 'n128',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Análisis / Generar',
                'num_nodo_salida' => 0,
                'etapa' => 5,
                'exclude' => 0
            ],[
                'num_nodo' => 129,
                'nombre_nodo' => 'n129',
                'actividad' => 'Cambio Unidad',
                'subactividad' => 'Informar / Generar',
                'num_nodo_salida' => 0,
                'etapa' => 5,
                'exclude' => 0
            ],
            // Fin etapa 5 //

            //exepciones
            [
                'num_nodo' => 101,
                'nombre_nodo' => 'n101',
                'actividad' => 'Autorización check',
                'subactividad' => 'Check autorización',
                'num_nodo_salida' => 102,
                'etapa' =>  6,
                'exclude' => 0
            ],
            [
                'num_nodo' => 102,
                'nombre_nodo' => 'n102',
                'actividad' => 'Autorización excepción',
                'subactividad' => 'Solicitud documentación cliente',
                'num_nodo_salida' => 103,
                'etapa' => 6,
                'exclude' => 0
            ],
            [
                'num_nodo' => 103,
                'nombre_nodo' => 'n103',
                'actividad' => 'Autorización excepción',
                'subactividad' => 'Envío oficina central',
                'num_nodo_salida' => 104,
                'etapa' => 6,
                'exclude' => 0
            ],
            [
                'num_nodo' => 104,
                'nombre_nodo' => 'n104',
                'actividad' => 'Autorización excepción',
                'subactividad' => 'Recepción documentación',
                'num_nodo_salida' => 0,
                'etapa' => 6,
                'exclude' => 0
            ],

            // Desistimiento
            [
                'num_nodo' => 150,
                'nombre_nodo' => 'n150',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Solicitud cliente',
                'num_nodo_salida' => 151,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 151,
                'nombre_nodo' => 'n151',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Solicitud documentación cliente',
                'num_nodo_salida' => 152,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 152,
                'nombre_nodo' => 'n152',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Contactar al cliente',
                'num_nodo_salida' => 153,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 153,
                'nombre_nodo' => 'n153',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Resolución contacto',
                'num_nodo_salida' => 0,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 154,
                'nombre_nodo' => 'n154',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Aprobación desistimiento',
                'num_nodo_salida' => 155,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 155,
                'nombre_nodo' => 'n155',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Resolución aprobación',
                'num_nodo_salida' => 0,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 156,
                'nombre_nodo' => 'n156',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Resciliación y notificación renuncia',
                'num_nodo_salida' => 159,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 157,
                'nombre_nodo' => 'n157',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Ratificación de Finanzas',
                'num_nodo_salida' => 158,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 158,
                'nombre_nodo' => 'n158',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Notificación de renuncia y devolución GOPS',
                'num_nodo_salida' => 159,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 159,
                'nombre_nodo' => 'n159',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Envío documento SDV',
                'num_nodo_salida' => 160,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 160,
                'nombre_nodo' => 'n160',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Cliente Firma',
                'num_nodo_salida' => 161,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 161,
                'nombre_nodo' => 'n161',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Envío copias a oficina central',
                'num_nodo_salida' => 162,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 162,
                'nombre_nodo' => 'n162',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Digitalizar documentación',
                'num_nodo_salida' => 163,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 163,
                'nombre_nodo' => 'n163',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Recepción de documentación MDAI',
                'num_nodo_salida' => 164,
                'etapa' => 7,
                'exclude' => 0
            ],  
            [
                'num_nodo' => 164,
                'nombre_nodo' => 'n164',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Firma Gerencia',
                'num_nodo_salida' => 165,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 165,
                'nombre_nodo' => 'n165',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Digitalizar documentación',
                'num_nodo_salida' => 166,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 166,
                'nombre_nodo' => 'n166',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Notificación de renuncia y devolución',
                'num_nodo_salida' => 167,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 167,
                'nombre_nodo' => 'n167',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Digitalizar documentación',
                'num_nodo_salida' => 168,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 168,
                'nombre_nodo' => 'n168',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Revisión de Carpeta',
                'num_nodo_salida' => 169,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 169,
                'nombre_nodo' => 'n169',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Devolución documentos',
                'num_nodo_salida' => 170,
                'etapa' => 7,
                'exclude' => 0
            ],
            [
                'num_nodo' => 170,
                'nombre_nodo' => 'n170',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Envío documento cliente a SDV',
                'num_nodo_salida' => 171,
                'etapa' => 7,
                'exclude' => 0
            ],

            // Último nodo
            [
                'num_nodo' => 950,
                'nombre_nodo' => 'n950',
                'actividad' =>'Finanzas',
                'subactividad' => 'Liquidación Gastos Operacionales',
                'num_nodo_salida' => 0,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 960,
                'nombre_nodo' => 'n960',
                'actividad' =>'Finanzas',
                'subactividad' => 'Pago Operación',
                'num_nodo_salida' => 0,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 999,
                'nombre_nodo' => 'n999',
                'actividad' => 'Fin de proceso',
                'subactividad' => 'Fin de proceso',
                'num_nodo_salida' => 0,
                'etapa' => 8,
                'exclude' => 1
            ],
            [
                'num_nodo' => 1000,
                'nombre_nodo' => 'n1000',
                'actividad' => 'Terminado',
                'subactividad' => 'Terminado',
                'num_nodo_salida' => 0,
                'etapa' => 4,
                'exclude' => 1
            ],

            // Otros
            [
                'num_nodo' => 2000,
                'nombre_nodo' => 'n2000',
                'actividad' => 'Mantenedores',
                'subactividad' => NULL,
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 2001,
                'nombre_nodo' => 'n2001',
                'actividad' => 'Cargar planilla',
                'subactividad' => NULL,
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 2002,
                'nombre_nodo' => 'n2002',
                'actividad' => 'Mantenedor usuarios',
                'subactividad' => NULL,
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 2003,
                'nombre_nodo' => 'n2003',
                'actividad' => 'Mantenedor Entidades Financieras',
                'subactividad' => NULL,
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 2004,
                'nombre_nodo' => 'n2004',
                'actividad' => 'Mantenedor clientes',
                'subactividad' => NULL,
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 2005,
                'nombre_nodo' => 'n2005',
                'actividad' =>'Configurar PIS',
                'subactividad' => NULL,
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 2008,
                'nombre_nodo' => 'n2008',
                'actividad' => 'Mantenedor Checklist',
                'subactividad' => NULL,
                'num_nodo_salida' => NULL,
                'etapa' => 8,
                'exclude' => 0
            ],
            [
                'num_nodo' => 591,
                'nombre_nodo' => 'n591',
                'actividad' => 'Escrituración',
                'subactividad' => 'Digitalizar Entrega de Unidad',
                'num_nodo_salida' => 0,
                'etapa' => 9,
                'exclude' => 0
            ],
            [
                'num_nodo' => 171,
                'nombre_nodo' => 'n171',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Entrega documentacion cliente',
                'num_nodo_salida' => 172,
                'etapa' => 7,
                'exclude' => 1
            ],
            [
                'num_nodo' => 172,
                'nombre_nodo' => 'n172',
                'actividad' => 'Desistimiento',
                'subactividad' => 'Fin de proceso',
                'num_nodo_salida' => 0,
                'etapa' => 7,
                'exclude' => 1
            ],
            [
                'num_nodo' => 501,
                'nombre_nodo' => 'n501',
                'actividad' => 'Escrituración',
                'subactividad' => 'Nominación y Adjudicación Selector',
                'num_nodo_salida' => 0,
                'etapa' => 4,
                'exclude' => 0
            ],
        ]);
    }

}