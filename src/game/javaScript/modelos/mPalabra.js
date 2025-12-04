/**
 * Modelo: Maneja la lógica de datos y comunicación con el servidor
 */
class MPalabra {

    constructor() {
        // URL al controlador centralizado
        this.API_URL = 'index.php?c=Palabras&m=obtenerPalabraJSON';
    }

    /**
     * Obtiene la palabra correcta del día desde el servidor
     * @returns {Promise<Object>} Objeto con la palabra correcta
     */
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

    /**
     * Normaliza una palabra para comparación (sin acentos, minúsculas, sin espacios)
     * @param {string} palabra - Palabra a normalizar
     * @returns {string} Palabra normalizada
     */
    normalizarPalabra(palabra) {
        return palabra
            .toLowerCase()
            .trim()
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, ""); // Elimina acentos
    }

    /**
     * Valida si la palabra del usuario es correcta
     * @param {string} palabraUsuario - Palabra ingresada por el usuario
     * @param {string} palabraCorrecta - Palabra correcta del día
     * @returns {boolean} True si la palabra es correcta
     */
    validarPalabra(palabraUsuario, palabraCorrecta) {
        const usuarioNormalizada = this.normalizarPalabra(palabraUsuario);
        const correctaNormalizada = this.normalizarPalabra(palabraCorrecta);

        return usuarioNormalizada === correctaNormalizada;
    }
}