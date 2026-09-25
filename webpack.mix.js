const mix = require('laravel-mix');

require('laravel-mix-simple-image-processing')

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
    .vue({
        version: 3,
    })
    .js('resources/js/app-particles.js', 'public/js')
    .js('resources/js/app-particles1.js', 'public/js')
    .js('resources/js/particles.js', 'public/js')
    .js('resources/js/vue.js', 'public/js')
    .js('resources/js/vueQrCode.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/acceuil.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/acceuil1.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/inscription.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/particles.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/particles1.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/terminer.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .postCss('resources/css/hackathon-theme.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .imgs({
        source: 'resources/images',
        destination: 'public/images'
    });
    

if (mix.inProduction()) {
    mix.version();
}
