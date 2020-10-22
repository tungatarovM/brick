const mix = require('laravel-mix');

mix.js('resources/js/main/index.js', 'public/js/main/app.js')
  .scss('resources/sass/app.scss', 'public/css/app.scss');
