'use strict';

var concat = require('gulp-concat');
var gulp = require('gulp');
var sass = require('gulp-sass');
var runSequence = require('run-sequence');
var watch = require('gulp-watch');


const cssSrc = 'src/scss/main.scss';
const cssDest = 'disobedience';

gulp.task('buildSass', function() {
    return gulp.src(cssSrc)
        .pipe(concat('main.scss'))
        .pipe(sass())
        .pipe(gulp.dest(cssDest));
});

gulp.task('default', [ 'buildSass' ]);

gulp.task('watch', function() {
    watch('src/**/*.scss', function() {
        return runSequence('buildSass');
    });
});
