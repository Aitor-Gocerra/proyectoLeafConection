class VEstadisticas {
    constructor(controlador) {
        this.controlador = controlador;
        this.tarjetas = document.querySelectorAll('#tablaEstadisticas .tarjetaEstadisticas');
        this.cargarEstadisticas();
        this.cambiarNombre();
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
        const canvas = document.getElementById('graficoPuntaje');

        /**
         * El contexto es la API real que permite la manipulación gráfica
         */
        const contexto = canvas.getContext('2d');

        let puntajes = this.obtenerPuntajes(datosPuntaje);
        let dias = this.obtenerDias(datosPuntaje);

        new Chart(contexto, {
            type: 'line',
            data: {
                labels: dias, // Array de días (L, V, ..)
                datasets: [{
                    backgroundColor: '#38a169',
                    borderColor: '#38a169',
                    hoverBackgroundColor: '#38b2ac',
                    label: '',
                    data: puntajes, // Puntajes
                    borderWidth: 4,
                    pointRadius: 8,
                    pointHoverRadius: 12
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: {
                            drawTicks: false,           // quita las marcas
                            drawOnChartArea: false,     // quita las líneas verticales
                            color: '#48bb78'  
                        },
                        offset: true                    // centra los puntos en la categoría
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawTicks: false,
                            drawOnChartArea: true,      // mantiene solo líneas horizontales
                            color: '#48bb78'          // color de las líneas horizontales
                        }
                    }
                }
            }
        })
    }

    obtenerPuntajes(datosPuntaje){
        let datos = [];
        for (let p of datosPuntaje){
            datos.push(Number(p.puntaje));
        }
        return datos;
    }

    obtenerDias(datosPuntaje){
        const dias = ['D','L','M','X','J','V','S'];
        let datos = [];
        for (let p of datosPuntaje){
            let [y,m,d] = p.fecha.split('-').map(Number);
            let dt = new Date(y, m-1, d);
            datos.push(dias[dt.getDay()]);
        }
        return datos;
    }

    cambiarNombre(){
        if (NOMBRE_AMIGO) {
            let titulo = document.getElementById("tituloEstadisticas");
            if (titulo) {
                titulo.innerHTML = `Estadísticas de ${NOMBRE_AMIGO}`;
            }
        }
    }
}
