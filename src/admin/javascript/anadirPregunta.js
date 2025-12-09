document.addEventListener('DOMContentLoaded', function() {
    let btnAñadirPregunta = document.getElementById("btnAnadirPregunta");
    let plantilla = document.querySelector(".cuestionarioPregunta");
    let contenedor = document.getElementById("cuestionarioContainer");

    if (!btnAñadirPregunta) {
        console.error("No se encontró el botón btnAnadirPregunta");
        return;
    }

    btnAñadirPregunta.addEventListener("click", function (e) {
        e.preventDefault();

        let totalPreguntas = contenedor.querySelectorAll(".cuestionarioPregunta").length;

        if (totalPreguntas >= 3) {
            alert("Solo puedes añadir un máximo de 3 pistas.");
            btnAñadirPregunta.disabled = true;
            return;
        }
        
        let nuevaPregunta = document.createElement("div");
        nuevaPregunta.classList.add("cuestionarioPregunta");
        nuevaPregunta.innerHTML = plantilla.innerHTML;

        let inputs = nuevaPregunta.querySelectorAll('input');
        inputs.forEach(input => input.value = '');

        contenedor.appendChild(nuevaPregunta);
    });
});