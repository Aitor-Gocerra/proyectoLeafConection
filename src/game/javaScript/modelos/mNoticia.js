class MNoticia {

    constructor() {
        this.URL_API_JSON = 'index.php?c=Noticias&m=obtenerDatosJSON';
        this.URL_API_GUARDAR = 'index.php?c=Noticias&m=guardarPartida';
    }

    async obtenerDatosPartida() {
        try {
            const respuesta = await fetch(this.URL_API_JSON);
            if (!respuesta.ok) throw new Error(`Error HTTP: ${respuesta.status}`);

            const datos = await respuesta.json();
            if (!datos.success) throw new Error(datos.error || 'Error obteniendo datos');

            return datos;
        } catch (error) {
            console.error('Modelo: Error al obtener datos:', error);
            throw error;
        }
    }

    async guardarPartida(idNoticia, tiempo, puntuacion) {
        try {
            const datosFormulario = new FormData();
            datosFormulario.append('idNoticia', idNoticia);
            datosFormulario.append('tiempo', tiempo);
            datosFormulario.append('puntuacion', puntuacion);


            const respuesta = await fetch(this.URL_API_GUARDAR, {
                method: 'POST',
                body: datosFormulario
            });

            if (!respuesta.ok) throw new Error(`Error HTTP: ${respuesta.status}`);

            const datos = await respuesta.json();
            if (!datos.success) throw new Error(datos.error || 'Error al guardar');

            return datos;

        } catch (error) {
            console.error('Modelo: Error al guardar:', error);
            return { success: false, error: error.message };
        }
    }
}
