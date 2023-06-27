(() => {
    let eventos = [];
    const resumen = document.querySelector('#registro-bar-resumen');
    if(resumen) {
        const eventosBoton = document.querySelectorAll('.evento__agregar');
        eventosBoton.forEach( boton => boton.addEventListener('click', seleccionarEventos));

        const formRegistro = document.querySelector('#registro');
        formRegistro.addEventListener('submit', submitFormulario);

        mostrarEventos();

        function seleccionarEventos(e) {
            // Deshabilitar el evento;
            if(eventos.length < 5) {
                e.target.disabled = true;
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector('.evento__nombre').textContent,
                }];
            } else {
                Swal.fire({
                    title: 'Sólo un máximo de 5 eventos',
                    icon: 'warning'
                });
            }

            mostrarEventos();
        }
        function mostrarEventos() {
            // Limpiar el html
            limpiarHhtml();

            if(eventos.length > 0) {
                eventos.forEach( evento => {
                    const eventoDOM = document.createElement('DIV');
                    eventoDOM.classList.add('registro-bar__evento');

                    const titulo = document.createElement('H3');
                    titulo.classList.add('registro-bar__nombre');
                    titulo.textContent = evento.titulo;

                    const botonEliminar = document.createElement('BUTTON');
                    botonEliminar.classList.add('registro-bar__eliminar');
                    botonEliminar.innerHTML = '<i class="fa-solid fa-trash"></i>'
                    botonEliminar.onclick = function () {
                        eliminarEvento(evento.id);
                    }

                    eventoDOM.append(titulo, botonEliminar);

                    // Renderizar en el html
                    resumen.appendChild(eventoDOM);
                })
            } else {
                const noRegistro = document.createElement('P');
                noRegistro.textContent = "No hay eventos, añade hasta 5 del lado izquierdo ";
                noRegistro.classList.add('registro-bar__texto');
                resumen.appendChild(noRegistro);
            }
        }
        function limpiarHhtml() {
            while(resumen.firstChild) {
                resumen.removeChild(resumen.firstChild);
            }
        }
        function eliminarEvento(id) {
            eventos = eventos.filter( evento => evento.id != id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarEventos();
        }
        async function submitFormulario(e) {
            e.preventDefault();
            const regaloId = document.querySelector('#regalo').value;
            const eventosId = eventos.map( evento => evento.id);

            if(eventosId.length === 0 || regaloId === ""){
                Swal.fire({
                    title: 'Elige al menos un Evento y un regalo',
                    icon: 'warning'
                }); 
            } else {
                const datos = new FormData();
                datos.append('id_eventos', eventosId);
                datos.append('id_regalo', regaloId);
                const url = '/finalizar-registro/conferencias';
                const respuesta = await fetch(url, {
                    method: "POST",
                    body: datos,
                });
                const resultado = await respuesta.json();
                console.log(resultado);

            }
        }

    }
})();