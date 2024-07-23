const { src, dest, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function compileSass() {
    return src('App/assets/scss/styles.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('App/assets/css/'));
}

function watchSass() {
    watch('App/assets/scss/**/*.scss', compileSass);
}

exports.compileSass = compileSass;
exports.watch = watchSass;
exports.default = watchSass;
