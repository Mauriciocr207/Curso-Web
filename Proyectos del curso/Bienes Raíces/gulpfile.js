const { src, dest, watch, parallel } = require("gulp");
// SCSS
const plumber = require('gulp-plumber');
const sass = require('gulp-sass')(require('sass'));
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
// JAVASCRIPT
const terser = require('gulp-terser-js');
// IMAGES
const cache = require('gulp-cache');
const webp = require('gulp-webp');
const image_min = require('gulp-imagemin');
const avif = require('gulp-avif');

//== TASTKS ==//
//== COMPILAR Y MIRAR CANMBIOS EN SCSS ==//
function compileSCSS(done) {         
    src('src/scss/**/*.scss') // Identificar el archivo de sass
        .pipe( plumber() ) // Previene el detenimiento del workflow
        .pipe( sourcemaps.init() )
        .pipe( sass() ) // Compílar
        .pipe( postcss([autoprefixer(), cssnano()]) ) // Se minifica código css
        .pipe( sourcemaps.write('.') )
        .pipe( dest('build/css') ); // Guardar en disco duro
    done();
};
//== CONVERSION DE IMAGENES A FORMATO WEBP ==//
function convertToWebp(done) {
    const options = {
        quality: 50
    };
    src('src/img/**/*.{png,jpg}')
        .pipe( webp(options) )
        .pipe( dest('build/img') );
    done();
};
//== MINIFICAR IMAGENES ==//
function imageMin(done) {
    const options = {
        optimizationLevel: 3
    }
    src('src/img/**/*.{png,jpg}')
        .pipe( cache( image_min(options) ))
        .pipe( dest('build/img') );
    done();
}
//== CONVERSION A FORMATO AVIF ==//
function convertToAvif(done) {
    const options = {
        quality: 50
    };
    src('src/img/**/*.{png,jpg}')
        .pipe( avif(options) )
        .pipe( dest('build/img') );
    done();
};
//== INSERT AND MINIFY JS ==//
function insertJS(done) {
    src('src/js/**/*.js')
        .pipe( sourcemaps.init() )
        .pipe( terser( {
            mangle: {
                toplevel:true
            }
        } ) 
        )
        .on( 'error', err => {
            this.emit('end');
        } )
        .pipe( sourcemaps.write('.') )
        .pipe( dest('build/js') );
    done();
}
//== MIRAR CAMBIOS EN ARCHIVOS ==//
function watchToChanges(done) {
    watch('src/scss/**/*.scss', compileSCSS);
    watch('src/js/**/*.js', insertJS);
    done();
};
exports.js = insertJS;
exports.scss = compileSCSS;
exports.dev = parallel( imageMin, convertToWebp, convertToAvif, watchToChanges);