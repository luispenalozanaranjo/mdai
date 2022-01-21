<template>
	<div class="s-accordion" :class="[group]" ref="accordion">
		<div class="accordion-title">
			<a @click.prevent="clickAccordion" href="#">
				<h3 class="heading-5" v-text="title"></h3>
				<span class="down fa fa-chevron-down" aria-hidden="true"></span>
			</a>
		</div>
		<div class="accordion-content" ref="accordion_content">
			<div class="content">
				<slot></slot>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			title: { type: String, required: true },
			group: { type: String, default: null },
			active: { type: Boolean, default: false }
		},
		mounted: function(){
			if( this.active ){
				this.$refs.accordion.classList.toggle("active");
				this.toggleAccordion( this.$refs.accordion_content );
			}
		},
		methods: {
			closeAccordion: function( elem ){
				elem.style.maxHeight = null;
			},
			toggleAccordion: function( elem ){
				if( elem.style.maxHeight ){
					elem.style.maxHeight = null;
				}
				else{
					elem.style.maxHeight = elem.scrollHeight + "px";
				}
			},
			clickAccordion: function(){
				if( this.group ){
					// Tiene grupo definido
					var elemsGroup = document.querySelectorAll('.' + this.group);
					if( elemsGroup.length > 1 ){
						// Hay mas de un elemento en el mismo grupo
						elemsGroup.forEach(elem =>{
							var content = elem.querySelector('.accordion-content');
							if( elem !== this.$refs.accordion ){
								elem.classList.remove("active");
								this.closeAccordion( content );
							}
						});
					}
				}

				this.$refs.accordion.classList.toggle("active");
				this.toggleAccordion( this.$refs.accordion_content );
			}
		}
	}
</script>

<style lang="scss" scoped>
.s-accordion{
	@include box;
	@include transition;

	&:last-of-type{margin-bottom:0;}

	&.active{
		.accordion-title{
			border-bottom:solid 1px #f0f0f0;
			.down{transform: rotate(180deg);}
		}
	}

	.accordion-title{
		a{
			font-size:16px;
			color: $color-text;
			position:relative;
			display:block;
			padding:16px;
			@include transition;

			&:hover{
				background: #f9f9f9;
			}

			> *{
				display:inline-block;
				vertical-align: middle;
			}

			.down{
				@include transition;
				position: absolute;
				right: 30px;
				bottom:0;
				top: 0;
				margin:auto;
				color:$color-primary;
				height:16px;
				font-size:16px;
			}
		}
	}

	.accordion-content{
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.2s ease-out;
		
		.content{
			padding:20px 16px;
		}
	}
}
</style>