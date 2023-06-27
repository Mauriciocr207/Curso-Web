(() => {
    const tagsInput = document.querySelector('#tags_input');
    if(tagsInput) {
        let tags = [];
        // Escuchar los cambios en el input
        tagsInput.addEventListener('keypress', guardarTag);
        function guardarTag(event) {
            if(event.keyCode === 44) {
                event.preventDefault();
                const text = event.target.value.trim();
                if(text !== "" && !(/^[0-9]+$/.test(text))) {
                    tags = [...tags, text]
                    mostrarTags();
                }
                // limpiar el input
                tagsInput.value = "";
            }
        }
        // Dom scripting
        function mostrarTags() {
            const tagsDiv = document.querySelector('#tags');
            tagsDiv.textContent = '';
            tags.forEach( tag => {
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('form__tag');
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            });
            actualizarInputHidden();
        }
        function eliminarTag(event) {
            const tagToRemove = event.target;
            tags = tags.filter( tag => tag !== tagToRemove.textContent);
            tagToRemove.remove();
            actualizarInputHidden();
        }
        function actualizarInputHidden() {
            const tagsInputHidden = document.querySelector('[name="tags"]');
            tagsInputHidden.value = tags.toString();
        }
        function leerInputHidden() {
            const tagsInputHidden = document.querySelector('[name="tags"]');
            const tagsValues = tagsInputHidden.value;
            if(tagsValues !== "") {
                tags = tagsValues.split(',');
                mostrarTags();
            };
        };
        leerInputHidden();
    }
})();