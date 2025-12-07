class modeloPalabra {

    constructor(modelo, palabra) {
        // URL al controlador centralizado
        this.modelo=modelo;
        this.palabra=palabra;
        this.palabraCorrecta= null;
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
            .replace(/[\u0300-\u036f]/g, ""); 
    }

    /**
      @param {string} palabraUsuario 
      @param {string} palabraCorrecta 
      @returns {boolean} 
     */
    validarPalabra(palabraUsuario, palabraCorrecta) {
        const usuarioNormalizada = this.normalizarPalabra(palabraUsuario);
        const correctaNormalizada = this.normalizarPalabra(palabraCorrecta);

        return usuarioNormalizada === correctaNormalizada;
    }
}




