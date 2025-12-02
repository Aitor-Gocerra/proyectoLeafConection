let btnAñadirPregunta = document.getElementById("añadirPregunta");
let plantilla = document.querySelector(".cuestionarioPregunta"); // primera pregunta
let contenedor = document.getElementById("cuestionarioContainer");

btnAñadirPregunta.addEventListener("click", function(e) {
    e.preventDefault();

    let totalPreguntas = contenedor.querySelectorAll(".cuestionarioPregunta").length;

    if (totalPreguntas >= 3) {
        alert("Solo puedes añadir un máximo de 3 pistas.");
        btnAñadirPregunta.disabled = true; // desactiva el botón
        return;
    }
    // Clonar la plantilla
    let nuevaPregunta = document.createElement("div");
    nuevaPregunta.classList.add("cuestionarioPregunta");
    nuevaPregunta.innerHTML = plantilla.innerHTML;

    // Limpiar valores de los inputs
    let inputs = nuevaPregunta.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    // Añadir al contenedor de preguntas
    contenedor.appendChild(nuevaPregunta);
});
