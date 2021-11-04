let mix = require('laravel-mix')


// mix.js("resources/js/app.js", "public/js")
//     .postCss("resources/css/app.css", "public/css", [
//
//     ]);

mix
    .setPublicPath('dist')
    .js('resources/js/field.js', 'js')
    .sass("resources/sass/field.scss", 'scss');

// mix.js("resources/js/app.js", "public/js")
//     .postCss("resources/css/app.css", "public/css", []);