(() => {
    const ponentesInput = document.querySelector('#ponentes');
    if( ponentesInput ) {
        let ponentes = [];
        let ponentesFiltrados = [];

        const listadoPonentes = document.querySelector('#listado-ponentes');
        const ponenteHidden = document.querySelector('[name="id_ponente"');      
        obtenerPonentes();

        
        ponentesInput.addEventListener('input', buscarPonentes);

        async function obtenerPonentes() {
            const url = `/api/ponentes`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            formatearPonentes(resultado);
        }

        function formatearPonentes(arrayPonentes = []) {
            ponentes = arrayPonentes.map( ponente => {
                return  {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id,
                }
            });

            // Condiciones iniciales
            ponentes.filter( ponente => {
                if(ponente.id === parseInt(ponenteHidden.value)) {
                    ponentesInput.value = ponente.nombre;
                    mostrarPonenteInicio(ponente);
                }
            })

        }

        function buscarPonentes(e) {
            const busqueda = e.target.value;
            
            if(busqueda.length > 1) {
                const expresion = new RegExp(busqueda, "i");
                ponentesFiltrados = ponentes.filter( ponente => {
                    if(ponente.nombre.toLowerCase().search(expresion) != -1) {
                        return ponente;
                    }
                });
            } else {
                ponentesFiltrados = [];
            }
            mostrarPonentes();
        }

        function mostrarPonentes() {
            while(listadoPonentes.firstChild) {
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if(ponentesFiltrados.length > 0) {
                ponentesFiltrados.forEach( ponente => {
                    const ponenteHtml = document.createElement('LI');
                    ponenteHtml.classList.add('listado-ponentes__ponente');
                    ponenteHtml.textContent = ponente.nombre;
                    ponenteHtml.dataset.idPonente = ponente.id;
                    ponenteHtml.onclick = seleccionarPonente;
    
                    // añadir al dom
                    listadoPonentes.appendChild(ponenteHtml);
                });
            } else {
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-ponentes__no-resultado');
                noResultados.textContent = "Sin resultados";

                // añadir al dom
                listadoPonentes.appendChild(noResultados);
            }

            
        }

        function mostrarPonenteInicio(ponente) {
            const ponenteHtml = document.createElement('LI');
            ponenteHtml.classList.add('listado-ponentes__ponente--seleccionado');
            ponenteHtml.textContent = ponente.nombre;
            ponenteHtml.dataset.idPonente = ponente.id;
            // añadir al dom
            listadoPonentes.appendChild(ponenteHtml);
        }

        function seleccionarPonente(e) {
            const ponente = e.target;
            // Remover la clase previa
            const ponentePrevio = document.querySelector('.listado-ponentes__ponente--seleccionado');
            if(ponentePrevio) {
                ponentePrevio.classList.remove('listado-ponentes__ponente--seleccionado');
            }
            ponente.classList.add('listado-ponentes__ponente--seleccionado');
            ponenteHidden.value = ponente.dataset.idPonente;
            ponentesInput.value = ponente.textContent;
        }
    }
})();