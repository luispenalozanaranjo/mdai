const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
	resolve: {
		alias: {
			ziggy: path.resolve('vendor/tightenco/ziggy/dist/js/route.js'),
			'@': path.resolve('resources/assets/sass')
		}
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				loader: "sass-loader",
				options: {
				data: `
					@import "~@/mixins.scss";
					@import "~@/variables.scss";
				 `
				}
			}
		]
	}
});

mix.js('resources/assets/js/app.js', 'public/js')
	.sass('resources/assets/sass/app.scss', 'public/css');

if( mix.inProduction() ){
	mix.version();
}