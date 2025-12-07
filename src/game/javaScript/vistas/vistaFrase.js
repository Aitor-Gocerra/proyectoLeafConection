
class vistaFrase {

    constructor(controlador) {
        this.controlador = controlador;

        
        this.contenedorAcierto = document.querySelector('.contenedorAcierto');
        this.inputRespuesta = document.querySelector('.introducirPalabra');
        this.botonEnviar = document.querySelector('.enviarPalabra');

        
        this.inicializarEventos();
    }

    
    inicializarEventos() {
        
        this.botonEnviar.addEventListener('click', () => {
            this.manejarEnvio();
        });

        
        this.inputRespuesta.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.manejarEnvio();
            }
        });
    }

    
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
            <p class="submensaje">¡Has acertado la palabra del día!</p>
        `;

        this.contenedorAcierto.appendChild(divRespuesta);
    }

    mostrarFallo(palabraUsuario) {
        this.mostrarNotificacion('Palabra incorrecta. Intenta de nuevo', 'error');

        
        this.inputRespuesta.value = '';
        
    }

    mostrarError(mensaje) {
        this.mostrarNotificacion(mensaje, 'error');
    }

    mostrarNotificacion(mensaje, tipo = 'info') {
       
        const notificacion = document.createElement('div');
        notificacion.className = `notificacion notificacion-${tipo}`;
        notificacion.textContent = mensaje;

        
        document.body.appendChild(notificacion);

        
        setTimeout(() => {
            notificacion.classList.add('mostrar');
        }, 10);

        
        setTimeout(() => {
            notificacion.classList.remove('mostrar');
            setTimeout(() => {
                notificacion.remove();
            }, 300);
        }, 3000);
    }

    limpiarContenedor() {
        
        const zonasRespuesta = this.contenedorAcierto.querySelectorAll('.zonaRespuesta');
        zonasRespuesta.forEach(zona => zona.remove());
    }

}






