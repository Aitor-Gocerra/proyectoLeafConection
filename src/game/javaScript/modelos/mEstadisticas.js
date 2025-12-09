class MEstadisticas {
    constructor() {
        this.API_URL = 'index.php?c=Estadisticas&m=obtenerEstadisticasJSON';
    }

    async obtenerEstadisticas(idUsuario) {
        try {
            const respuesta = await fetch(`${this.API_URL}&idUsuario=${idUsuario}`);
            if (!respuesta.ok) throw new Error(`HTTP error ${respuesta.status}`);
            const datos = await respuesta.json();
            if (!datos.success) throw new Error(datos.error || 'Error al obtener estadísticas');
            return datos;
        } catch (error) {
            console.error('Modelo: Error al obtener estadísticas:', error);
            return { success: false, error: error.message };
        }
    }
}
