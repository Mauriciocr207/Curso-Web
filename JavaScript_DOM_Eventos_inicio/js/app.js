//== JavaScript en el navegador y DOM scripting ==//

// 144. Seleccionar Elementos con querySelector
// 145. Seleccionar Elementos con querySelectorAll
function qS() {
    const heading = document.querySelector('#heading'); // retorna 0 o 1 Elemento
    console.log(heading);
    const articles = document.querySelectorAll('.post-resume'); // retorna varios Elementos
    console.log(articles);
}; // qS();


// 145. Crear HTML con createElement
    function create_element() {
        // Generar un nuevo enlace
        const nuevoEnlace = document.createElement('A');
        
        // Agregar el href
        nuevoEnlace.href = 'index.html';
        
        //  Agregar el texto
        nuevoEnlace.textContent = 'Un Nuevo Enlace';

        // Agregar la clase
        nuevoEnlace.classList.add('nav__link');

        // Agregarlo al documento
        const nav = document.querySelector('.nav');
        nav.appendChild(nuevoEnlace);
        
        console.log(nuevoEnlace);
    }; // create_element();


// 146. Eventos en JavaScript
// 148. Reaccionar a Clicks en JavaScript
    function eventos() {
        // El evento load del window espera a que los archivos
        // que dependen del HTML estén listos
        window.addEventListener('load', () => {
            console.log('ha cargado');
        })
        window.onload = function() {
            console.log('ha cargado 2');
        }

        // DOMContentLoaded -> sólo espera por el HTML pero no css o imagenes, a diferencia del window - load
        document.addEventListener('DOMContentLoaded', function() {
            console.log('el documento ha cargado');
        });

        window.addEventListener('scroll', () => {
            console.log('scrolling...')
        });


        // Seleccionar elementos y asociarles un evento
        const btn = document.querySelector('.button--primary')
    }; eventos();


// 149. Eventos con el Teclado


// 150. Eventos en Formularios


// 151. Creando un Validador de Fomrularios Parte 1 de 2
// 152. Creando un Validador de Fomrularios Parte 2 de 2

