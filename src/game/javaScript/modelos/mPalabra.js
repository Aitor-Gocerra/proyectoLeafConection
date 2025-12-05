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
}