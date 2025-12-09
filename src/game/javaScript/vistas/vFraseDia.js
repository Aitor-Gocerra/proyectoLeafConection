class VFrase {

    constructor(controlador) {
        this.controlador = controlador;

        // Elementos del DOM
        this.contenedorAcierto = document.querySelector('.contenedorAcierto');
        this.inputRespuesta = document.querySelector('.introducirPalabra');
        this.botonEnviar = document.querySelector('.enviarPalabra');

        // Inicializar eventos
        this.inicializarEventos();
    }

    /* Inicio los listenes */
    inicializarEventos() {
        // Click en el botón
        this.botonEnviar.addEventListener('click', () => {
            this.manejarEnvio();
        });

        // Enter en el input
        this.inputRespuesta.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.manejarEnvio();
            }
        });
    }

    /* Como envio la respuesta */
    manejarEnvio() {
        const palabraUsuario = this.inputRespuesta.value;
        this.controlador.validarRespuesta(palabraUsuario);
    }

    mostrarExito(palabraCorrecta) {
        this.limpiarContenedor();

        const divRespuesta = document.createElement('div');
        divRespuesta.className = 'zonaRespuesta exito';
        divRespuesta.innerHTML = `
            <div class="icono-resultado">
                <i class="fas fa-check-circle"></i>
            </div>
            <p class="mensaje-resultado">¡Correcto!</p>
            <h3 class="texto-solucion">${palabraCorrecta.toUpperCase()}</h3>
            <p class="submensaje">¡Has completado la frase del día!</p>
        `;

        this.contenedorAcierto.appendChild(divRespuesta);
    }

    mostrarFallo(palabraUsuario) {
        // No limpiamos el contenedor para que el usuario pueda intentar de nuevo
        this.mostrarNotificacion('Palabra incorrecta. Intenta de nuevo', 'error');

        // Limpiar el input
        this.inputRespuesta.value = '';

    }

    mostrarError(mensaje) {
        this.mostrarNotificacion(mensaje, 'error');
    }

    mostrarNotificacion(mensaje, tipo = 'info') {
        // Crear notificación
        const notificacion = document.createElement('div');
        notificacion.className = `notificacion notificacion-${tipo}`;
        notificacion.textContent = mensaje;

        // Añadir al body
        document.body.appendChild(notificacion);

        // Mostrar con animación
        setTimeout(() => {
            notificacion.classList.add('mostrar');
        }, 10);

        // Ocultar después de 3 segundos
        setTimeout(() => {
            notificacion.classList.remove('mostrar');
            setTimeout(() => {
                notificacion.remove();
            }, 300);
        }, 3000);
    }

    limpiarContenedor() {
        // Eliminar solo las zonas de respuesta, mantener el input y botón
        const zonasRespuesta = this.contenedorAcierto.querySelectorAll('.zonaRespuesta');
        zonasRespuesta.forEach(zona => zona.remove());
    }

}
