<template>
	<div class="input-cont select">
		<div class="cont">
			<select :name="inputName" :id="inputName" :value="value" :disabled="checkDisabled" @change="change">
				<option selected disabled value="">Seleccione</option>
				<option value="" v-if="all">Todo</option>
				<option v-for="(item, index) in data" :key="index" :selected="value === item ? 'selected' : false" :value="checkValue(item)">
					{{ displayElement(item) }}
					<slot name="option" :item="item"></slot>
				</option>
			</select>
			<label class="label" v-text="label" :for="inputName"></label>
			<span class="fa fa-chevron-down input-icon"></span>
		</div>
	</div>
</template>

<script>
export default{
	props: {
		name: { type: [String, Boolean], default: false },
		label: { type: String, required: true },
		data: { type: Array, default: () => [] },
		all: { type: Boolean, default: false },
		val: { type: [String, Boolean], default: false },
		show: { type: [String, Boolean], default: false },
		disabled: { type: Boolean, default: false },
		value: {}
	},
	data: function(){
		return {
		};
	},
	computed: {
		checkDisabled: function(){
			// Si se paso el prop, lo devolvemos
			if( this.disabled ) return this.disabled;
			// Si la lista no tiene opciones (prop data vacia) definimos como disabled
			if( !this.data.length ) return true;
		},
		inputName: function(){
			// Retornamos un name aleatoreo
			return (this.name) ? this.name : `select_${this.$methods.numRandom(0, 99)}`;
		},
		optionSlot: function(){
			// Verificamos que los scopedSlots no esten vacios
			if( this.$scopedSlots ){
				// Verificamos que el slot del option tenga un valor
				return (typeof this.$scopedSlots.option !== 'undefined') ? true : false;
			}
		}
	},
	methods: {
		change: function(event){
			// Evento cuando se cambia el valor, actualizamos el v-model
			let value = event.target.value;
			this.$emit('input', value);
			this.$emit('change', value);
		},
		checkValue: function(item){
			// Verificamos si hay un key solicitado, de lo contrario el value es el mismo item
			if( this.val) return item[this.val];
			else return item;
		},
		displayElement: function(item){
			// Verificamos el valor del prop show y vemos que mostrarç
			let result = item;

			// Si tiene un valor en el prop show, lo mostramos
			if( this.show ) result = item[this.show];
			// Si tiene un custom slot (option)
			else if( this.optionSlot ) result = false;

			// Si el result tiene valor lo mostramos
			// de lo contrario, omitos esta interpolacion y mostramos el slot
			if( result ) return result;
		}
	}
}
</script>