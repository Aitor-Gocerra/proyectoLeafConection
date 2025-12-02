let btnAñadirPregunta = document.getElementById("añadirPregunta");
let plantilla = document.querySelector(".cuestionarioPregunta"); // primera pregunta
let contenedor = document.getElementById("cuestionarioContainer");
// **Nuevas variables para el límite**
const LIMITE_PREGUNTAS = 3;
let contadorPreguntas = 1; // Ya tenemos una pregunta inicial (la plantilla)

btnAñadirPregunta.addEventListener("click", function(e) {
    e.preventDefault();

    // **Comprobar si el límite se ha alcanzado**
    if (contadorPreguntas >= LIMITE_PREGUNTAS) {
        return; 
    }

    // Usando tu método original:
    let nuevaPregunta = document.createElement("div");
    nuevaPregunta.classList.add("cuestionarioPregunta");
    nuevaPregunta.innerHTML = plantilla.innerHTML;

    // Limpiar valores de los inputs
    let inputs = nuevaPregunta.querySelectorAll('input');
    inputs.forEach(input => input.value = '');

    // Añadir al contenedor de preguntas
    contenedor.appendChild(nuevaPregunta);

    // **Incrementar el contador**
    contadorPreguntas++;

    // Opcional: Desactivar el botón después de agregar la última pregunta
    if (contadorPreguntas >= LIMITE_PREGUNTAS) {
        btnAñadirPregunta.disabled = true;
    }
});