<template>
	<div v-if="errors.length">
		<div class="errors-show" :class="classController">
			<h6 class="heading-5">Por favor revisa los siguiente errores:</h6>
			<ul class="error-list">
				<li v-for="(error, index) in errors" :key="index" v-text="error"></li>
			</ul>
		</div>
	</div>
</template>
<script>
	export default {
		props: {
			errors: {type: Array, required: true},
			position: {type: String, default: 'top'}
		},
		computed: {
			classController: function(){
				return {
					'mt-32': (this.position === 'bottom'),
					'mb-32': (this.position === 'top'),
				}
			}
		}
	}
</script>

<style lang="scss" scoped>
	.errors-show{
		padding:16px;
		border-radius:6px;
		background-color:#fde6e6;
    	border-color:#f3c4c4;

		h6{
			margin-bottom:16px;
			color:#c33;
		}

		.error-list{
			li{
				padding-left:16px;
				position:relative;
				font-size: 14px;
				color: #c33;

				&:after{
					content:"";
					display:block;
					width:5px;
					height:5px;
					border-radius:100%;
					background:#c33;
					position:absolute;
					left:0;
					top:0;
					bottom:0;
					margin:auto;
				}
			}
		}
	}
</style>