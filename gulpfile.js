var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .sass('app.scss') //WEB
        .sass('api.scss') //API Web View
        .version([]);
    mix
        .scripts(['emojify.js', 'api.js'], 'public/js/api.js');
    mix
        .version([
            'css/api.css',
            'css/app.css',
            'js/api.js',
        ]);
});