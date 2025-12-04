/**
 * Controlador: Coordina el modelo y la vista
 */
class CPalabra {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
        this.palabraCorrecta = null;

        // Cargar la palabra correcta al iniciar
        this.inicializar();
    }

    /**
     * Inicializa el controlador cargando la palabra correcta
     */
    async inicializar() {
        try {
            const datos = await this.modelo.obtenerPalabraCorrecta();
            this.palabraCorrecta = datos.palabra;
            console.log('Palabra cargada correctamente');
        } catch (error) {
            console.error('Controlador: Error al inicializar:', error);
            this.vista.mostrarError('No se pudo cargar la palabra del día');
        }
    }

    /**
     * Valida la palabra ingresada por el usuario
     * @param {string} palabraUsuario - Palabra ingresada por el usuario
     */
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

        if (esCorrecta) {
            this.vista.mostrarExito(this.palabraCorrecta);
        } else {
            this.vista.mostrarFallo(palabraUsuario);
        }
    }

    /**
     * Muestra la respuesta correcta (cuando el usuario se rinde o se acaba el tiempo)
     */
    mostrarRespuesta() {
        if (this.palabraCorrecta) {
            this.vista.mostrarSolucion(this.palabraCorrecta);
        } else {
            this.vista.mostrarError('No hay palabra disponible');
        }
    }
}