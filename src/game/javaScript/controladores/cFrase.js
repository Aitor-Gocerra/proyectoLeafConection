class CFrase {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
        this.palabraCorrecta = null;

        // Cargar la palabra/respuesta correcta al iniciar
        this.inicializar();
    }

    async inicializar() {
        try {
            const datos = await this.modelo.obtenerFraseCorrecta();
            this.palabraCorrecta = datos.palabra; // La palabra que falta en la frase
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

        if (esCorrecta) {
            this.vista.mostrarExito(this.palabraCorrecta);
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
}
