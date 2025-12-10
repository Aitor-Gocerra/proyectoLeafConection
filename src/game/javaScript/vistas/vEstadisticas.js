class VEstadisticas {
    constructor(controlador) {
        this.controlador = controlador;
        this.tarjetas = document.querySelectorAll('#tablaEstadisticas .tarjetaEstadisticas');
        this.cargarEstadisticas();
    }

    async cargarEstadisticas() {
        try {
            let datos = await this.controlador.obtenerEstadisticas(); // Pedir datos al controlador

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
            'racha',
            'datosPuntuacion'
        ];

        console.log(datos[valores[4]]); // va bien
        console.log(datos[valores[5]]); // va bien correcto


        this.tarjetas.forEach((tarjeta, i) => {
            if (i != 5){
                let valor = datos[valores[i]] ?? 'nada';
                tarjeta.querySelector('h3').textContent = valor;
            }
        });

        this.cargarGrafico(datos[valores[5]]);
    }

    mostrarError(mensaje) {
        console.error(mensaje);
        alert(mensaje);
    }

    cargarGrafico(datosPuntaje){
        const canvas = document.getElementById('myChart');
        const ctx = canvas.getContext('2d');

        let puntajes = this.obtenerPuntajes(datosPuntaje);
        let fechas = this.obtenerFechas(datosPuntaje);

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: fechas,
            datasets: [{
                label: '# of Votes',
                data: puntajes,
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    }

    obtenerPuntajes(datosPuntaje){
        let datos = [];
        for (let p of datosPuntaje){
            datos.push(Number(p.puntaje));
        }
        return datos;
    }

    obtenerFechas(datosPuntaje){
        let datos = [];
        for (let p of datosPuntaje){
            datos.push(p.fecha);
        }
        return datos;
    }
}
