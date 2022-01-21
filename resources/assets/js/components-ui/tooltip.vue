<template>
	<div class="tooltip" @mouseenter="active = !active" @mouseleave="active = !active">
		<slot></slot>

		<transition name="fade">
			<div class="tooltip-content" v-show="active && text" :class="[ position ]">
				<div class="tooltip-msg">
					<span v-text="text"></span>
				</div>
			</div>
		</transition>
	</div> 
</template>

<script>
	export default{
		props: {
			text: {
				type: String,
				default: ''
			},
			position: {
				type: String,
				default: 'bottom'
			}
		},
		data: function(){
			return {
				active: false
			};
		}
	}
</script>

<style scoped lang="scss">
	.tooltip{
	position:relative;
	display: inline-block;
	cursor:pointer;

	&-content{
		position:absolute !important; 
		text-align:center;
		color: #444; 
		transition: all .3s ease-in-out;
		z-index:97;
		overflow: visible !important;
		width:120px;

		.tooltip-msg{
			position:relative;
			border-radius:4px;
			padding:4px 16px;
			background:#333;
			color:#fff;
			font-size: 12px;
			border-radius: 5px;
		}

		&:before{ 
			content: "";
			position: absolute;
			width: 10px;
			height: 10px;
			background-color: #333;
			z-index: -1;
			transform: skew(0deg) rotate(45deg);
		}

		&.bottom{ 
			top: 100%; 
			margin-top: 4px;
			left: 50%;
			transform: translateX(-50%);

			&:before{
				top: -2px;
				left:0;
				right:0;
				margin:auto;
			}
		}

		&.top{ 
			bottom: 100%; 
			margin-bottom: 4px;
			left: 50%; 
			transform: translateX(-50%);

			&:before{
				bottom: -2px;
				left:0;
				right:0;
				margin:auto;
			}
		}
		
		&.left{ 
			right: 100%; 
			margin-right: 4px;
			top: 50%; 
			transform: translateY(-50%);

			&:before{
				right: -2px;
				top: 0;
				bottom: 0;
				margin: auto;
			}
		}

		&.right{ 
			left: 100%; 
			margin-left: 4px;
			top: 50%; 
			transform: translateY(-50%);

			&:before{
				left: -2px;
				top: 0;
				bottom: 0;
				margin: auto;
			}
		}
	}
}
</style>