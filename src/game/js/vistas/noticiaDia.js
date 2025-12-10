let btnEnviar = document.getElementById('btnEnviar');
let form = document.getElementById('formNoticia');

document.addEventListener('DOMContentLoaded', function(e) {
    
    let respuestasCorrectas = window.respuestasCorrectas || {};
    let respuestasUsuario   = window.respuestasUsuario || {};

    
    if (form && respuestasCorrectas) {

        // Restaurar lo que ha marcado el jugador
        for (let nPregunta in respuestasUsuario) {
            if (respuestasUsuario.hasOwnProperty(nPregunta)) {
                let valorUsuario = String(respuestasUsuario[nPregunta]);
                let input = form.querySelector(`input[type="radio"][name="${nPregunta}"][value="${valorUsuario}"]`);
                if (input) {
                    input.checked = true;
                }
            }
        }

        if (Object.keys(respuestasUsuario).length > 0) {
            btnEnviar.disabled = true;
            btnEnviar.style.backgroundColor = "#929292ff";
        }

        
        // Colocar los iconos de check y X según aciertos/errores
        for (let nPregunta in respuestasCorrectas) {
            if (respuestasCorrectas.hasOwnProperty(nPregunta)) {
                let opcionCorrecta = String(respuestasCorrectas[nPregunta]);
                let opcionUsuario  = (respuestasUsuario && respuestasUsuario[nPregunta] !== undefined) ? String(respuestasUsuario[nPregunta]) : null;

                // Coge todos los radios de esa pregunta
                let inputs = form.querySelectorAll(
                    `input[type="radio"][name="${nPregunta}"]`
                );

                inputs.forEach(input => {
                    let li = input.closest('li'); // Va a li (contenedor padre)
                    let valor = String(input.value);

                    // Marcar respuestas CORRECTAS con check verde
                    if (valor === opcionCorrecta) {
                        let iconCheck = document.createElement('i');
                        iconCheck.className = 'fa-regular fa-circle-check';
                        li.appendChild(iconCheck);
                    }

                    // Marcar respuestas INCORRECTAS del usuario con X roja
                    if (opcionUsuario !== null && valor === opcionUsuario && valor !== opcionCorrecta) {
                        let iconX = document.createElement('i');
                        iconX.className = 'fa-regular fa-circle-xmark';
                        li.appendChild(iconX);
                    }
                });
            }
        }
        
    }
});
