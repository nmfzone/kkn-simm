const { mix } = require('laravel-mix');

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
   .less('resources/assets/less/adminlte-app.less', 'public/css')
   .less('node_modules/toastr/toastr.less', 'public/css')
   .copy('node_modules/admin-lte/dist/css/AdminLTE.css', 'public/css/adminlte-less.css')
   .combine([
     'public/css/app.css',
     'node_modules/admin-lte/dist/css/skins/_all-skins.css',
     'public/css/adminlte-less.css',
     'public/css/adminlte-app.css',
     'node_modules/icheck/skins/square/blue.css',
     'public/css/toastr.css',
   ], 'public/css/all.css')
   .copy('node_modules/font-awesome/fonts/*.*', 'public/fonts')
   .copy('node_modules/ionicons/dist/fonts/*.*', 'public/fonts')
   .copy('node_modules/admin-lte/bootstrap/fonts/*.*', 'public/fonts/bootstrap')
   .copy('node_modules/admin-lte/dist/css/skins/*.*', 'public/css/skins')
   .copy('node_modules/admin-lte/plugins', 'public/plugins')
   .copy('node_modules/icheck/skins/square/blue.png', 'public/css')
   .copy('node_modules/icheck/skins/square/blue@2x.png', 'public/css');
