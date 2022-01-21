<template>
	<button class="btn" @click.prevent="checkAction">
		{{ (!value ) ? text : '' }}
		<svg v-if="value" class="spinner" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
		   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
		</svg>
	</button>
</template>

<script>
	export default{
		props: {
			value: { type: Boolean, default: false },
			text: { type: String, required: true },
			action: { type: Function, required: false }
		},
		methods: {
			checkAction: function(){
				if( !this.value ){
					this.$emit('action');
				}
			}
		}
	}
</script>

<style lang="scss">
	$offset: 187;
	$duration: 1.4s;

	.btn{
		.spinner {
			position:absolute;
			left:0;
			top: 0;
			right:0;
			bottom:0;
			margin:auto;
			animation: rotator $duration linear infinite;
			width:24px;

			.path {
				stroke-dasharray: $offset;
				stroke-dashoffset: 0;
				transform-origin: center;
				stroke: #fff;
				animation:
					dash $duration ease-in-out infinite, 
			}
		}

		&-action{
			.spinner{
				width:18px !important;
			}
		}
	}

	@keyframes rotator {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(270deg); }
	}

	@keyframes dash {
		0% { stroke-dashoffset: $offset; }
		50% {
			stroke-dashoffset: $offset/4;
			transform:rotate(135deg);
		}
		100% {
			stroke-dashoffset: $offset;
			transform:rotate(450deg);
		}
	}
</style>