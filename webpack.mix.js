const mix = require('laravel-mix');

mix.js('resources/js/main/index.js', 'public/js/main/app.js')
  .sass('resources/sass/app.scss', 'public/css/app.css');
