<template>
<div v-cloak>
	<div class="content-block" v-cloak v-if="ready">
		<form @submit.prevent="agregar" >
			<mdai-resumen-cliente
		:info="promesa"
	></mdai-resumen-cliente>
			<mdai-box title="Liquidación de gastos operacionales">
			
				<template slot="content">
					<div class="row total mini align-items-center">
                        <div class="col-4">
							<div class="input-cont">
								<label class="label">Gastos operacionales pactados UF</label>
								<div class="cont">
									<input type="text" name="apellidos" readonly v-model="promesa.gops">
								</div>
							</div>
						</div>
                        <div class="col-4 " >
							<div class="input-cont">
								<label class="label">Gastos operacionales pagados UF</label>
								<div class="cont">
									<input type="text" name="apellidos" readonly  v-model="promesa.gops_pagados">
								</div>
							</div>
						</div>
						<div class="col-4 " >
							
							<div class="input-cont select">
								<label class="label">Entidad financiera</label>
								<div class="cont">
									<select required v-model="fields.entidades.value " :readonly="terminado" >
										<option value="0" disabled>Seleccione</option>
										<option v-for="(entidad, index) in entidades" v-bind:key="index" :value="entidad.nombre">
											{{ entidad.nombre }}
										</option>
									</select>
									<span class="fa fa-chevron-down input-icon"></span>
								</div>
							
						</div>
						</div>
						<div class="col-4">
							<div class="input-cont">
								<label class="label">Tasación</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="tasacion" required  v-model="fields.tasacion.value" :readonly="terminado">
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-cont">
								<label class="label">Estudio de titulos</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="titulos" required  v-model="fields.titulos.value" :readonly="terminado">
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-cont">
								<label class="label">Gastos notariales</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="notariales" required  v-model="fields.notariales.value " :readonly="terminado">
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-cont">
								<label class="label">Escrituración</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="escrituracion" required  v-model="fields.escrituracion.value" :readonly="terminado">
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-cont">
								<label class="label">Conservador Bienes raices</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="bienes_raices" required  v-model="fields.bienes_raices.value" :readonly="terminado">
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-cont">
								<label class="label">Impuesto al credito</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="impuesto_credito" required  v-model="fields.impuesto_credito.value" :readonly="terminado">
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="input-cont">
								<label class="label">Iva</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="iva" required  v-model="fields.iva.value " :readonly="terminado">
								</div>
							</div>
						</div>
                        <div class="col-4">
							<div class="input-cont">
								<label class="label">Gastos de administración</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="administracion" required  v-model="fields.administracion.value " :readonly="terminado">
								</div>
							</div>
						</div>
                        <div class="col-4">
							<div class="input-cont">
								<label class="label">Seguros</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="seguros" required  v-model="fields.seguros.value " :readonly="terminado">
								</div>
							</div>
						</div>
                        <div class="col-4">
							<div class="input-cont">
								<label class="label">Otros gastos varios</label>
								<div class="cont">
									<input type="text" v-onlynumbers v-on:keyup="suma()" name="gastos_varios" required  v-model="fields.gastos_varios.value " :readonly="terminado">
								</div>
							</div>
						</div>
                        <div class="col-4">
							<div class="input-cont">
								<label class="label">Total gastos operacionales</label>
								<div class="cont">
									<input type="text" name="total_gastos_op" required readonly v-onlynumbers v-model="fields.total_gastos_op.value " >
								</div>
							</div>
						</div>
                        <div class="col-4 ">
							<div class="input-cont">
								<label class="label " text-right>Diferencia por pagar</label>
								<div class="cont ">
									<input  type="text" name="diferencia_por_pagar" required :readonly="terminado"  v-model="fields.diferencia_por_pagar.value" >
								</div>
							</div>
						</div>
                        <div class="col-12">
							<div class="input-cont">
								<label class="label">Observaciones</label>
								<div class="cont">
									<textarea v-model="fields.observaciones.value" :readonly="terminado"></textarea>
								</div>
							</div>
						</div>
					
					</div>
				</template>
				<template slot="action">
					<div class="mt-15">
						<div class="row total mini align-items-center justify-content-end">
							<div class="col-6">
								<a :href="route('finanzas')" class="text-link">
									<span class="fa fa-chevron-left mr-5"></span>
									Volver atrás
								</a>
							</div>
							<div class="col-6">
								<div class="btn-holder text-right">
									
                  	<mdai-btn-action v-if="!terminado" class="btn-secondary" text="Guardar" @action="agregar" ></mdai-btn-action>
                    <button type="button" v-if="terminar && !terminado" @click.prevent="modalTerminar = true" class="btn btn-primary">
											Terminar
										</button>
								</div>
							</div>
						</div>
					</div>
				</template>
			</mdai-box>
		</form>
	</div>
		  <mdai-lightbox v-model="modalTerminar" title="Terminar actividad">
			<p>¿Está seguro que desea terminar la actividad?</p>

			<div class="btn-holder">
				<div class="row total align-items-center">
					<div class="col-6">
						<a href="#" class="text-link" @click.prevent="modalTerminar = false">
							Cancelar
						</a>
					</div>
					<div class="col-6 text-right">
						<mdai-btn-action class="btn-primary btn-action" text="Terminar actividad" v-model="action" @action="terminarActividad"></mdai-btn-action>
					</div>
				</div>
			</div>
		</mdai-lightbox>
	</div>
</template>

<script>
	export default{
		props: {
			promesa: {type: Object, required: true},
			nodo: {type: Object, required: true},
            entidades:{ type: Array, required: true}
		},
		data: function(){
			return {
				terminar: false,
				modalTerminar: false,
				action: false,
				dataFields: [1,82,83,84,85,86,87,88,89,90,91,92,93,94],
				fields: {
					tasacion: null,
					titulos: null,
					notariales: null,
					escrituracion: null,
					bienes_raices: null,
					impuesto_credito: null,
					iva: null,
					entidades: 0,
                   administracion: null,
                    seguros: null,
                    gastos_varios: null,
                    total_gastos_op: null,
                    diferencia_por_pagar: null,
                    observaciones: null

				},
				id_dw:null,
				id_nd: null,
				ready : false
			};
		},
		created: function(){
         
			console.log(this.entidades);
			console.log(this.promesa);
			this.obtenerDetalleWorkflow();
			
			
		},
		computed: {
			terminado: function(){

				return ( this.nodo.estado === 13 ) ? true : false;

			}
		},
		methods: {

			suma: function(){
				console.log(this.fields);
				
           if (this.fields.total_gastos_op.value== null) {
console.log("prueba0");
					 this.fields.total_gastos_op.value=0;
				}

				if (this.fields.tasacion.value == null) {
 
 console.log("prueba");

					this.fields.tasacion.value = 0;
				}
				 if(this.fields.titulos.value == null){
console.log("esta vacio");
					this.fields.titulos.value = 0;
				}
				if (this.fields.notariales.value == null){
					this.fields.notariales.value = 0;
				}
				 if(this.fields.escrituracion.value ==null){
					this.fields.escrituracion.value = 0;
				}
				 if(this.fields.bienes_raices.value == null){
					this.fields.bienes_raices.value = 0;
				}
				 if(this.fields.impuesto_credito.value == null){
					this.fields.impuesto_credito.value = 0;
				}
				 if(this.fields.iva.value == null){
					this.fields.iva.value = 0;
					
				}
				 if(this.fields.administracion.value == null){
					this.fields.administracion.value = 0;
				}
				if(this.fields.seguros.value == null){
					this.fields.seguros.value = 0;
				}
				 if(this.fields.gastos_varios.value == null){
					this.fields.gastos_varios.value = 0;
				}

					this.fields.total_gastos_op.value = parseInt(this.fields.tasacion.value, 10) +parseInt(this.fields.titulos.value, 10)
					+	parseInt(this.fields.notariales.value,10) 	+	parseInt(this.fields.escrituracion.value,10) + parseInt(this.fields.bienes_raices.value,10) 
					+	parseInt(this.fields.impuesto_credito.value,10)+ parseInt(this.fields.iva.value,10) +	parseInt(this.fields.administracion.value,10) 
					+ parseInt(this.fields.seguros.value,10) + parseInt(this.fields.gastos_varios.value,10);
				 
				 this.fields.total_gastos_op.value.toFixed(2);
        //  if (this.fields.total_gastos_op.value== null) {

				// 	 this.fields.total_gastos_op.value=0;
				//  }

				//  switch (valor) {
				// 	 case "tasacion":
				// 		 this.fields.total_gastos_op.value = this.fields.total_gastos_op.value + this.fields.tasacion.value;
				// 		 break;
				 
				// 	 default:
				// 		 break;
				//  }

				






				 
				 
				 
					


			},
			 checkTermino: function(){
				// Checkea si todo está correcto para terminar

        if( (!this.$methods.checkNullEmpty(this.fields.tasacion.value) && !this.$methods.checkNullEmpty(this.fields.titulos.value)
        && !this.$methods.checkNullEmpty(this.fields.notariales.value) && !this.$methods.checkNullEmpty(this.fields.escrituracion.value)
        && !this.$methods.checkNullEmpty(this.fields.bienes_raices.value) && !this.$methods.checkNullEmpty(this.fields.impuesto_credito.value)
        && !this.$methods.checkNullEmpty(this.fields.iva.value) && !this.$methods.checkNullEmpty(this.fields.entidades.value)
        && !this.$methods.checkNullEmpty(this.fields.administracion.value) && !this.$methods.checkNullEmpty(this.fields.seguros.value)
        && !this.$methods.checkNullEmpty(this.fields.gastos_varios.value) && !this.$methods.checkNullEmpty(this.fields.total_gastos_op.value) 
        && !this.$methods.checkNullEmpty(this.fields.diferencia_por_pagar.value) && !this.$methods.checkNullEmpty(this.fields.observaciones.value))){
					this.terminar = true;
				}else{
					this.terminar = false;
				}
			},
			getAlmacen: function(){
				// Obtenemos los campos requeridos
				
				this.$nodos.getAlmacen(this.dataFields, (response) => {
					this.fields = response;
					this.getDetalles();
				});
			},
			getDetalles: function(){
				// Buscamos en la base de datos los campos guardados
				console.log('id_nd =>', this.id_nd)
				this.$nodos.getDetalles({id: this.id_nd})
				.then((response) => {
					
					console.log(response);
					
					var response = response.data;
					var detalles = response.detalles;
                     console.log("los detalles son",detalles);
					 
					if( detalles ){
						// Hay campos guardados
						console.log("dentro");
						
						detalles.forEach((item, index) => {
							// Recorremos los datos
							if( !this.$methods.checkNullEmpty(item.valor) ){
								// Pasamos el valor del campo guardado al objeto
								this.fields[item.almacen.slug].value = item.valor;
							}
						});

						
						
					}
					this.ready = true;
					
				});},
			obtenerDetalleWorkflow: function(){
				// Obtenemos los campos requeridos
				console.log(this.promesa.opp);
				
				this.$http.get("/detalle-workflow/finanzas/get/"+this.promesa.opp)
				.then((response) => {
					console.log('la respuesta es', response.data)
					  this.id_dw = response.data.id_dw;
					  this.id_nd = response.data.id_nd;
					  console.log(this.id_dw);
					  console.log(this.id_nd);
					  this.getAlmacen();
				});
			}
			,
			agregar: function(){
			let data = { id_dw: this.id_dw, id_nd: this.id_nd , fields: this.fields };
      console.log("probando", data);
     
     this.$nodos.saveDetalles(data, (response) => {
					// Callback al guardar detalles
						console.log("le respuesta al guardar es", response);
					setTimeout(() => {
						console.log("le respuesta al guardar es", response);
						this.checkTermino();
						
					}, 1000);
				});
    
			},
			 terminarActividad: function(){
      
      // Método para terminar la actividad
				this.action = true;
				this.$http.post("/finanzas/terminar-nodo",{id_nodo: 97, id_dw: this.id_dw}).then((response) => {
          // Callback al terminar la actividad
          console.log("el controlador responde",response);
				window.location.replace( this.route('liquidacion.gastos', {opp:this.promesa.opp}) );
				})
				.finally(() => {
					setTimeout(() => {
						this.action = false;
					}, 1000);
				});
			

    }
		}
	}
</script>