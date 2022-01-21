<template>
	<div class="input-cont" :class="classController">
		<div class="cont">
			<input :type="type" v-onlynumbers="number" :name="inputName" :value="value" :required="required" @input="input($event)" @focusout="focusOut" :minlength="min" :maxlength="max" :disabled="disabled" :readonly="readonly" :id="inputName">
			<label class="label" v-text="label" :for="inputName"></label>
		</div>
	</div>
</template>

<script>
export default{
	props: {
		type: { type: String, default: 'text' },
		name: { type: [String, Boolean], default: false },
		label: { type: String, required: true },
		required: { type: Boolean, default: false },
		disabled: { type: Boolean, default: false },
		readonly: { type: Boolean, default: false },
		number: { type: Boolean, default: false },
		min: { type: [String, Number, Boolean], default: false },
		max: { type: [String, Number, Boolean], default: false },
		value: { }
	},
	data: function(){
		return {
		};
	},
	computed: {
		hasContent: function(){
			return !this.$methods.isEmpty(this.value);
		},
		isValid: function(){
			// Input vacio
			if(!this.value) return true;

			// Input tiene algo, comenzamos la validacion
			let newValue = this.value || '';
			let validator = true;

			if( this.rut ){
				// Validamos si es RUT
				//validator = this.$methods.validarRUT(newValue);
			}
			else if( this.number ){
				// Validamos si es un numero
				let hasMin = true;
				let onlyNumbers = /^\d+$/.test(newValue);

				if( this.min ){
					hasMin = newValue.length >= this.min;
				}
				validator = (onlyNumbers && hasMin);
			}
			else if( this.type === 'email' ){
				// Validamos el formato del e-mail
				validator = this.$methods.checkEmail(newValue);
			}

			//console.log('validator =>', this.label, newValue, validator);
			return validator;
		},
		inputName: function(){
			return (this.name) ? this.name : `input_${this.$methods.numRandom(0, 99)}`;
		},
		classController: function(){
			// Retorna las clases al input
			return {
				active: this.hasContent,
				error: !this.isValid
			}
		},
	},
	methods: {
		input: function(event){
			let value = event.target.value;
			// Evento input, para el v-model
			this.$emit('input', value);
			// Evento keyup
			this.$emit('keyup', value, this.isValid);
		},
		focusOut: function(){
			this.focus = false;
			// Evento change
			this.$emit('change', this.value, this.isValid);
		}
	}
}
</script>
