let btnEnviar = document.getElementById('btnEnviar');
let form = document.getElementById('formNoticia');

document.addEventListener('DOMContentLoaded', function(e) {

    let respuestasCorrectas = window.respuestasCorrectas || {};
    let respuestasUsuario   = window.respuestasUsuario || {};

    // Restaurar lo que ha marcado el jugador a cada radio



    if (form && respuestasUsuario) {
        for (let nPregunta in respuestasUsuario) {
            if (Object.prototype.hasOwnProperty.call(respuestasUsuario, nPregunta)) {
                let valorUsuario = String(respuestasUsuario[nPregunta]);
                let input = form.querySelector(`input[type="radio"][name="${nPregunta}"][value="${valorUsuario}"]`);
                if (input) input.checked = true;
            }
        }




        if (Object.keys(respuestasUsuario).length > 0) {
            btnEnviar.disabled = true;
            btnEnviar.style.backgroundColor = "#929292ff";
        }
    }






    // Marcar iconos de acierto/error
    if (form && respuestasCorrectas) {
        for (let nPregunta in respuestasCorrectas) {
            if (Object.prototype.hasOwnProperty.call(respuestasCorrectas, nPregunta)) {
                let opcionCorrecta = String(respuestasCorrectas[nPregunta]);
                let opcionUsuario  = (respuestasUsuario && respuestasUsuario[nPregunta] !== undefined) ? String(respuestasUsuario[nPregunta]) : null;



                
                let inputs = form.querySelectorAll(`input[type="radio"][name="${nPregunta}"]`);
                inputs.forEach(input => {
                    let li = input.closest('li');
                    if (!li) return;
                    let valor = String(input.value);

                    if (valor === opcionCorrecta) {
                        let iconCheck = document.createElement('i');
                        iconCheck.className = 'fa-regular fa-circle-check';
                        li.appendChild(iconCheck);
                    }

                    if (opcionUsuario !== null && valor === opcionUsuario && valor !== opcionCorrecta) {
                        let iconX = document.createElement('i');
                        iconX.className = 'fa-regular fa-circle-xmark';
                        li.appendChild(iconX);
                    }
                });
            }
        }
    }

    // Validación en cliente: impedir envío si faltan preguntas
    if (form && btnEnviar && Object.keys(respuestasCorrectas).length > 0 && !btnEnviar.disabled) {
        form.addEventListener('submit', function(ev) {
            // contar preguntas esperadas
            const preguntasEsperadas = Object.keys(respuestasCorrectas).length;
            let respondidas = 0;





            for (let nPregunta in respuestasCorrectas) {
                if (Object.prototype.hasOwnProperty.call(respuestasCorrectas, nPregunta)) {
                    let selector = `input[type="radio"][name="${nPregunta}"]:checked`;
                    if (form.querySelector(selector)) respondidas++;
                }
            }





            if (respondidas < preguntasEsperadas) {
                ev.preventDefault();
                // Mensaje amigable al usuario (puedes cambiar por un modal)
                alert(`Debes responder las ${preguntasEsperadas} preguntas. Faltan ${preguntasEsperadas - respondidas}.`);
                return false;
            }
        });
    }

});