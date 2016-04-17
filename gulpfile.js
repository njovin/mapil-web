var elixir = require('laravel-elixir');
var gulp = require('gulp');
var clean = require('gulp-clean');
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
    mix.sass('app.scss')

    .scripts([
        'http.js',
        'jquery.growl.js'
    ])

    .version(['public/js/all.js','public/css/app.css'])

    .task('clean');

});


gulp.task('clean', function() {
    gulp.src('public/js', {read: false})
        .pipe(clean());
    gulp.src('public/css', {read: false})
        .pipe(clean());        
});
