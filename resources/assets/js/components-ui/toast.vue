<template>
	<div class="mdai-toast">
		<div class="content d-flex align-items-center">
			<div class="icon" :class="type">
				<span class="fa" :class="checkIcon"></span>
			</div>
			<p v-text="text"></p>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			text: { type: String, required: true },
			type: { type: String, default: 'success' },
			time: { type: Number, default: 2000 }
		},
		computed: {
			checkIcon: function(){
				switch( this.type ){
					case 'success':
						return 'fa-check';
					case 'error':
						return 'fa-times';
					case 'info':
						return 'fa-info';
				}
			}
		},
		mounted: function(){
			setTimeout(() => {
				this.$store.commit('disableToast');
			}, this.time);
		}
	}
</script>

<style lang="scss" scoped>
@import './resources/assets/sass/mixins.scss';
@import './resources/assets/sass/variables.scss';

.mdai-toast{
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background: rgba(0,0,0,.8);
	z-index:9999;

	.content{
		position:absolute;
		right:30px;
		bottom:30px;
		padding: 15px;
		min-width: 370px;
		@include box;

		.icon{
			margin-right:15px;
			width: 38px;
			height: 38px;
			border-radius: 100%;
			text-align: center;
			color: #fff;
			padding: 11px 0;
			box-sizing: border-box;

			&.success{background:$color-success;}
			&.error{background:$color-error;}
			&.info{background:$color-info;}
		}
	}
}
</style>