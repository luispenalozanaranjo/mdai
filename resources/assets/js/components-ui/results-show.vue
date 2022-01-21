<template>
	<div class="results-show">
		<p>Mostrar</p>
		<div class="select">
			<select @change="change">
				<option>16</option>
				<option>24</option>
				<option>32</option>
			</select>
			<span class="fa fa-chevron-down"></span>
		</div>
		<p>{{ name }}.</p>
	</div>
</template>

<script>
	export default{
		props: {
			name: { type: String, default: 'registros' }
		},
		methods: {
			change: function(e){
				EventBus.$emit('changeShow', e.target.value);
			}
		}
	}
</script>