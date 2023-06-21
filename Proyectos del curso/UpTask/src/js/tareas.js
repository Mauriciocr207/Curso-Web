(() => {
    // Botón para mostrar el modar de agregar tarea
    const nuevaTarea = document.querySelector('#agregar-tarea');
    nuevaTarea.addEventListener('click', mostrarFormulario);

    function mostrarFormulario() {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
            <form class="form nueva-tarea">
                <legend>Añade una tarea</legend>
                <div class="campo">
                    <label class="bg-azul">Tarea</label>
                    <input
                        type="text"
                        name="tarea"
                        placeholder="Añadir tarea"
                        id="tarea"
                        class="col-span-2"
                    />
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" valuea="Añadir Tarea"/>
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
            const classList = event.target.classList;
            if(classList.contains('cerrar-modal') || classList.contains('modal')) {
                const form = document.querySelector('.form');
                form.classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 150);
            }
            if(classList.contains('submit-nueva-tarea')) {
                submitNuevaTarea();
            }
        })
    }

    function submitNuevaTarea() {
        const tarea = document.querySelector('#tarea').value.trim();
        if(tarea === '') {
            // Mostrar alerta de error
            mostrarAlerta( 
                "El nombre de la tarea es Obligatorio", 
                "err",
                ".form.nueva-tarea .campo"
            );
        } else {
            agregarTarea(tarea);
        }
    }

    function mostrarAlerta(mensaje, tipo, referencia) {
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
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }

    async function agregarTarea(tarea) {
        // Construir la petición
        const datos = new FormData();
        datos.append('data', JSON.stringify({
            tarea: tarea,
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
          const data = await response.text();
          console.log(data);
          if(!data.res) {
            mostrarAlerta( 
                "No se pudo crear la tarea", 
                "err",
                ".form.nueva-tarea .campo"
            );
          }
        } catch (err) {
            console.log(err);
        }
    }

    function obtenerUrlProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams);
        return proyecto.url;
    }
})();