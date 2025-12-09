class CNoticia {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;

        this.respuestasCorrectas = {};
        this.idNoticia = null;
        this.yaJugado = false;

        // Al crear el controlador, llamamos a iniciar
        this.iniciar();
    }

    async iniciar() {
        // Pedimos los datos al modelo (las respuestas correctas)
        // Usamos await para esperar a que el servidor responda
        let datos = await this.modelo.obtenerDatosPartida();

        // Guardamos las respuestas y el ID de la noticia que nos ha devuelto el modelo
        this.respuestasCorrectas = datos.respuestasCorrectas;
        this.idNoticia = datos.idNoticia;
        console.log("Juego iniciado. Respuestas cargadas.");
    }

    procesarRespuestas(respuestasUsuario) {
        // Si ya ha jugado, no dejamos que juegue otra vez
        if (this.yaJugado == true) {
            return;
        }

        let puntuacion = 0;
        let aciertos = {};

        for (let numeroPregunta in respuestasUsuario) {
            let respuestaDada = respuestasUsuario[numeroPregunta];
            let respuestaCorrecta = this.respuestasCorrectas[numeroPregunta];

            if (respuestaDada == respuestaCorrecta) {
                puntuacion = puntuacion + 3;
                aciertos[numeroPregunta] = true;
            } else {
                aciertos[numeroPregunta] = false;
            }
        }

        // Marcamos que ya ha jugado
        this.yaJugado = true;

        // Pintamos los resultados
        this.vista.mostrarResultados(this.respuestasCorrectas, respuestasUsuario, aciertos, puntuacion);

        // Guardamos la partida en la base de datos
        this.guardarJuego(puntuacion);
    }

    async guardarJuego(puntuacion) {
        // Calculamos el tiempo usando la funcion que tenemos en temporizador.js
        let tiempo = 0;
        // Solo la llamamos si existe, por si acaso
        if (typeof obtenerTiempoTranscurrido === 'function') {
            tiempo = obtenerTiempoTranscurrido();
        }

        // Llamamos al modelo para que envíe los datos al PHP
        await this.modelo.guardarPartida(this.idNoticia, tiempo, puntuacion);
        console.log("Partida guardada con " + puntuacion + " puntos.");
    }
}
