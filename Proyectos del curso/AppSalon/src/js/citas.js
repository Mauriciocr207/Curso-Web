const Pasos = {
    inicial: 1,
    final: 3,
    current: 1
}
const Cita = {
    nombre: "",
    fecha: "",
    hora: "",
    servicios: {}
}
function appCitas() {
    tabs(); // Cambia la seccion cuando se presionen los tabs
    botonesPaginador();
    paginaAnterior();
    paginaSiguiente();
    citasAPI();
    (() => {
        Cita.nombre = document.querySelector('#nombre').value;
        Cita.fecha = document.querySelector('#fecha').value
        Cita.hora = document.querySelector('#hora').value
        console.log(
            document.querySelector('#fecha')
        )
    })();
} appCitas();
function mostrarSeccion(paso) {
    // Seleccionar la seccion con el paso...
    const secciones = document.querySelectorAll('.seccion');
    secciones.forEach( seccion => {
        seccion.classList.remove('mostrar');
    });
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add('mostrar');
}
function cambiarColorBotones(paso) {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach( boton => {
        boton.classList.remove('actual');
        if(paso === parseInt(boton.dataset.paso)) {
            boton.classList.add('actual');
        }
    });
}
function botonesPaginador() {
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');
    if(Pasos.current === 1) paginaAnterior.classList.add('ocultar');
    else if(Pasos.current === 3) paginaSiguiente.classList.add('ocultar');
    else {
        paginaSiguiente.classList.remove('ocultar');
        paginaAnterior.classList.remove('ocultar');
    }
}
function tabs() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach( boton => {
        boton.addEventListener('click', event => {
            Pasos.current = parseInt(event.target.dataset.paso);
            mostrarSeccion(Pasos.current);
            botonesPaginador();
            cambiarColorBotones(Pasos.current);
        })
    });
}
function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {
        if(Pasos.current <= Pasos.inicial) {
            Pasos.current = 1;
            return;
        }
        Pasos.current--;
        mostrarSeccion(Pasos.current);
        botonesPaginador();
        cambiarColorBotones(Pasos.current);
    })
}
function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        if(Pasos.current >= Pasos.final) {
            Pasos.current = 3;
            return;
        }
        Pasos.current++;
        mostrarSeccion(Pasos.current);
        botonesPaginador();
        cambiarColorBotones(Pasos.current);
    })
}
function mostrarServicios(servicios = []) {
    servicios.forEach( servicio => {
        const {id, nombre, precio } = servicio;

        // Nombre
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        // Precio
        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$${precio}`;

        // Boton agregar
        const botonAgregarServicio = document.createElement("LI");
        botonAgregarServicio.classList.add('fa-solid');
        botonAgregarServicio.classList.add('fa-plus');

        // Caja para botones
        const botonesBox = document.createElement("DIV");
        botonesBox.classList.add('botonesBox');
        botonesBox.append(botonAgregarServicio);

        // Contenedor
        const servicioBox = document.createElement('DIV');
        servicioBox.classList.add('servicio');
        servicioBox.dataset.id = id;
        
        servicioBox.append(nombreServicio, precioServicio, botonesBox);

        document.querySelector('#servicios').appendChild(servicioBox);

        botonAgregarServicio.addEventListener('click', () => {
            servicio = Cita.servicios[`${id}`];
            if(servicio) {
                delete Cita.servicios[`${id}`];
                botonAgregarServicio.classList.remove('fa-minus');
                botonAgregarServicio.classList.add('fa-plus');
                servicioBox.classList.remove('azul');
            } else {
                Cita.servicios[`${id}`] = {
                    nombre: nombre,
                    precio: precio
                }
                botonAgregarServicio.classList.remove('fa-plus');
                botonAgregarServicio.classList.add('fa-minus');
                servicioBox.classList.add('azul');
            } 
            console.log(Cita);
        });

    });
}
function removerServicio() {
    
}
async function citasAPI() {
    try {
        const url = "http://localhost:3000/api/servicios";
        const res = await fetch(url);
        const servicios = await res.json();
        mostrarServicios(servicios);
        
    } catch (error) {
        console.log(error);
    }
}



