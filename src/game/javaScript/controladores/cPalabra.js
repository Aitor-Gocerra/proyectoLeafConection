class CPalabra {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
        this.palabraCorrecta = null;
        this.idPalabra = null;
        this.intentos = 0;

        // Cargar la palabra correcta al iniciar
        this.inicializar();
    }

    async inicializar() {
        try {
            const datos = await this.modelo.obtenerPalabraCorrecta();
            this.palabraCorrecta = datos.palabra;
            this.idPalabra = datos.idPalabra;
            console.log('Palabra cargada correctamente');
        } catch (error) {
            console.error('Controlador: Error al inicializar:', error);
            this.vista.mostrarError('No se pudo cargar la palabra del día');
        }
    }

    validarRespuesta(palabraUsuario) {
        if (!palabraUsuario || palabraUsuario.trim() === '') {
            this.vista.mostrarError('Por favor, ingresa una palabra');
            return;
        }

        if (!this.palabraCorrecta) {
            this.vista.mostrarError('No se ha cargado la palabra correcta');
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
            this.vista.mostrarError('No hay palabra disponible');
        }
    }

    async guardarJuego() {
        if (!this.idPalabra) return;

        // Obtener datos del temporizador (asumiendo que existen estas funciones globales o en un módulo)
        // Puedes necesitar ajustar esto según cómo tengas implementado el temporizador
        const tiempoTranscurrido = typeof obtenerTiempoTranscurrido === 'function' ? obtenerTiempoTranscurrido() : 0;
        const tiempoRestante = typeof obtenerTiempoRestante === 'function' ? obtenerTiempoRestante() : 0;

        // Puntuación sencilla: 1 punto por segundo restante
        const puntuacion = tiempoRestante;

        const resultado = await this.modelo.guardarPartida(
            this.idPalabra,
            tiempoTranscurrido,
            puntuacion,
            this.intentos
        );

        if (resultado.success) {
            console.log('Partida guardada. Puntuación:', puntuacion);
        } else {
            console.warn('No se pudo guardar la partida:', resultado.error);
        }
    }
}