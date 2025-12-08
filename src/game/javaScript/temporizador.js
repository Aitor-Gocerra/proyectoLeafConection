// Tiempo de inicio: 5 minutos = 300 segundos
let tiempoRestante = 300;

// Convierte segundos a formato "MM:SS"
function formatearTiempo(segundos) {
    const minutos = Math.floor(segundos / 60);
    const segs = segundos % 60;
    return `${minutos}:${segs.toString().padStart(2, '0')}`;
}

// Actualiza el texto del temporizador en la página
function actualizarDisplay() {
    const elemento = document.querySelector('.temporizador');
    if (elemento) {
        elemento.textContent = formatearTiempo(tiempoRestante);
    }
}

// Inicia la cuenta regresiva
function iniciarTemporizador() {
    // Actualiza el display cada segundo
    setInterval(() => {
        tiempoRestante--;
        actualizarDisplay();

        // Para el temporizador cuando llega a 0
        if (tiempoRestante <= 0) {
            tiempoRestante = 0;
        }
    }, 1000);

    // Muestra el tiempo inicial inmediatamente
    actualizarDisplay();
}

// Devuelve el tiempo que queda
function obtenerTiempoRestante() {
    return tiempoRestante;
}

// Devuelve el tiempo usado
function obtenerTiempoTranscurrido() {
    return 300 - tiempoRestante;
}

// Inicia el temporizador cuando carga la página
document.addEventListener('DOMContentLoaded', iniciarTemporizador);
