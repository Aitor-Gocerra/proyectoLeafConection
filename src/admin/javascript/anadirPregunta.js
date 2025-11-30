        let btnAñadirPregunta = document.getElementById("añadirPregunta");
        let plantilla = document.querySelector(".cuestionario_pregunta");
        let noticiaFormulario = document.getElementById("noticia_formulario");

        btnAñadirPregunta.addEventListener("click", function(e) {
            e.preventDefault();
            
            let nuevaPregunta = document.createElement("div");
            nuevaPregunta.classList.add("cuestionario_pregunta");
            nuevaPregunta.innerHTML = plantilla.innerHTML;

            noticiaFormulario.appendChild(nuevaPregunta);
        });