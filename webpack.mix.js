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
    .react()
    // .postCss('resources/css/app.css', 'public/css', [
    //     require('postcss-import'),
    //     require('tailwindcss'),
    //     require('autoprefixer'),
    // ]);
    .copy('resources/js/sidebar.js', 'public/js/sidebar.js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();

// chunk hash configuration
mix.webpackConfig({
    output: {
        chunkFilename: mix.inProduction() ? "js/chunks/[name].[chunkhash].js" : "js/chunks/[name].js",
    }
})

