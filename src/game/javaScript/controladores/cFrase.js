class CFrase {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
        this.palabraCorrecta = null;
        this.idFrase = null;
        this.intentos = 0;

        // Cargar la palabra/respuesta correcta al iniciar
        this.inicializar();
    }

    async inicializar() {
        const datos = await this.modelo.obtenerFraseCorrecta();
        if (datos) {
            this.palabraCorrecta = datos.palabra;
            this.idFrase = datos.idFrase;
            console.log('Frase cargada: ' + this.palabraCorrecta);
        } else {
            console.error('No se pudo cargar la frase');
        }
    }

    validarRespuesta(palabraUsuario) {
        if (!palabraUsuario || palabraUsuario.trim() === '') {
            this.vista.mostrarError('Por favor, ingresa una palabra');
            return;
        }

        if (!this.palabraCorrecta) {
            this.vista.mostrarError('No se ha cargado la frase correcta');
            return;
        }

        const esCorrecta = this.modelo.validarPalabra(palabraUsuario, this.palabraCorrecta);
        this.intentos++;

        if (esCorrecta) {
            this.vista.mostrarExito(this.palabraCorrecta);
            this.guardarJuego();
        } else {
            this.vista.mostrarFallo(palabraUsuario);
        }
    }

    mostrarRespuesta() {
        if (this.palabraCorrecta) {
            this.vista.mostrarSolucion(this.palabraCorrecta);
        } else {
            this.vista.mostrarError('No hay frase disponible');
        }
    }

    async guardarJuego() {
        if (!this.idFrase) return;

        // Obtener datos del temporizador
        const tiempoTranscurrido = obtenerTiempoTranscurrido();
        const tiempoRestante = obtenerTiempoRestante();

        // Puntuación sencilla: 1 punto por segundo restante
        const puntuacion = tiempoTranscurrido;

        const resultado = await this.modelo.guardarPartida(
            this.idFrase,
            tiempoRestante,
            puntuacion,
            this.intentos
        );

        if (resultado.success) {
            console.log('Partida (Frase) guardada. Puntuación:', puntuacion);
        } else {
            console.warn('No se pudo guardar la partida (Frase):', resultado.error);
        }
    }
}
