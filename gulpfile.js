var gulp = require('gulp'),
    less = require('gulp-less'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    cssmin = require('gulp-cssmin');
var webpack = require('webpack-stream');

/*
gulp.task('site-copy-fonts', function() {
    gulp.src('bower_components/fontawesome/fonts/*')
        .pipe(gulp.dest('html/fonts/'));
});
*/

/*
gulp.task('site-copy-scripts', function() {
    gulp.src('src/Site/Webroot/Scripts/*')
        .pipe(gulp.dest('html/scripts/'));
});

gulp.task('site-design', function() {
    gulp.src([
            'src/Webroot/Styles/bootstrap.min.css',
            'src/Webroot/Styles/bootstrap-theme.min.css',
            'src/Webroot/Styles/font-awesome.min.css',
            'src/Webroot/Styles/main.css'
        ])
        //   .pipe(less())
        .pipe(concat('style.css'))
        //   .pipe(cssmin())
        .pipe(gulp.dest('html/styles/'));
});

gulp.task('site-scripts', function() {
    gulp.src([
            // jQuery
            'bower_components/jquery/jquery.js',
            'bower_components/bootstrap/dist/js/bootstrap.js',

        ])
        .pipe(concat('scripts.js'))
        //  .pipe(uglify())
        .pipe(gulp.dest('html/scripts/'));
});
*/



gulp.task('default', function() {
    return gulp.src('src/webroot/index.js')
        .pipe(webpack( require('./webpack.config.js') ))
        .pipe(gulp.dest('./'));
});











