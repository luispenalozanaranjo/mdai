<template>
	<div class="box">
		<h2 class="heading-5 heading" v-if="title" v-text="title"></h2>

		<div class="content">
			<slot name="content"></slot>
		</div>

		<div class="action-holder" v-if="hasAction">
			<slot name="action"></slot>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			title: { type: String, default: null }
		},
		data: function(){
			return {
				hasAction: false
			};
		},
		created: function(){
			if( this.$slots.action ){
				this.hasAction = true;
			}
		}
	}
</script>

<style lang="scss" scoped>
@import './resources/assets/sass/mixins.scss';
@import './resources/assets/sass/variables.scss';

.box{
	@include box();

	.heading{
		padding:20px 16px;
		border-bottom-style:solid;
		border-bottom-width:1px;
		border-bottom-color:#eee;
	}

	.content{
		padding:20px 16px;
	}

	.action-holder{
		padding:20px 16px;
		position:relative;
		&:before{
			content: "";
			display: block;
			width: calc(100% - 30px);
			border-top: solid 1px #eee;
			margin: auto;
			position: absolute;
			top:0;
		}
	}
}
</style>