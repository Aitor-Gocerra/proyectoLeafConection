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

    async guardarPartida(idPalabra, tiempo, puntuacion, intentos) {
        try {
            const formData = new FormData();
            formData.append('idPalabra', idPalabra);
            formData.append('tiempo', tiempo);
            formData.append('puntuacion', puntuacion);
            formData.append('intentos', intentos);

            const respuesta = await fetch('index.php?c=Palabras&m=guardarPartida', {
                method: 'POST',
                body: formData
            });

            if (!respuesta.ok) {
                throw new Error(`Error HTTP: ${respuesta.status}`);
            }

            const datos = await respuesta.json();

            if (!datos.success) {
                throw new Error(datos.error || 'Error al guardar la partida');
            }

            return datos;

        } catch (error) {
            console.error('Modelo: Error al guardar la partida:', error);
            // No lanzamos error para no interrumpir la experiencia del usuario, solo logueamos
            return { success: false, error: error.message };
        }
    }
}