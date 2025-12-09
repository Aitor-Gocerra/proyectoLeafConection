class CPalabra {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
        this.palabraCorrecta = null;
        this.intentos = 0;
        this.idPalabra = null;

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

        this.intentos++;
        const esCorrecta = this.modelo.validarPalabra(palabraUsuario, this.palabraCorrecta);

        if (esCorrecta) {
            this.vista.mostrarExito(this.palabraCorrecta);

            // Calcular puntuación y enviar datos
            const tiempo = obtenerTiempoTranscurrido();
            const puntuacion = Math.max(0, 100 - (this.intentos * 5)); // Puntuación básica

            this.modelo.guardarPartida(this.idPalabra, tiempo, puntuacion, this.intentos, ID_USUARIO)
                .then(res => {
                    if (res && res.success) {
                        console.log('Partida guardada correctamente');
                    } else {
                        console.error('Error al guardar partida:', res);
                    }
                });

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
}