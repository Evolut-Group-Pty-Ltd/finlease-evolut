'use strict';
var gulp = require("gulp"),
    sass = require("gulp-sass"),
    autoprefixer = require("gulp-autoprefixer"),
    minify = require("gulp-minify");

gulp.task('sass', () => {
    return gulp.src('scss/custom.scss')
        .pipe(sass())
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(autoprefixer({
            cascade: false
        }))
        .pipe(gulp.dest('css/'))
});

gulp.task('js', function() {
    return gulp.src(['js/calculator.js','js/custom.js','js/main.js'])
        .pipe(minify({
            ext: {
                min:'.min.js',
                ignoreFiles: ['.min.js']
            }
        }))
        .pipe(gulp.dest('js/'))
});

gulp.task('watch', () => {
    gulp.watch('scss/**/*.scss', gulp.series('sass'));
})

gulp.task('default', gulp.series('watch'));