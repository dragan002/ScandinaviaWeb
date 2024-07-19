const {src, dest, watch} = require('gulp');
const sass = require('gulp-sass')(require('sass'));

function css() {
    return src('App/assets/scss/styles.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('./App/assets/css/'));
}

exports.buildCss = css;

exports.watch = function() {
    watch('App/assets/scss/**/*.scss', css);
}

exports.default = exports.watch;