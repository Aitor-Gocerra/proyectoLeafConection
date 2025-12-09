class MPalabra {

    constructor() {
        // URL al controlador centralizado
        this.API_URL = 'index.php?c=Palabras&m=obtenerPalabraJSON';
    }

    async obtenerPalabraCorrecta() {
        try {
            const respuesta = await fetch(this.API_URL);

            if (!respuesta.ok) {
                throw new Error(`Error HTTP: ${respuesta.status}`);
            }

            const datos = await respuesta.json();

            if (!datos.success) {
                throw new Error(datos.error || 'Error desconocido al obtener la palabra');
            }

            return datos;

        } catch (error) {
            console.error('Modelo: Error al obtener la palabra:', error);
            throw error;
        }
    }

    async guardarPartida(idPalabra, tiempo, puntuacion, intentos, idUsuario) {
        try {
            const datosFormulario = new FormData();
            datosFormulario.append('idPalabra', idPalabra);
            datosFormulario.append('tiempo', tiempo);
            datosFormulario.append('puntuacion', puntuacion);
            datosFormulario.append('intentos', intentos);

            if (idUsuario) {
                datosFormulario.append('idUsuario', idUsuario);
            }

            const respuesta = await fetch('index.php?c=Palabras&m=guardarPartida', {
                method: 'POST',
                body: datosFormulario
            });

            if (!respuesta.ok) {
                throw new Error(`Error HTTP: ${respuesta.status}`);
            }

            return await respuesta.json();
        } catch (error) {
            console.error('Modelo: Error al guardar la partida:', error);
            return { success: false, error: error.message };
        }
    }

    normalizarPalabra(palabra) {
        return palabra
            .toLowerCase()
            .trim()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, ""); // Elimina acentos
    }

    validarPalabra(palabraUsuario, palabraCorrecta) {
        const usuarioNormalizada = this.normalizarPalabra(palabraUsuario);
        const correctaNormalizada = this.normalizarPalabra(palabraCorrecta);

        return usuarioNormalizada === correctaNormalizada;
    }
}