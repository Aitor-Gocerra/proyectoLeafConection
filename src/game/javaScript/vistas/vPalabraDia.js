class VPalabra {

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
        // Crear el modal
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.style.display = 'block'; // Mostrar inmediatamente

        const modalContenido = document.createElement('div');
        modalContenido.className = 'modal-contenido';

        // Botón de cerrar
        const cerrarSpan = document.createElement('span');
        cerrarSpan.className = 'cerrar-modal';
        cerrarSpan.textContent = 'x';

        // Contenido del éxito
        const contenidoExito = `
            <div class="icono-resultado">
                <i class="fas fa-check-circle"></i>
            </div>
            <p class="mensaje-resultado">¡Correcto!</p>
            <h3 class="texto-solucion">${palabraCorrecta.toUpperCase()}</h3>
            <p class="submensaje">¡Has acertado la palabra del día!</p>
        `;

        const divMensaje = document.createElement('div');
        divMensaje.innerHTML = contenidoExito;

        // Armar el modal
        modalContenido.appendChild(cerrarSpan);
        modalContenido.appendChild(divMensaje);
        modal.appendChild(modalContenido);

        // Añadir al DOM
        document.body.appendChild(modal);

        // Eventos para cerrar
        const cerrarModal = () => {
            modal.style.display = 'none';
            modal.remove(); // Limpiar del DOM al cerrar
        };

        cerrarSpan.onclick = cerrarModal;

        // Cerrar si se hace clic fuera del contenido
        window.onclick = (event) => {
            if (event.target == modal) {
                cerrarModal();
            }
        };
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