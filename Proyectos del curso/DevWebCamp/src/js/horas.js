(() => {
    const horas = document.querySelector('#horas');
    if(horas) {
        let busqueda = {
            id_categoria: "",
            dia: "",
        }
        const categoria = document.querySelector('[name="id_categoria"]');
        const dias = document.querySelectorAll('[name="dia"]');
        const inputHiddenDia = document.querySelector('[name="id_dia"]');
        const inputHiddenHora = document.querySelector('[name="id_hora"]');

        // Seteamos valor inicial de id_categoria | Condiciones iniciales
        busqueda[categoria.name] = categoria.value;
        busqueda[dias[0].name] = inputHiddenDia.value;
        dias.forEach( dia => {
            if(dia.value === inputHiddenDia.value) dia.checked = true;
        })
        // añadimos el listener
        if(!Object.values(busqueda).includes('')) {
            (async () => {
                await buscarEventos(); 
                // Resaltar la hora actual;
                const horaSeleccionada = document.querySelector(`[data-id-hora="${inputHiddenHora.value}"]`);
                horaSeleccionada.classList.remove('horas__hora--deshabilitada');
                horaSeleccionada.classList.add('horas__hora--seleccionada');
            })();
        }
        categoria.addEventListener('input', terminoBusqueda);
        dias.forEach( dia => dia.addEventListener('input', terminoBusqueda));
        function terminoBusqueda(e) {
            busqueda[e.target.name] = e.target.value;

            // Reiniciar campos ocultos y el selector de horas
            inputHiddenHora.value = "";
            inputHiddenDia.value = "";
            // Desahabilitar hora previa, si hay un nuevo click
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia) horaPrevia.classList.remove('horas__hora--seleccionada');


            if(!Object.values(busqueda).includes('')) {
                buscarEventos();
            }
        }

        async function buscarEventos() {
            const {id_categoria, dia} = busqueda;
            const url = `/api/eventos-horarios?id_dia=${dia}&id_categoria=${id_categoria}`;
            const resultado = await fetch(url);
            const eventoshorarios = await resultado.json();
            obtenerHorasDisponibles(eventoshorarios);
        }

        function obtenerHorasDisponibles(eventoshorarios = []) {
            // Reiniciar las horas
            // Obtenemos la nodelist de las horas
            const listadoHoras = document.querySelectorAll('#horas li');
            listadoHoras.forEach( li => li.classList.add('horas__hora--deshabilitada') );

            // Comprobar eventos ya tomados y quitar la variable de deshabilitado
            // Obtenemos los id de las horas que están tomadas por un evento
            const horasTomadas = eventoshorarios.map( eventohorario => eventohorario.id_hora);
            // Convertimos la nodelist a un array
            const listadoHorasArray = Array.from(listadoHoras);
            // Obtenemos los elementos que tengan un id de horario que no está seleccionado en la base de datos
            const resultado = listadoHorasArray.filter( li => !horasTomadas.includes(parseInt(li.dataset.idHora)));
            // Habilitamos cada elemento permitido
            resultado.forEach( li => li.classList.remove('horas__hora--deshabilitada'))
            
            // removemos el listener a todos los
            const horasLi = document.querySelectorAll('.horas__hora');
            horasLi.forEach( horaLi => horaLi.removeEventListener('click', seleccionarHora));

            // añadimos el listener
            const horasDisponibles = document.querySelectorAll('#horas li:not(.horas__hora--deshabilitada)');
            horasDisponibles.forEach( horaDisponible => horaDisponible.addEventListener('click', seleccionarHora));
        }
 
        function seleccionarHora(e) {
            // Desahabilitar hora previa, si hay un nuevo click
            const horaPrevia = document.querySelector('.horas__hora--seleccionada');
            if(horaPrevia) horaPrevia.classList.remove('horas__hora--seleccionada');
            // Agregar clase de seleccionado
            e.target.classList.add('horas__hora--seleccionada');

            inputHiddenHora.value = e.target.dataset.idHora;
            // Llenar el campo oculto de día
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }
    }
})();