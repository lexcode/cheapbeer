var gulp = require('gulp'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    minifyCSS = require('gulp-minify-css'),
    concat = require('gulp-concat'),
    minifyJS = require('gulp-uglify'),
    livereaload = require('gulp-livereload');

gulp.task('css', function(){
    gulp.src('assets/css/main.scss')
        .pipe(sass())
        .pipe(autoprefixer('last 15 version'))
        .pipe(minifyCSS({keepBreaks:true}))
        .pipe(gulp.dest('assets/css'))
        .pipe(livereaload());
});


gulp.task('watch', function(){
    var server  = livereaload();
    gulp.watch('assets/css/main.scss', ['css']);
});

gulp.task('default', ['watch']);
