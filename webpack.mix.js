const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .copy('node_modules/easymde/dist/easymde.min.css', 'public/css')
    .copy('node_modules/easymde/dist/easymde.min.js', 'public/js')
    .copy('node_modules/chart.js/dist/Chart.css', 'public/css')
    .copy('node_modules/chart.js/dist/Chart.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);
