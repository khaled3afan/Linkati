const mix = require('laravel-mix');
require('laravel-mix-purgecss');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/_bootstrap-rtl.scss', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .purgeCss();

mix.copyDirectory('resources/assets/images', 'public/images');

if (mix.inProduction()) {
    mix.version();
}
