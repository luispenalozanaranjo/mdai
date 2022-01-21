<template>
  <div  v-cloak >
    <div class="content-block" v-if="ready" >
    <form @submit.prevent="agregar" >
      	<mdai-resumen-cliente
		:info="promesa"
	></mdai-resumen-cliente>
      <mdai-box title="Pago operacion">
        <template slot="content">
          <div class="table">
            <table>
              <thead>
                <tr>
                  <th>Items</th>
                  <th>Vivet</th>
                  <th>Credito Enlace</th>
                  <th>Otros creditos</th>
                  <th>Suma total</th>
                  <th>Estado</th>
                  <th>Observación</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(nombre, index) in nombres">
                  <td>{{nombre }}   <mdai-tooltip  v-bind:text="`Este item pertenece a ${entidad_item[index]}`"  position="top">
                      <span class="fa fa-question-circle"></span>
                    </mdai-tooltip></td>
                  <td>
                    
                    <div class="row">
                      <div class="col-10">
                        <div class="input-cont">
                          <input name="vivet" v-model="fields2['vivet_' + index]" readonly />
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-10">
                        <div class="input-cont">
                          <input name="credito_enlace" v-on:keyup="suma(index)" v-model="fields['credito_enlace_' + index].value" :readonly="terminado" v-onlynumbers placeholder="Ingrese..." />
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-10">
                        <div class="input-cont">
                          <input name="otros_creditos" v-on:keyup="suma(index)" v-model="fields['otros_creditos_' + index].value" :readonly="terminado" v-onlynumbers placeholder="Ingrese..." />
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-10">
                        <div class="input-cont">
                          <input name="suma_total" v-model="fields['suma_total_' + index].value" v-onlynumbers readonly />
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-10">
                        <div class="input-cont">
                          <input name="estado" v-model="fields['estado_' + index].value" readonly  />
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="row">
                      <div class="col-12">
                        <div class="input-cont">
                          <input name="observaciones" v-model="fields['observaciones_' + index].value" :readonly="terminado"  placeholder="Ingrese Valor..." />
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                
              </tbody>
            </table>
          </div>
           <div class="row" >
                      <div class="col-6" style="margin-top: 35px;">
                        <div class="input-cont">
							<label class="label">Monto pagado entidad financiadora comprador</label>
                          <input name="monto_pagado" v-model="fields.monto_pagado_financiadora_comprador.value" :readonly="terminado" placeholder="Ingrese Valor..." />
                        </div>
                      </div>
                   
					
                      <div class="col-6" style="margin-top: 35px;">
                        <div class="input-cont">
							<label class="label">Montopagado entidad alzante</label>
                          <input name="monto_entidad" v-model="fields.monto_pagado_entidad.value" :readonly="terminado" placeholder="Ingrese Valor..." />
                        </div>
                      </div>
<div class="col-6" style="margin-top: 35px;">
                        <div class="input-cont">
							<label class="label">Diferencia por pagar</label>
                          <input name="fiderencia_por_pagar" v-model="fields.diferencia_por_pagar.value" :readonly="terminado" placeholder="Ingrese Valor..." />
                        </div>
                      </div>

<div class="col-6" style="margin-top: 35px;">
                        <div class="input-cont">
							<label class="label">Diferencia a favor mda</label>
                          <input name="diferencia_mda" v-model="fields.diferencia_favor_mda.value" :readonly="terminado" placeholder="Ingrese Valor..." />
                        </div>
                      </div>

					  <div class="col-6" style="margin-top: 35px;">
                        <div class="input-cont">
							<label class="label">Privado Monto pagado</label>
                          <input name="privado_pagado" v-model="fields.privado_monto_pagado.value" :readonly="terminado" placeholder="Ingrese Valor..." />
                        </div>
                      </div>

					  <div class="col-12" style="margin-top: 35px;">
                        <div class="input-cont">
							<label class="label">Observaciones</label>
                          <textarea v-model="fields.observaciones.value" :readonly="terminado"></textarea>
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
                  <a v-if="terminado" class="btn btn-secondary">Pagado</a>
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
    
	entidades: {type: Array, required: true},
  nodo:{type: Object, required: true},
	promesa: {type: Object, required: true}
  },
  data: function() {
    return {
      ready : false,
      action: false,
      terminar: false,
     
			modalTerminar: false,
      dataFields: [1,94, 95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114
      ,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136
      ,137,138,139,140,141,142,143,144,145,146,147,148,149],
      id_dw: null,
      id_nd: null,
	nombres: ['Subsidio', 'Ahorro', 'Bono Captación', 
	'Bono Integracion', "Pie",'Pago contra escritura', 'Pago contra promesa', 
  'Crédito Hipotecario', 'Total cupones', "Valor final venta",],
  entidad_item: ['Serviu', 'Cliente', 'Serviu', 
	'Serviu', 'Cliente','Cliente', 'Cliente', 
	'Banco', 'MDA', "",],
      fields: {
        
      },
      fields2: {}
    };
  },
  created: function() {
	// console.log(this.entidades);
 //  console.log(this.nodo);
	this.fields2.vivet_0 = this.promesa.subsidio;
	this.fields2.vivet_1 = this.promesa.ahorro;
	this.fields2.vivet_2 = this.promesa.bono_captación;
	this.fields2.vivet_3 = this.promesa.bono_integración;
	this.fields2.vivet_4 = this.promesa.pie;
	this.fields2.vivet_5 = this.promesa.escritura;
	this.fields2.vivet_6 = this.promesa.pago_contra_promesa;
	this.fields2.vivet_7 = this.promesa.chip;
  this.fields2.vivet_8 = this.promesa.cupon_unidad_principal + this.promesa.cupon_estacionamiento + this.promesa.cupon_bodega + this.promesa.cupon_ahorro_previo + this.promesa.cupon_pago_contra_escritura; 
  this.fields2.vivet_9 = (this.fields2.vivet_0 + this.fields2.vivet_1 + this.fields2.vivet_2 + this.fields2.vivet_3 + this.fields2.vivet_4 + this.fields2.vivet_5 + this.fields2.vivet_6 + this.fields2.vivet_7) - this.fields2.vivet_8;
  

 
 this.obtenerDetalleWorkflow();
// console.log("fields", this.fields);

 },
 computed: {
			terminado: function(){
				return ( this.nodo.estado === 13 ) ? true : false;
			}
		},
  methods: {
    checkTermino: function(){
				// Checkea si todo está correcto para terminar

        if( (!this.$methods.checkNullEmpty(this.fields.credito_enlace_0.value) && !this.$methods.checkNullEmpty(this.fields.credito_enlace_1.value)
        && !this.$methods.checkNullEmpty(this.fields.credito_enlace_2.value) && !this.$methods.checkNullEmpty(this.fields.credito_enlace_3.value)
        && !this.$methods.checkNullEmpty(this.fields.credito_enlace_4.value) && !this.$methods.checkNullEmpty(this.fields.credito_enlace_5.value)
        && !this.$methods.checkNullEmpty(this.fields.credito_enlace_6.value) && !this.$methods.checkNullEmpty(this.fields.credito_enlace_7.value)
        && !this.$methods.checkNullEmpty(this.fields.credito_enlace_8.value) && !this.$methods.checkNullEmpty(this.fields.credito_enlace_9.value)
        && !this.$methods.checkNullEmpty(this.fields.otros_creditos_0.value) && !this.$methods.checkNullEmpty(this.fields.otros_creditos_1.value) 
        && !this.$methods.checkNullEmpty(this.fields.otros_creditos_2.value) && !this.$methods.checkNullEmpty(this.fields.otros_creditos_3.value) 
        && !this.$methods.checkNullEmpty(this.fields.otros_creditos_4.value) && !this.$methods.checkNullEmpty(this.fields.otros_creditos_5.value)
        && !this.$methods.checkNullEmpty(this.fields.otros_creditos_6.value) && !this.$methods.checkNullEmpty(this.fields.otros_creditos_7.value)
        && !this.$methods.checkNullEmpty(this.fields.otros_creditos_8.value) && !this.$methods.checkNullEmpty(this.fields.otros_creditos_9.value)
        && !this.$methods.checkNullEmpty(this.fields.monto_pagado_financiadora_comprador.value) && !this.$methods.checkNullEmpty(this.fields.monto_pagado_entidad.value)
        && !this.$methods.checkNullEmpty(this.fields.diferencia_por_pagar.value) && !this.$methods.checkNullEmpty(this.fields.diferencia_favor_mda.value) 
        &&  !this.$methods.checkNullEmpty(this.fields.diferencia_favor_mda.value) && !this.$methods.checkNullEmpty(this.fields.privado_monto_pagado.value )
        &&  !this.$methods.checkNullEmpty(this.fields.observaciones.value )  )){
					this.terminar = true;
				}else{
					this.terminar = false;
				}
			},
    terminarActividad: function(){
      
      // Método para terminar la actividad
				this.action = true;
				this.$http.post("/finanzas/terminar-nodo",{id_nodo: 98, id_dw: this.id_dw}).then((response) => {
          // Callback al terminar la actividad
          // console.log("el controlador responde",response);
				window.location.replace( this.route('pago.operacion', {opp:this.promesa.opp}) );
				})
				.finally(() => {
					setTimeout(() => {
						this.action = false;
					}, 1000);
				});
			

    },
    
    suma: function(index){

        switch (index) {
          case 0:
            
            if ((this.fields.credito_enlace_0.value > this.fields2.vivet_0)||(this.fields.otros_creditos_0.value>this.fields2.vivet_0)||(this.fields.suma_total_0.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_0.value = 0;
              this.fields.credito_enlace_0.value = 0;
              this.fields.otros_creditos_0.value = 0;
              this.fields.estado_0.value = null;
            }
            else{
                  this.fields.suma_total_0.value = this.fields2.vivet_0 - this.fields.credito_enlace_0.value - this.fields.otros_creditos_0.value ;
                  this.fields.suma_total_0.value.toFixed(2);
                  if (this.fields.suma_total_0.value>= 0) {
                    this.fields.estado_0.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_0.value = null;
                  }
            }
            
            break;

           case 1:
            
            if ((this.fields.credito_enlace_1.value > this.fields2.vivet_1)||(this.fields.otros_creditos_1.value>this.fields2.vivet_1)||(this.fields.suma_total_1.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_1.value = 0;
              this.fields.credito_enlace_1.value = 0;
              this.fields.otros_creditos_1.value = 0;
              this.fields.estado_1.value = null;
            }
            else{
                  this.fields.suma_total_1.value = this.fields2.vivet_1 - this.fields.credito_enlace_1.value - this.fields.otros_creditos_1.value ;
                  this.fields.suma_total_1.value.toFixed(2);
                  if (this.fields.suma_total_1.value>= 0) {
                    this.fields.estado_1.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_1.value = null;
                  }
            }
            
            break;

            case 2:
            
            if ((this.fields.credito_enlace_2.value > this.fields2.vivet_2)||(this.fields.otros_creditos_2.value>this.fields2.vivet_2)||(this.fields.suma_total_2.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_2.value = 0;
              this.fields.credito_enlace_2.value = 0;
              this.fields.otros_creditos_2.value = 0;
              this.fields.estado_2.value = null;
            }
            else{
                  this.fields.suma_total_2.value = this.fields2.vivet_2 - this.fields.credito_enlace_2.value - this.fields.otros_creditos_2.value ;
                  this.fields.suma_total_2.value.toFixed(2);
                  if (this.fields.suma_total_2.value>= 0) {
                    this.fields.estado_2.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_2.value = null;
                  }
            }
            
            break;

              case 3:
            
            if ((this.fields.credito_enlace_3.value > this.fields2.vivet_3)||(this.fields.otros_creditos_3.value>this.fields2.vivet_3)||(this.fields.suma_total_3.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_3.value = 0;
              this.fields.credito_enlace_3.value = 0;
              this.fields.otros_creditos_3.value = 0;
              this.fields.estado_3.value = null;
            }
            else{
                  this.fields.suma_total_3.value = this.fields2.vivet_3 - this.fields.credito_enlace_3.value - this.fields.otros_creditos_3.value ;
                  
                  if (this.fields.suma_total_3.value>= 0) {
                    this.fields.estado_3.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_3.value = null;
                  }
            }
            
            break;

              case 4:
            
            if ((this.fields.credito_enlace_4.value > this.fields2.vivet_4)||(this.fields.otros_creditos_4.value>this.fields2.vivet_4)||(this.fields.suma_total_4.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_4.value = 0;
              this.fields.credito_enlace_4.value = 0;
              this.fields.otros_creditos_4.value = 0;
              this.fields.estado_4.value = null;
            }
            else{
                  this.fields.suma_total_4.value = this.fields2.vivet_4 - this.fields.credito_enlace_4.value - this.fields.otros_creditos_4.value ;
                  this.fields.suma_total_4.value.toFixed(2);
                  if (this.fields.suma_total_4.value>= 0) {
                    this.fields.estado_4.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_4.value = null;
                  }
            }
            
            break;

              case 5:
            
            if ((this.fields.credito_enlace_5.value > this.fields2.vivet_5)||(this.fields.otros_creditos_5.value>this.fields2.vivet_5)||(this.fields.suma_total_5.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_5.value = 0;
              this.fields.credito_enlace_5.value = 0;
              this.fields.otros_creditos_5.value = 0;
              this.fields.estado_5.value = null;
            }
            else{
                  this.fields.suma_total_5.value = this.fields2.vivet_5 - this.fields.credito_enlace_5.value - this.fields.otros_creditos_5.value;
             this.fields.suma_total_5.value.toFixed(2);
            if (this.fields.suma_total_5.value>= 0) {
                    this.fields.estado_5.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_5.value = null;
                  }
            }
            
            break;

              case 6:
            
            if ((this.fields.credito_enlace_6.value > this.fields2.vivet_6)||(this.fields.otros_creditos_6.value>this.fields2.vivet_6)||(this.fields.suma_total_6.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_6.value = 0;
              this.fields.credito_enlace_6.value = 0;
              this.fields.otros_creditos_6.value = 0;
              this.fields.estado_6.value = null;
            }
            else{
                  this.fields.suma_total_6.value = this.fields2.vivet_6 - this.fields.credito_enlace_6.value - this.fields.otros_creditos_6.value ;
           this.fields.suma_total_6.value.toFixed(2);
           if (this.fields.suma_total_6.value>= 0) {
                    this.fields.estado_6.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_6.value = null;
                  }
           }
            
            break;

             case 7:
            
            if ((this.fields.credito_enlace_7.value > this.fields2.vivet_7)||(this.fields.otros_creditos_7.value>this.fields2.vivet_7)||(this.fields.suma_total_7.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_7.value = 0;
              this.fields.credito_enlace_7.value = 0;
              this.fields.otros_creditos_7.value = 0;
              this.fields.estado_7.value = null;
            }
            else{
                  this.fields.suma_total_7.value = this.fields2.vivet_7 - this.fields.credito_enlace_7.value - this.fields.otros_creditos_7.value ;
            this.fields.suma_total_7.value.toFixed(2);
            if (this.fields.suma_total_7.value>= 0) {
                    this.fields.estado_7.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_7.value = null;
                  }
            }
            
            break;

             case 8:
            
            if ((this.fields.credito_enlace_8.value > this.fields2.vivet_8)||(this.fields.otros_creditos_8.value>this.fields2.vivet_8)||(this.fields.suma_total_8.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_8.value = 0;
              this.fields.credito_enlace_8.value = 0;
              this.fields.otros_creditos_8.value = 0;
              this.fields.estado_8.value = null;
            }
            else{
                  this.fields.suma_total_8.value = this.fields2.vivet_8 - this.fields.credito_enlace_8.value - this.fields.otros_creditos_8.value ;
                 this.fields.suma_total_8.value.toFixed(2);
                 if (this.fields.suma_total_8.value>= 0) {
                    this.fields.estado_8.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_8.value = null;
                  if (this.fields.suma_total_8.value>= 0) {
                    this.fields.estado_8.value = "OK";
                    
                  }
                  else{
                    this.fields.estado_8.value = null;
                  }
                  }
            }
            
            break;

             case 9:
            
            if ((this.fields.credito_enlace_9.value > this.fields2.vivet_9)||(this.fields.otros_creditos_9.value>this.fields2.vivet_9)||(this.fields.suma_total_9.value < 0)) {
              alert("no puede ingresar un numero mayor");
              this.fields.suma_total_9.value = 0;
              this.fields.credito_enlace_9.value = 0;
              this.fields.otros_creditos_9.value = 0;
              this.fields.estado_9.value = null;
            }
            else{
                  this.fields.suma_total_9.value = this.fields2.vivet_9 - this.fields.credito_enlace_9.value - this.fields.otros_creditos_9.value ;
                  this.fields.suma_total_9.value.toFixed(2);
                  if (this.fields.suma_total_9.value>= 0) {
                            this.fields.estado_9.value = "OK";
                            
                          }
                          else{
                            this.fields.estado_9.value = null;
                          }
           
           }
            
            break;
        

          
         
        }
       
       
       
     
    
      
    },
    getAlmacen: function(){
			
				this.$nodos.getAlmacen(this.dataFields, (response) => {
          this.fields = response;
          // console.log("valor de fields",response.credito_enlace_0.value);
          
					this.getDetalles();
				});
			},
			getDetalles: function(){
				// Buscamos en la base de datos los campos guardados
				this.$nodos.getDetalles({id: this.id_nd})
				.then((response) => {
					
					// console.log(response);
					
					var response = response.data;
					var detalles = response.detalles;
                     // console.log("los detalles son",detalles);
					 
					if( detalles ){
						// Hay campos guardados
						// console.log("dentro");
						
						detalles.forEach((item, index) => {

							// Recorremos los datos
							if( !this.$methods.checkNullEmpty(item.valor)){
								// Pasamos el valor del campo guardado al objeto
                this.fields[item.almacen.slug].value = item.valor;
                // console.log(item.valor);
                
							}
						});

						
						
					}
          this.ready = true;
          // console.log('ya es true');
          
					
				});},
    obtenerDetalleWorkflow: function(){
				// Obtenemos los campos requeridos
				// console.log(this.promesa.opp);
				
				this.$http.get("/detalle-workflow/finanzas/get/"+this.promesa.opp+"/pago").then((response) => {
					// console.log('la respuesta es', response)
					  this.id_dw = response.data.id_dw;
					  this.id_nd = response.data.id_nd;
					  // console.log(this.id_dw);
					  // console.log(this.id_nd);
					  this.getAlmacen();

				});
      },
      agregar: function(){
			let data = { id_dw: this.id_dw, id_nd: this.id_nd , fields: this.fields };
      // console.log("probando", data);
     
     this.$nodos.saveDetalles(data, (response) => {
					// Callback al guardar detalles
						// console.log("le respuesta al guardar es", response);
					setTimeout(() => {
						// console.log("le respuesta al guardar es", response);
						this.checkTermino();
					}, 1000);
				});
    
			}
  }
};
</script>