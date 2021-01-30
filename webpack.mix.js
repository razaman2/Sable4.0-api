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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    //
]).options({
    autoprefixer: {remove: false}
}).vue({
    extractStyles: true,
    globalStyles: false
}).webpackConfig({
    module: {
        rules: [{
            test: /\.tsx?$/,
            loader: 'ts-loader',
            options: {appendTsSuffixTo: [/\.vue$/]},
            exclude: /node_modules/,
        }]
    },
    resolve: {
        extensions: ['*', '.js', '.jsx', '.vue', '.ts', '.tsx']
    }
});
