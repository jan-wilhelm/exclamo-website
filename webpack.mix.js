let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
	.js('resources/assets/js/app.js', 'public/js/app.js')
	.js('resources/assets/js/cases.js', 'public/js/cases.js')
	.js('resources/assets/js/landing.js', 'public/js/landing.js')
	.styles([
	    'node_modules/bootstrap/dist/css/bootstrap.min.css',
	    'node_modules/bootstrap-vue/dist/bootstrap-vue.min.css'
	], 'public/css/bootstrap.css')
	.styles('node_modules/vue-multiselect/dist/vue-multiselect.min.css', 'public/css/vue-multiselect.css')
	.sass('resources/assets/sass/landing.scss', 'public/css/landing.css')
	.sass('resources/assets/sass/app.scss', 'public/css/style.css')
	.styles('node_modules/aos/dist/aos.css', 'public/css/aos.css');

