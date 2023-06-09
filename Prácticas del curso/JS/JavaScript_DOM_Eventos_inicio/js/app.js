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

        window.addEventListener('scroll', (event) => {
            console.log('scrolling...');
        });


        // Seleccionar elementos y asociarles un evento
        const btn = document.querySelector('.field__input--submit');
        btn.addEventListener('click', event => {
             event.preventDefault();
             console.log('enviando formulario');
        })
    }; // eventos();


// 149. Eventos con el Teclado
// 150. Eventos en Formularios
// 151. Creando un Validador de Fomrularios Parte 1 de 2
// 152. Creando un Validador de Fomrularios Parte 2 de 2
    function eventos_con_teclado() {
        // Datos que se guardarán del formulario
        const datos = {
            name: '',
            email: '',
            message: ''
        }
        // objetos del formulario
        const name = document.querySelector('#name');
        const email = document.querySelector('#email');
        const message = document.querySelector('#message');
        // const btn = document.querySelector('.field__input--submit');
        const form = document.querySelector('.form');
        // revisando inputs
        function leerTexto(e) {
            datos[e.target.id] = e.target.value;
            console.log(datos);
        };
        name.addEventListener('input', leerTexto);
        name.addEventListener('change', () => {
            console.log('changed');
        });
        email.addEventListener('input', leerTexto);
        message.addEventListener('input', leerTexto);
        // Validación del formulario
        function formAlert(msg = "", sended = false) {
            if(form.querySelector('.form-message') == null) {
                const p = document.createElement('P');
                p.classList.add('form-message');
                if(sended) {
                    p.classList.add('acept');
                } else {
                    p.classList.add('error');
                }
                p.textContent = msg;
                form.appendChild(p);
                setTimeout(() => {
                    p.remove();
                }, 3000);
            };
        };
        form.addEventListener('submit', e => {
            e.preventDefault();
            const { name, email, message } = datos;
            if( name === '' || email === '' || message === '') {
                formAlert('Todos los campos son obligatorios', false);
                return; 
            } else {
                formAlert('Enviado', true);
            }
        });
    }; eventos_con_teclado();

 


    

