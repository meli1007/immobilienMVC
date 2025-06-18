import path from 'path'
import fs from 'fs'
import { glob } from 'glob'
import { src, dest, watch, series } from 'gulp'
import * as dartSass from 'sass'
//extraer dependencia para tener todas sus funciones en este archivo
import gulpSass from 'gulp-sass'
import terser from 'gulp-terser'
import sharp from 'sharp'
import rename from 'gulp-rename'

const sass = gulpSass(dartSass)

//exportar js
export function js( done ) {
    src('src/js/**/*.js')
    .pipe(terser())
    .pipe( dest('./public/build/js') )
    done()
}

//compilar sass, done es una funcion o callback
export function css( done ){
    src('src/scss/app.scss', { sourcemaps: true })
    //compilar archivo una vez encontrado
        .pipe( sass({
            style: 'compressed'
        }) .on('error', sass.logError) )
        .pipe( dest('./public/build/css', { sourcemaps: true }) )
        
    done()
}

/*export async function crop(done) {
    const inputFolder = 'src/img/gallery/full'
    const outputFolder = 'src/img/gallery/thumb';
    const width = 250;
    const height = 180;
    //crea carpeta si no existe
    if (!fs.existsSync(outputFolder)) {
        fs.mkdirSync(outputFolder, { recursive: true })
    }
    //revisa que sean imagenes para comenzar a procesarlas
    const images = fs.readdirSync(inputFolder).filter(file => {
        return /\.(jpg)$/i.test(path.extname(file));
    });
    try {
        images.forEach(file => {
            //archivo de entrada y salida
            const inputFile = path.join(inputFolder, file)
            const outputFile = path.join(outputFolder, file)
            sharp(inputFile) 
                .resize(width, height, {
                    position: 'centre'
                })
                .toFile(outputFile)
        });

        done()
    } catch (error) {
        console.log(error)
    }
}*/

export async function images(done) {
    const srcDir = './src/img';
    const buildDir = './public/build/img';
    const images =  await glob('./src/img/**/*{jpg,png}')
    //busca en forma recursiva las imagenes y las convierte de jpg o webp
    images.forEach(file => {
        const relativePath = path.relative(srcDir, path.dirname(file));
        const outputSubDir = path.join(buildDir, relativePath);
        processImages(file, outputSubDir);
    });
    done();
}

function processImages(file, outputSubDir) {
    if (!fs.existsSync(outputSubDir)) {
        fs.mkdirSync(outputSubDir, { recursive: true })
    }
    const baseName = path.basename(file, path.extname(file))
    const extName = path.extname(file)
    const outputFile = path.join(outputSubDir, `${baseName}${extName}`)
    const outputFileWebp = path.join(outputSubDir, `${baseName}.webp`)
    const outputFileAvif = path.join(outputSubDir, `${baseName}.avif`)

    const options = { quality: 80 }
    //genera versiones de webpack y las almacena
    sharp(file).jpeg(options).toFile(outputFile)
    sharp(file).webp(options).toFile(outputFileWebp)
    sharp(file).avif().toFile(outputFileAvif)
}

export function dev() {
    //observa el archivo y cuando hay cambios ejecuta la funcion de css
    // watch('src/scss/app.scss', css)
    watch('src/scss/**/*.scss', css)
    watch('src/js/**/*.js', js)
    watch('src/img/**/*.{png,jpg}', images)
}

export default series( images, js, css, dev )