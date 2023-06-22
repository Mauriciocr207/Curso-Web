(() => {
    let tareas = [];
    let filtradas = [];
    // Botón para mostrar el modar de agregar tarea
    obtenerTareas();
    const nuevaTarea = document.querySelector('#agregar-tarea');
    nuevaTarea.addEventListener('click', function() {
        mostrarFormulario();
    });
    // Filtros de búsqueda
    const filtros = document.querySelectorAll('#filtros input[type="radio"]');
    filtros.forEach( filtro => {
        filtro.addEventListener('input', mostrarTareas);
    })
    // Helpers
    function mostrarFormulario(editar = false, tarea = {}) {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="form nueva-tarea">
                <legend>${editar ? "Editar el Título" : "Añade una tarea"}</legend>
                <div class="campo">
                    <label class="bg-azul">${editar ? "Título" : "Tarea"}</label>
                    <input
                        type="text"
                        name="tarea"
                        placeholder="${editar ? "Nuevo Título" : "Añadir tarea"}"
                        id="tarea"
                        class="col-span-2"
                        value="${editar ? tarea.nombre : ""}"
                    />
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="${editar ? "Añadir Título" : "Añadir Tarea"}"/>
                    <button type="button" class="cerrar-modal" >Cancelar</button>
                </div>
            </form>
        `;       
        document.querySelector('body').appendChild(modal);
        setTimeout(() => {
            const form = document.querySelector('.form');
            form.classList.add('animar');
        }, 10);

        modal.addEventListener('click', event => {
            event.preventDefault();
            console.log(event);
            const classList = event.target.classList;
            if(classList.contains('cerrar-modal') || classList.contains('modal')) {
                const form = document.querySelector('.form');
                form.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 150);
            }
            if(classList.contains('submit-nueva-tarea')) {
                const nombreTarea = document.querySelector('#tarea').value.trim();
                if(nombreTarea === '') {
                    // Mostrar alerta de error
                    mostrarAlerta( 
                        "El nombre de la tarea es Obligatorio", 
                        "err",
                        ".form.nueva-tarea .campo"
                    );
                } else {
                    if(editar) {
                        tarea.nombre = nombreTarea;
                        actualizarTarea(tarea);
                        const modal = document.querySelector('.modal');
                        setTimeout(() => {
                            modal.remove();
                        }, 1000);
                    } else {
                        agregarTarea(nombreTarea);
                    }
                }
            }
        })
    }
    function obtenerUrlProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams);
        return proyecto.url;
    }
    function cambiarEstadoTarea({...tarea}) { 
        tarea.estado = +!tarea.estado;
        actualizarTarea(tarea);
    }
    function confirmarEliminarTarea({...tarea}) {
        Swal.fire({
            title: '¿Quieres eliminar la tarea?',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarTarea(tarea);
            }
        })
    }
    function filtrarTareas() {
        const filtros = document.querySelectorAll('#filtros input[type="radio"]');
        let estado = -1;
        filtros.forEach( filtro => {
            if(filtro.checked) estado = parseInt(filtro.value);
        });
        filtradas = tareas;
        if(estado !== -1) {
            filtradas = tareas.filter( tarea => tarea.estado === estado);
        }
        return filtradas;
    }

    // DOM Scripting
    function mostrarAlerta(mensaje, tipo, referencia, desaparece = true) {
        const alertaPrevia = document.querySelector('.alert');
        if(alertaPrevia) {
            alertaPrevia.remove();
        };
        const alerta = document.createElement('DIV');
        alerta.innerHTML = `
            <div class="alert">
                <div class="${tipo}">
                    ${mensaje}
                </div>
            </div>
        `;

        // Inserta antes de la referencia
        const referenceBox = document.querySelector(`${referencia}`);
        referenceBox.parentElement.insertBefore(alerta, referenceBox);

        // Eliminar elemento
        if(desaparece) {
            setTimeout(() => {
                alerta.remove();
            }, 5000);
        }
    }
    function mostrarTareas() {
        limpiarTareas();

        const arrayTareas = filtrarTareas();

        if(arrayTareas.length === 0) {
            mostrarAlerta(
                "No hay tareas",
                "err",
                "#listado-tareas",
                false
            );
        } else {
            const estados = {
                0: "Pendiente",
                1: "Completa",
            }
            arrayTareas.forEach( tarea => {
                // Contenedor de la tarea
                const contenedorTarea = document.createElement('LI');
                contenedorTarea.dataset.tareaId = tarea.id;
                contenedorTarea.classList.add('tarea');
                
                // Nombre tarea
                const nombreBox = document.createElement('DIV');
                nombreBox.classList.add('nombre-box');
                const nombreTarea = document.createElement('P');
                nombreTarea.textContent = `${tarea.nombre}`;
                const iconNombre = document.createElement('DIV');
                iconNombre.classList.add('icon');
                iconNombre.innerHTML = `<i class="fa-solid fa-pen-to-square"></i>`;
                iconNombre.onclick = function() {
                    mostrarFormulario(true, tarea);
                }

                nombreBox.append(nombreTarea, iconNombre);

                // Opciones de la tarea
                const opciones = document.createElement('DIV');
                opciones.classList.add('opciones');

                // Boton estado tarea
                const btnEstadoTarea = document.createElement('BUTTON');
                btnEstadoTarea.classList.add('estado-tarea');
                btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
                btnEstadoTarea.textContent = estados[tarea.estado];
                btnEstadoTarea.dataset.estadoTarea = tarea.estado;
                btnEstadoTarea.onclick = function() {
                    cambiarEstadoTarea(tarea);
                }

                const btnEliminarTarea = document.createElement('BUTTON');
                btnEliminarTarea.classList.add('eliminar-tarea');
                btnEliminarTarea.textContent = "Eliminar";
                btnEliminarTarea.dataset.idTarea = tarea.id;
                btnEliminarTarea.onclick = function() {
                    confirmarEliminarTarea(tarea);
                }

                opciones.append(btnEstadoTarea, btnEliminarTarea);

                contenedorTarea.append(nombreBox, opciones);

                const listadoTareas = document.querySelector('#listado-tareas');
                listadoTareas.appendChild(contenedorTarea);

            })
        }
    }
    function limpiarTareas() {
        const listadoTareas = document.querySelector('#listado-tareas');
        while(listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }
    // FETCH API
    async function obtenerTareas() {
        try {
            const url = `/api/task?url=${obtenerUrlProyecto()}`;
            const data = await fetch(url);
            const result = await data.json();
            tareas = result.tareas;
            mostrarTareas();
        } catch (error) {
            console.log(error);
        }
    }
    async function agregarTarea(nombreTarea) {
        // Construir la petición
        const datos = new FormData();
        datos.append('data', JSON.stringify({
            tarea: {
                nombre: nombreTarea
            },
            proyecto: {
                url: obtenerUrlProyecto()
            }
        }));
        

        try {
          const url = "/api/task/create";
          const response = await fetch(url, {
            method: "POST",
            body: datos
          });
          const result = await response.json();
          if(result.res) {
            mostrarAlerta( 
                "Tarea creada correctamente", 
                "enviado",
                ".form.nueva-tarea .campo"
            );
            const modal = document.querySelector('.modal');
            setTimeout(() => {
                modal.remove();
            }, 1000);

            // Agregar el objeto de tarea al global de tareas
            const tareaObj = {
                id: parseInt(result.tarea.id),
                nombre: nombreTarea,
                estado: 0,
                id_proyecto: parseInt(result.tarea.id_proyecto),
            }
            tareas.push(tareaObj);
            mostrarTareas();
          } else {
            mostrarAlerta( 
                "No se pudo crear la tarea", 
                "err",
                ".form.nueva-tarea .campo"
            );
            
          }
        } catch (error) {
            console.log(error);
        }
    }
    async function actualizarTarea(tarea) {
        console.log(tarea);
        const { estado, id, nombre } = tarea;
        const datos = new FormData();
        datos.append('data', JSON.stringify({
            tarea: {
                id: id,
                estado: estado,
                nombre: nombre,
            },
            proyecto: {
                url: obtenerUrlProyecto()
            }
        }));

        try {
            const url = "/api/task/update";
            const response = await fetch(url, {
                method: "POST",
                body: datos,
            })
            const result = await response.json();
            if(result.res === true) {
                tareas = tareas.map( tarea => {
                    if(tarea.id === parseInt(result.tarea.id)) {
                        tarea.estado = parseInt(result.tarea.estado);
                    }
                    return tarea;
                });
                mostrarAlerta(
                    "Actualizado correctamente",
                    "enviado",
                    "#listado-tareas",
                );
                mostrarTareas();
            } else {
                mostrarAlerta(
                    "No se pudo actualizar",
                    "err",
                    "#listado-tareas",
                );
            }
        } catch (error) {   
            console.log(error);
        }
        


    }
    async function eliminarTarea(tarea) {
        const { id } = tarea;
        const datos = new FormData();
        datos.append('data', JSON.stringify({
            tarea: {
                id: id,
            },
            proyecto: {
                url: obtenerUrlProyecto()
            }
        }));

        try {
            const url = "/api/task/delete";
            const response = await fetch(url, {
                method: "POST",
                body: datos,
            })
            const result = await response.json();
            if(result.res === true) {
                tareas = tareas.filter( tarea => tarea.id !== id);
                mostrarTareas();
                mostrarAlerta(
                    "Se borró correctamente",
                    "enviado",
                    "#listado-tareas",
                );
            } else {
                mostrarAlerta(
                    "No se pudo borrar",
                    "err",
                    "#listado-tareas",
                );
            }
        } catch (error) {   
            console.log(error);
        }
    }


    // Evento teclado esc
    document.addEventListener('keydown', e => {
        if(e.key === "Escape") {
            const modal = document.querySelector('.modal');
            if(modal) modal.remove();
        }
    })
})();