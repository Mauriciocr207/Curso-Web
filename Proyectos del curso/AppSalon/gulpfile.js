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

// Rutas 
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*.{png,jpg}'
}

//== TASTKS ==//
//== COMPILAR Y MIRAR CANMBIOS EN SCSS ==//
function compileSCSS(done) {         
    src(paths.scss) // Identificar el archivo de sass
        .pipe( plumber() ) // Previene el detenimiento del workflow
        .pipe( sourcemaps.init() )
        .pipe( sass() ) // Compílar
        .pipe( postcss([autoprefixer(), cssnano()]) ) // Se minifica código css
        .pipe( sourcemaps.write('.') )
        .pipe( dest('public/build/css') ); // Guardar en disco duro
    done();
};
//== CONVERSION DE IMAGENES A FORMATO WEBP ==//
function convertToWebp(done) {
    const options = {
        quality: 50
    };
    src(paths.imagenes)
        .pipe( webp(options) )
        .pipe( dest('public/build/img') );
    done();
};
//== MINIFICAR IMAGENES ==//
function imageMin(done) {
    const options = {
        optimizationLevel: 3
    }
    src(paths.imagenes)
        .pipe( cache( image_min(options) ))
        .pipe( dest('public/build/img') );
    done();
}
//== CONVERSION A FORMATO AVIF ==//
function convertToAvif(done) {
    const options = {
        quality: 50
    };
    src(paths.imagenes)
        .pipe( avif(options) )
        .pipe( dest('public/build/img') );
    done();
};
//== INSERT AND MINIFY JS ==//
function insertJS(done) {
    src(paths.js)
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
        .pipe( dest('public/build/js') );
    done();
}
//== MIRAR CAMBIOS EN ARCHIVOS ==//
function watchToChanges(done) {
    watch(paths.scss, compileSCSS);
    watch(paths.js, insertJS);
    watch(paths.imagenes);
    done();
};
exports.js = insertJS;
exports.scss = compileSCSS;
exports.imageMin = imageMin;
exports.dev = parallel( imageMin, convertToWebp, convertToAvif, watchToChanges);