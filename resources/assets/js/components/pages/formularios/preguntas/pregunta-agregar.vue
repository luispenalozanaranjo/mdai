<template>
	<div class="content-block">
        <div class="content-block">
            <mdai-accordion title="Resumen Checklist asociado" :active="true">
                <div class="form">
                    <div class="row total mini align-items-end">
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Nombre</label>
                                <p class="fw-semibold">{{ checklist.tipo }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Etapa</label>
                                <p class="fw-semibold">{{ checklist.etapa }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Número Nodo</label>
                                <p class="fw-semibold">{{ checklist.num_nodo }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Actividad</label>
                                <p class="fw-semibold">{{ checklist.nodo.actividad }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Subactividad</label>
                                <p class="fw-semibold">{{ checklist.nodo.subactividad }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </mdai-accordion>
        </div>

        <div class="content-block mt-32">
            <mdai-box title="Configuración pregunta">
                <template slot="content">
                    <div class="row total mini align-items-center">
                        <div class="col-12 col-sm-3">
                            <mdai-input v-model="fields.encabezado_pregunta" label="Nombre" />
                        </div>
                        <div class="col-12 col-sm-3">
                            <mdai-select v-model="fields.configuracion" label="Configuración campo" :data="preguntasConfig" val="value" show="name" @change="checkConfig" />
                        </div>
                        <div class="col-12 col-sm-3" v-if="fields.configuracion === 'entrada'">
                            <mdai-select v-model="fields.tipo" label="Tipo campo" :data="preguntasTipos" val="value" show="name" />
                        </div>
                        <div class="col-12 col-sm-3">
                            <div class="input-cont checklists">
                                <label class="label">Campo requerido</label>
                                <div class="radio">
                                    <input id="vacon" type="radio" name="vacaciones" value="1" v-model="fields.requerido">
                                    <label for="vacon">Sí</label>
                                </div>
                                <div class="radio">
                                    <input id="vacoff" type="radio" name="vacaciones" value="0" v-model="fields.requerido">
                                    <label for="vacoff">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-32" v-if="fields.configuracion === 'salida'">
                        <h3 class="heading-5 mb-16">Lógica de salida</h3>

                        <div class="row total mini align-items-center">
                            <div class="col-12 col-sm-3">
                                <mdai-select v-model="config.logica" :data="logicaConfig" val="value" show="name" label="Mostrar" />
                            </div>
                            <div class="col-12 col-sm-3" v-if="config.logica === 'matematica'">
                                <mdai-select v-model="config.matematica" :data="matConfig" val="value" show="name" label="Tipo de operación" />
                            </div>
                            <div class="col-12 col-sm-3" v-if="config.logica === 'valor'">
                                <mdai-select v-model="camposSalida[0].name" :data="showCampos" val="value" show="name" label="Campo" />
                            </div>
                        </div>

                        <div class="campos-list mt-32" v-if="camposSalida.length && config.logica === 'matematica'">
                            <div class="row total mini align-items-center">
                                <div class="col-12 col-sm-3">
                                    <div class="mb-16 d-flex align-items-center justify-content-between">
                                        <h3 class="heading-5">Campos</h3>
                                        <a href="#" class="campo-add" @click.prevent="agregarCampo">agregar campo</a>
                                    </div>

                                    <div class="campo-item" v-for="(campo, i) in camposSalida" :key="i">
                                        <mdai-select v-model="camposSalida[i].name" :data="showCampos" val="value" show="name" :label="`Campo ${i+1}`" />

                                        <div class="delete-item">
                                            <a href="#" class="d-flex align-items-center justify-content-center" @click.prevent="removeCampo(i)" v-if="i >= 1">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template slot="action">
                    <div class="btn-holder text-right">
                        <mdai-btn-action class="btn-primary" :class="{'btn-disabled': !validForm}" text="Agregar pregunta" v-model="adding" @action="add" />
                    </div>
                </template>
            </mdai-box>
        </div>
	</div>
</template>

<script>
	export default{
		props: {
			checklist: { type: Object, required: true },
		},
		data: function(){
			return {
				adding: false,
				camposSalida: [],
				logicaConfig: [
					{name: 'Valor', value: 'valor'},
					{name: 'Operación matemática', value: 'matematica'}
				],
				matConfig: [
					{name: 'Suma', value: 'SUMA'},
					{name: 'Resta', value: 'RESTA'},
					{name: 'División', value: 'DIV'},
					{name: 'Porcentaje', value: 'POR'}
				],
				campos: [
					{name: 'Subsidio', value: 'subsidio'},
					{name: 'Ahorro', value: 'ahorro'},
					{name: 'Bono captación', value: 'bono_captación'},
					{name: 'Bono Integración', value: 'bono_integración'},
					{name: 'Escritura', value: 'escritura'},
					{name: 'Precio Final OPP', value: 'precio_final_opp'},
					{name: 'CHIP', value: 'chip'},
					{name: 'Cupón Unidad Principal', value: 'cupon_unidad_principal'},
					{name: 'Cupón Estacionamiento', value: 'cupon_estacionamiento'},
					{name: 'Cupón Bodega', value: 'cupon_bodega'},
					{name: 'Cupón Ahorro Previo', value: 'cupon_ahorro_previo'},
					{name: 'Cupón Pago contra escritura', value: 'cupon_pago_contra_escritura'},
					{name: 'Pie', value: 'pie'},
					{name: 'Pie Pagado', value: 'pie_pagado'},
					{name: 'Pago contra promesa', value: 'pago_contra_promesa'},
					{name: 'Serie Subsidio', value: 'serie_subsidio'},
					{name: 'Número Subsidio', value: 'num_subsidio'},
					{name: 'Llamado Subsidio', value: 'llamado_subsidio'},
					{name: 'Año Subsidio', value: 'anio_subsidio'},
					{name: 'Banco', value: 'banco'},
					{name: 'Preaprobación Riesgo', value: 'preaprobacion_riesgo'},
					{name: 'Fecha cierre', value: 'fecha_cierre'},
					{name: 'Unidad principal', value: 'unidad_principal'},
					{name: 'Estacionamiento', value: 'estacionamiento'},
					{name: 'Bodega', value: 'bodega'},
					{name: 'GOPS', value: 'gops'},
					{name: 'GOPS pagados', value: 'gops_pagados'}
				],
				preguntasConfig: [
					{name: 'Entrada', value: 'entrada'},
					{name: 'Salida', value: 'salida'}
				],
				preguntasTipos: [
					{name: 'Check', value: null},
					{name: 'Texto', value: 'text'},
					{name: 'Fecha', value: 'date'},
				],
				config: {
					logica: 'valor',
					matematica: null
				},
				fields: {
                    encabezado_pregunta: null,
                    configuracion: null,
                    requerido: null,
                    marca_campo: null,
                    tipo: null,
                    id_form: this.checklist.id
                },
				response: null
			};
		},
		computed: {
			showCampos: function(){
				// Ordenamos alfabeticamente los campos
				return this.$methods.arraySort(this.campos, 'name');
			},
			marcaCampo: function(){
				// Seteamos el campo 'marca_campo' de la pregunta
				let campos = [];

				Object.entries(this.camposSalida).forEach(([key, value]) => {
					// Recorremos todos las keys del objeto campos salida
					if( value.name ) campos.push(value.name);
				});

				// Agregamos el tipo de operacion (si es matematica)
				let operacion = this.config.matematica ? this.config.matematica + '=' : '';

				// Devolvemos el string
				return operacion + campos.join(',');
			},
			validForm: function(){
				// Validamos los campos del formulario
				let required = [],
					fields = ['encabezado_pregunta'];

				Object.entries(this.fields).forEach(([key, value]) => {
					// Recorremos todos las keys del objeto fields
					if( fields.includes(key) ){
						let item_val = this.$methods.isEmpty(this.fields[key]);
						required.push(item_val);
					}
				});
				// Verificamos y retornamos si todos los elementos son falsos
				return required.every(item => item === false);
			}
		},
		methods: {
			add: function(){
				if( this.validForm && !this.adding ){
					this.adding = true;

					// Antes de enviar seteamos el valor del computed
					this.fields.marca_campo = this.marcaCampo;

					this.$http({
						method: 'post',
						url: route('checklists.preguntas.agregar.post'),
						data: this.fields
					})
					.then(response => {
						this.$store.commit('enableToast', {
							text: response.data.message,
							type: response.data.status ? 'success' : 'error'
						});

						if( response.data.status ){
							setTimeout(() => {
								window.location.href = response.data.redirect;
							}, 1500);
						}
						else{
							this.saving = false;
						}
					});
				}
			},
			checkConfig: function(){
				// Si es de salida, agregamos un campo
                this.fields.marca_campo = null;
                this.fields.tipo = null;
				if( this.fields.configuracion === 'salida' && !this.camposSalida.length ) this.agregarCampo();
			},
			agregarCampo: function(){
				// Preparamos los campos para la configuración de salida
				// this.$set(this.camposSalida, 'name', null);
				this.camposSalida.push({ name: null });
			},
			removeCampo: function(index){
				this.camposSalida.splice(index, 1);
			}
		}
	}
</script>

<style lang="scss" scoped>
.campos-list{
	.campo-add{
		font-size: 11px;
		text-transform: uppercase;
		color: $color-primary;
	}

	.campo-item{
		position:relative;

		.input-cont{
			margin-bottom:0 !important;
		}

		.delete-item{
			position: absolute;
			right: -44px;
			top:8px;

			a{
				display:inline-block;
				font-size: 14px;
				width: 28px;
				height: 28px;
				background: #eee;
				border-radius: 100%;
				color:$color-text;
				@include transition;

				&:hover{
					background: #ddd;
				}
			}
		}
		+ .campo-item{
			margin-top:8px;
		}
	}
}
</style>