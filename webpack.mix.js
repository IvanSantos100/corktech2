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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        './public/css/app.css',
        'node_modules/font-awesome/css/font-awesome.css'
    ], 'public/css/app.css')
    .copy([
        'node_modules/font-awesome/fonts/'
    ], 'public/fonts');

mix.browserSync('localhost:8000');

/*
*
mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/popup.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .styles([
        'node_modules/font-awesome/css/font-awesome.css'
    ], 'public/css')

    .copy([
        'node_modules/font-awesome/fonts/'
    ], 'public/fonts');

* */
