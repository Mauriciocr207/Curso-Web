const { src, dest, watch } = require("gulp");
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
function compileSCSS(done) {         
    src('src/scss/**/*.scss') // Identificar el archivo de sass
        .pipe(plumber() ) // Previene el detenimiento del workflow
        .pipe( sass() ) // Compílar
        .pipe( dest('build/css') ); // Guardar en disco duro
    done();
};
function dev(done) {
    watch('src/scss/**/*.scss', compileSCSS)
    done();
};
exports.compileSCSS = compileSCSS;
exports.dev = dev;