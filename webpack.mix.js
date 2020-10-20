const mix = require('laravel-mix');

mix.js('resources/js/main/index.js', 'public/js/main/app.js')
  .postCss('resources/css/main.css', 'public/css', [
  require('tailwindcss'),
])
