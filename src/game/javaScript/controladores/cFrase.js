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
        try {
            const datos = await this.modelo.obtenerFraseCorrecta();
            this.palabraCorrecta = datos.palabra; // La palabra que falta en la frase
            this.idFrase = datos.idFrase;
            console.log('Frase cargada correctamente');
        } catch (error) {
            console.error('Controlador: Error al inicializar:', error);
            this.vista.mostrarError('No se pudo cargar la frase del día');
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
        const tiempoTranscurrido = typeof obtenerTiempoTranscurrido === 'function' ? obtenerTiempoTranscurrido() : 0;
        const tiempoRestante = typeof obtenerTiempoRestante === 'function' ? obtenerTiempoRestante() : 0;

        // Puntuación sencilla: 1 punto por segundo restante
        const puntuacion = tiempoRestante;

        const resultado = await this.modelo.guardarPartida(
            this.idFrase,
            tiempoTranscurrido,
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
