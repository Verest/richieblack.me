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

mix.sass('resources/sass/app.scss', 'public/assets/css');
