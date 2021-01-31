const mix = require('laravel-mix');

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
    .styles([
        'resources/views/assets/css/animate.css',
        'resources/views/assets/css/bootstrap.min.css',
        'resources/views/assets/css/font-awesome.min.css',
        'resources/views/assets/css/main.css',
        'resources/views/assets/css/prettyPhoto.css',
        'resources/views/assets/css/price-range.css',
        'resources/views/assets/css/responsive.css'
    ], 'public/backend/assets/css/libs.css')

    .scripts([
        'resources/views/assets/js/jquery.min.js'
    ], 'public/backend/assets/js/jquery.js')

    .scripts([
        'resources/views/assets/js/jquery.form.js',
        'resources/views/assets/js/jquery.mask.js',
        'resources/views/assets/js/jquery.ui.js',
        'resources/views/assets/js/html5shiv',
        'resources/views/assets/js/respond.min.js',
        'resources/views/assets/js/bootstrap.min.js',
        'resources/views/assets/js/jquery.scrollUp.min.js',
        'resources/views/assets/js/price-range.js',
        'resources/views/assets/js/jquery.prettyPhoto.js',
        'resources/views/assets/js/main.js'
    ], 'public/backend/assets/js/libs.js')

    .scripts([
        'resources/views/assets/js/login.js'
    ], 'public/backend/assets/js/login.js')

    .scripts([
        'resources/views/assets/js/scripts.js'
    ], 'public/backend/assets/js/scripts.js')

    .copyDirectory('resources/views/assets/fonts', 'public/backend/assets/fonts')

    .copyDirectory('resources/views/assets/images', 'public/backend/assets/images')

    .options({
        processCssUrls: false
    })

    .version()
;
