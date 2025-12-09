class MFrase {

    constructor() {
        // URL al controlador centralizado para frases
        this.API_URL = 'index.php?c=Frases&m=obtenerFraseJSON';
    }

    async obtenerFraseCorrecta() {
        try {
            const respuesta = await fetch(this.API_URL);

            if (!respuesta.ok) {
                throw new Error(`Error HTTP: ${respuesta.status}`);
            }

            const datos = await respuesta.json();

            if (!datos.success) {
                throw new Error(datos.error || 'Error desconocido al obtener la frase');
            }

            return datos;

        } catch (error) {
            console.error('Modelo: Error al obtener la frase:', error);
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

    async guardarPartida(idFrase, tiempo, puntuacion, intentos) {
        try {
            const formData = new FormData();
            formData.append('idFrase', idFrase);
            formData.append('tiempo', tiempo);
            formData.append('puntuacion', puntuacion);
            formData.append('intentos', intentos);

            const respuesta = await fetch('index.php?c=Frases&m=guardarPartida', {
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
