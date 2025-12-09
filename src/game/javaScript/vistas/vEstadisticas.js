class VEstadisticas {
    constructor(controlador) {
        this.controlador = controlador;
        this.tarjetas = document.querySelectorAll('#tablaEstadisticas .tarjetaEstadisticas');
        this.cargarEstadisticas();
    }

    async cargarEstadisticas() {
        try {
            const datos = await this.controlador.obtenerEstadisticas(); // Pedir datos al controlador

            this.mostrarDatos(datos);


            
        } catch (error) {
            this.mostrarError('No se pudieron cargar las estadísticas');
        }
    }

    mostrarDatos(datos) {
        if (!datos) return;


        let valores = [
            'partidasJugadas',
            'puntuacionTotal',
            'mayorPuntuacion',
            'tiempoMedioPorPartida',
            'racha'
        ];


        this.tarjetas.forEach((tarjeta, i) => {
            let valor = datos[valores[i]] ?? '-';
            tarjeta.querySelector('h3').textContent = valor;
        });
    }

    mostrarError(mensaje) {
        console.error(mensaje);
        alert(mensaje);
    }
}
