class VNoticia {
    constructor(controlador) {
        this.controlador = controlador;
        this.formulario = document.getElementById('formNoticia');
        this.botonEnviar = document.getElementById('btnEnviar');

        this.inicializarEventos();
    }

    inicializarEventos() {
        if (this.botonEnviar) {
            this.botonEnviar.addEventListener('click', (evento) => {
                evento.preventDefault(); // Evitar submit tradicional
                this.manejarEnvio();
            });
        }
    }

    manejarEnvio() {
        // Recopilar respuestas
        const datosFormulario = new FormData(this.formulario);
        let respuestasUsuario = {};

        // Iterar sobre las entradas del formulario
        for (let [nombre, valor] of datosFormulario.entries()) {
            if (nombre !== 'tiempo') { // Ignoramos campso hidden extras si los hay
                respuestasUsuario[nombre] = valor;
            }
        }

        console.log(respuestasUsuario);

        // Llamar al controlador
        this.controlador.procesarRespuestas(respuestasUsuario);
    }

    mostrarResultados(respuestasCorrectas, respuestasUsuario, aciertos, puntuacion) {
        // Deshabilitar botón
        this.botonEnviar.disabled = true;
        this.botonEnviar.style.backgroundColor = "#929292ff";
        this.botonEnviar.value = "Resultados enviados";

        // Marcar visualmente
        for (let nPregunta in respuestasCorrectas) {
            const opcionCorrecta = String(respuestasCorrectas[nPregunta]);
            const opcionUsuario = respuestasUsuario[nPregunta] ? String(respuestasUsuario[nPregunta]) : null;

            // Inputs de esta pregunta
            const campos = this.formulario.querySelectorAll(`input[type="radio"][name="${nPregunta}"]`);

            campos.forEach(campo => {
                const elementoLista = campo.closest('li');
                const valor = String(campo.value);

                // Si es la correcta -> Check verde
                if (valor === opcionCorrecta) {
                    this.agregarIcono(elementoLista, 'fa-regular fa-circle-check', 'green');
                }

                // Si usuario marcó esta y es incorrecta -> X roja
                if (opcionUsuario === valor && valor !== opcionCorrecta) {
                    this.agregarIcono(elementoLista, 'fa-regular fa-circle-xmark', 'red');
                }
            });
        }

        this.mostrarNotificacion(`Has obtenido ${puntuacion} puntos`);
    }

    agregarIcono(padre, claseIcono, color) {
        // Evitar duplicados
        if (padre.querySelector('.icono-resultado')) return;

        const icono = document.createElement('i');
        icono.className = `${claseIcono} icono-resultado`;
        icono.style.color = color;
        icono.style.marginLeft = '10px';
        padre.appendChild(icono);
    }

    mostrarError(mensaje) {
        this.mostrarNotificacion(mensaje, 'error');
    }

    mostrarNotificacion(mensaje, tipo = 'info') {
        const notificacion = document.createElement('div');
        notificacion.className = `notificacion notificacion-${tipo}`;
        notificacion.textContent = mensaje;
        document.body.appendChild(notificacion);

        setTimeout(() => notificacion.classList.add('mostrar'), 10);
        setTimeout(() => {
            notificacion.classList.remove('mostrar');
            setTimeout(() => notificacion.remove(), 300);
        }, 3000);
    }
}