document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('noticia_formulario');
    const btnEnviar = document.getElementById('btnEnviar');

    form.addEventListener('submit', function(e) {
        let errores = 0;


        // Limpiar mensajes anteriores
        form.querySelectorAll('.error-msg').forEach(msg => msg.remove());






        // Validar campos principales
        ['titulo', 'noticia', 'url'].forEach(id => {
            const campo = document.getElementById(id);
            if (!campo.value.trim()) { // SI el campo está vacío, salta el mismo error
                const error = document.createElement('span');
                error.className = 'error-msg';
                error.textContent = 'Este campo es obligatorio.';
                campo.parentNode.insertBefore(error, campo.nextSibling);
                errores++;
            }




            // Usar la clase URL para validarla, si no salta el error, es correcta

            if (id == 'url'){
                try {
                    new URL(campo.value.trim());
                } catch {
                    const error = document.createElement('span');
                    error.className = 'error-msg';
                    error.textContent = 'URL no es válida.';
                    campo.parentNode.insertBefore(error, campo.nextSibling);
                    errores++;
                }
            }
        });







        // Validar cada pregunta reccorriendola
        form.querySelectorAll('.cuestionarioPregunta').forEach(preguntaDiv => {

            const preguntaInput = preguntaDiv.querySelector('input[name="preguntas[]"]');
            const opcionesInput = preguntaDiv.querySelector('input.opciones');
            const respuestaInput = preguntaDiv.querySelector('input[name="respuestas_correctas[]"]');



            if (!preguntaInput.value.trim()) {
                const error = document.createElement('span');
                error.className = 'error-msg';
                error.textContent = 'La pregunta no puede estar vacía.';
                preguntaInput.parentNode.insertBefore(error, preguntaInput.nextSibling);
                errores++;
            }



            

            const opcionesTexto = opcionesInput.value.trim();
            if (!opcionesTexto) {
                const error = document.createElement('span');
                error.className = 'error-msg';
                error.textContent = 'Las opciones no pueden estar vacías.';
                opcionesInput.parentNode.insertBefore(error, opcionesInput.nextSibling);
                errores++;
            } else if (!opcionesTexto.includes('/')) {
                const error = document.createElement('span');
                error.className = 'error-msg';
                error.textContent = 'Las opciones deben separarse con "/".';
                opcionesInput.parentNode.insertBefore(error, opcionesInput.nextSibling);
                errores++;
            }




            // Validaciones para el campo opciones, al que se hará implode
            // El número de respuesta debe coincidir con el número de opciones.

            const opcionesArray = opcionesTexto.split('/').map(x => x.trim()).filter(x => x);

            const respuesta = parseInt(respuestaInput.value, 10);
            if (isNaN(respuesta)) {
                const error = document.createElement('span');
                error.className = 'error-msg';
                error.textContent = 'La respuesta correcta debe ser un número.';
                respuestaInput.parentNode.insertBefore(error, respuestaInput.nextSibling);
                errores++;
            } else if (respuesta < 1 || respuesta > opcionesArray.length) {
                const error = document.createElement('span');
                error.className = 'error-msg';
                error.textContent = `Número de respuesta inválido. Debe estar entre 1 y ${opcionesArray.length}.`;
                respuestaInput.parentNode.insertBefore(error, respuestaInput.nextSibling);
                errores++;
            }
        });





        
        if (errores > 0) {
            e.preventDefault();
        } else {
            btnEnviar.disabled = true;
            btnEnviar.style.backgroundColor = "#929292ff";
        }
    });
});