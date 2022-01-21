<template>
	<transition name="fade">
		<div class="lightbox h-100" v-if="value" @click="closed">
			<div class="lightbox-box h-100">
				<div class="container h-100">
					<div class="d-flex h-100 align-items-center">
						<div class="lightbox-content" :class="[LightboxSize]" ref="modal_box">
							<div class="lightbox-title">
								<div class="row align-items-center">
									<div class="col-10">
										<h6 class="heading-5" v-text="title"></h6>
									</div>
									<div class="col-2 text-right" v-if="close">
										<span class="fa fa-times close" @click.prevent="$emit('input', false)"></span>
									</div>
								</div>
							</div>
							<div class="content-box">
								<div :style="[limitHeight]">
									<div class="content">
										<slot ></slot>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
	export default{
		data: function(){
			return {
				windowHeight: null
			}
		},
		props:{
			value: { type: Boolean, default: false },
			title: { type: String },
			size: { type: [String, Number], default: 6 },
			close: { type: Boolean, default: true }
		},
		computed: {
			LightboxSize: function(){
				return 'p-0 col-12 col-lg-' + this.size;
			},
			limitHeight: function(){
				var windowHeight = this.windowHeight;
				var max = this.footerHasContent ? windowHeight * 40 / 100 : windowHeight * 70 / 100;
				return {
					maxHeight: max + 'px',
					overflow: 'auto'
				};
			}
		},
		methods:{
			checkHeight: function(){
				this.windowHeight = window.innerHeight;
				return this.limitHeight;
			},
			closeModal: function(){
				this.$emit('input', false);
				this.rmEscEvent();
			},
			closed: function(event){
				if( this.close ){
					var parentModal = null;
					var parents = this.$methods.getParents(event.target);
					
					parents.forEach(item => {
						if( item === this.$refs.modal_box ){
							parentModal = true;
						}
					});

					if( !event.target.classList.contains('lightbox-box') && parentModal === null ){
						this.$emit('input', false);
					}
				}
			},
			closeModalByEsc: function(e){
				if( e.keyCode === 27 ){
					this.closeModal();
				}
			},
			addEscEvent: function () {
				window.addEventListener('keyup', this.closeModalByEsc)
			},
			rmEscEvent: function () {
				window.removeEventListener('keyup', this.closeModalByEsc)
			}
		},
		created: function(){
			this.windowHeight = window.innerHeight;
		},
		updated: function(){
			this.checkHeight();
			window.addEventListener('resize', this.checkHeight);
			
			if( this.value && this.close ){
				this.addEscEvent();
			}
		}
	}
</script>

<style lang="scss">
@import './resources/assets/sass/mixins.scss';
@import './resources/assets/sass/variables.scss';

.lightbox{
	width: 100%;
	position: fixed;
	top: 0;
	left:0;
	right:0;
	bottom:0;
	background: rgba(0,0,0,.7);
	z-index: 100;

	.lightbox-box{
		.lightbox-content{
			width: 100%;
			margin: 0 auto;
			position: relative;
			@include box();

			.lightbox-title{
				padding: 16px;
				border-bottom-style: solid;
				border-bottom-width: 1px;
				border-bottom-color:#eee;

				.close{
					color:$color-text;
					cursor: pointer;
					@include transition();

					&:hover{
						opacity:.7;
					}
				}
			}

			.content-box {	
				// max-height: 80vh;
				.content{
					padding:16px;

					.btn-holder{
						display:block;
						margin-top: 16px;
						padding-top: 16px;
						border-top-style: solid;
						border-top-width: 1px;
						border-top-color:#eee;
					}
				}
			}
		}
	}
}
</style>