const Pasos = {
    inicial: 1,
    final: 3,
    current: 1
} 
const Cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    servicios: {}
}
function appCitas() {
    console.log("holaa");
    tabs(); // Cambia la seccion cuando se presionen los tabs
    botonesPaginador();
    paginaAnterior();
    paginaSiguiente();
    citasAPI(); 
    seleccionarFecha();
    selectionarHora();
    (() => {
        Cita.nombre = document.querySelector('#nombre').value;
        Cita.id = document.querySelector('#id').value;
    })();
} appCitas();
// Agregar el id del cliente
// Control de la navegación en el panel
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
    paginaSiguiente.classList.remove('ocultar');
    paginaAnterior.classList.remove('ocultar');
    if(Pasos.current === 1) paginaAnterior.classList.add('ocultar');
    else if(Pasos.current === 3) {
        paginaSiguiente.classList.add('ocultar');
        mostrarResumen();
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
// fetch API y mostrar los servicios de la DB
async function citasAPI() {
    try {
        const url = "/api/servicios";
        const res = await fetch(url);
        const servicios = await res.json();
        mostrarServicios(servicios);
        
    } catch (error) {
        mostrarAlerta('Hubo un error al mostrar los servicios.', 'err', '#servicios');
    }
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

        // Boton agregar / quitar
        const botonSeleccionarServicio = document.createElement("LI");
        botonSeleccionarServicio.classList.add('fa-solid');
        botonSeleccionarServicio.classList.add('fa-plus');

        // Caja para botones
        const botonesBox = document.createElement("DIV");
        botonesBox.classList.add('botonesBox');
        botonesBox.append(botonSeleccionarServicio);

        // Contenedor
        const servicioBox = document.createElement('DIV');
        servicioBox.classList.add('servicio');
        servicioBox.dataset.id = id;
        
        servicioBox.append(nombreServicio, precioServicio, botonesBox);

        document.querySelector('#servicios').appendChild(servicioBox);

        // Seleccionar o quitar servicios
        botonSeleccionarServicio.addEventListener('click', () => {
            servicio = Cita.servicios[`${id}`];
            if(servicio) {
                delete Cita.servicios[`${id}`];
                botonSeleccionarServicio.classList.remove('fa-minus');
                botonSeleccionarServicio.classList.add('fa-plus');
                servicioBox.classList.remove('azul');
            } else {
                Cita.servicios[`${id}`] = {
                    nombre: nombre,
                    precio: precio
                }
                botonSeleccionarServicio.classList.remove('fa-plus');
                botonSeleccionarServicio.classList.add('fa-minus');
                servicioBox.classList.add('azul');
            } 
        });
    });
}
// Seleccion de campos de la cita
function seleccionarFecha() {
    const fechaBox = document.querySelector('#fecha');
    Cita.fecha = fechaBox.value;
    fechaBox.addEventListener('input', () => {
        const dia = new Date(fechaBox.value).getUTCDay();
        if( [6,0].includes(dia) ) {
            fechaBox.value = "";
            mostrarAlerta("Fines de semana no permitidos", "err", '#paso-2 p');
        } else {
            Cita.fecha = fechaBox.value;
        }
    });
}
function selectionarHora() {
    const horaBox = document.querySelector('#hora');
    Cita.hora = horaBox.value;
    horaBox.addEventListener('input', () => {
        let hora = horaBox.value;
        hora = hora.split(":");
        if(hora[0] <= 10 || hora[0] >= 18) {
            horaBox.value = "";
            mostrarAlerta("Selecciona una hora entre las 10am y las 6pm", "err", '#paso-2 p');
        } else {
            Cita.hora = horaBox.value;
        }
    });
}
function mostrarAlerta(mensaje, tipo, element, desaparece = true) {
    const alertaPrevia = document.querySelector('.alert');
    if(alertaPrevia) {
        alertaPrevia.remove();
    };
    const alertaBox = document.createElement('DIV');
    alertaBox.classList.add('alert');
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add(tipo);
    alertaBox.appendChild(alerta);
    document.querySelector(`${element}`).appendChild(alertaBox);
    if(desaparece) {
        setTimeout(() => {
            alertaBox.remove();
        }, 3000);
    }
}
// Mostrar resumen
function mostrarResumen() {
    const resumen = document.querySelector('.resumen');
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    } 
    if(Object.values(Cita).includes('') || Object.keys(Cita.servicios).length === 0) {
        mostrarAlerta('Hacen falta datos o servicios', 'err', '.resumen', false);
    }

    // Dom scripting
    const { nombre, fecha, hora, servicios } = Cita;
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date( Date.UTC(
        year, 
        mes,
        dia
    ) );
    const options = {
        day: "numeric",
        weekday: "long",
        year: 'numeric',
        month: "long"
    }
    const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', options);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;
    const fechaCliente = document.createElement('P');
    fechaCliente.innerHTML = `<span>Fecha:</span> ${fechaFormateada != "Invalid Date" ? fechaFormateada : ""}`;
    const horaCliente = document.createElement('P');
    horaCliente.innerHTML = `<span>Hora:</span> ${hora}`;

    const serviciosBox = document.createElement('DIV');
    serviciosBox.classList.add('listado-servicios');
    Object.keys(servicios).forEach( key => {
        // caja servicio
        const servicio = document.createElement('DIV');
        servicio.classList.add('servicio');
        // caja nombre-servicio
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = `${servicios[key].nombre}`;
        // caja precio-servicio
        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `${servicios[key].precio}`;
        
        servicio.append(nombreServicio, precioServicio);
        serviciosBox.appendChild(servicio);
    });

    // Boton para crear cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = "Reservar";
    botonReservar.addEventListener('click', reservarCita);
 


    resumen.append(nombreCliente, fechaCliente, horaCliente, serviciosBox, botonReservar);
}
async function reservarCita() {
    if(!Object.values(Cita).includes('') && Object.keys(Cita.servicios).length !== 0) {
        // Se recopilan los datos a enviar
        const { id, fecha, hora, servicios } = Cita;
        const ids = Object.keys(servicios).map( id => id);
        const data = new FormData();
        data.append('id_usuario', id);
        data.append('fecha', fecha);
        data.append('hora', `${hora}:00`);
        data.append('servicios', ids);
        console.log([...data]);
        try {
            // Peticion - POST hacia la api
            const url = "/api/citas";
            const request = await fetch(url, {
                method: "POST",
                body: data,
            });
            const res = await request.json();
            if(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Cita Creada',
                    text: 'Tu cita fue creada correctamente',
                })
                    .then( () => {
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);
                    })
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error al reservar la cita',
            })
        }
    } else {
        mostrarAlerta('Llena todos los campos antes de realizar la reservación', 'err', '#paso-3');
    } 
}




