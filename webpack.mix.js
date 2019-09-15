const mix = require('laravel-mix');
const imagemin = require('imagemin-webpack-plugin').default;
const copyWebpack = require('copy-webpack-plugin');
const imageminMozjpeg = require('imagemin-mozjpeg');

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

mix.webpackConfig({
    plugins: [
        new copyWebpack([{
            from: 'resources/images',
            to: 'assets/images',
        }]),
        new imagemin({
            test: /\.(jpe?g|png|gif|svg)$/i,
            plugins: [
                imageminMozjpeg({
                    quality: 90,
                })
            ]
        })
    ]
});


mix.js('resources/js/app.js', 'public/assets/js');
mix.js('resources/js/projects/tictactoe.js', 'public/assets/js');

mix.sass('resources/sass/app.scss', 'public/assets/css');
mix.sass('resources/sass/projects/simon.scss', 'public/assets/css');
mix.sass('resources/sass/projects/markdown.scss', 'public/assets/css');
mix.sass('resources/sass/projects/wikipedia-viewer.scss', 'public/assets/css');
mix.sass('resources/sass/projects/css-zen.scss', 'public/assets/css')
    .options({
        processCssUrls: false
    });
mix.sass('resources/sass/projects/stateful-calculator.scss', 'public/assets/css')
    .options({
        processCssUrls: false
    });

mix.react('resources/js/components/markdown-preview.js', 'public/assets/js');
mix.react('resources/js/components/stateful-calculator.js', 'public/assets/js');
