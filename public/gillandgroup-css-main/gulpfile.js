const { src, dest, watch, series} = require('gulp')
const sass = require('gulp-sass')(require('sass'))
const purgecss = require('gulp-purgecss')

function buildStyles(){
    return src('gilland/**/*.scss')
    .pipe(sass())
    .pipe(purgecss({content:['../application/views/**/*.php']}))
    .pipe(dest('css'))
}

function watchTask(){
    watch(['gilland/**/*.scss', '../application/views/**/*.php'], buildStyles)
}

exports.default = series(buildStyles, watchTask)