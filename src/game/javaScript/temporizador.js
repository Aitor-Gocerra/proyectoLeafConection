
let tiempoRestante = 300; // 5 minutos en segundos
let intervalo = null;

function formatearTiempo(segundos) {
    const minutos = Math.floor(segundos / 60);
    const segs = segundos % 60;
    return `${minutos}:${segs.toString().padStart(2, '0')}`;
}

function actualizarDisplay() {
    const elemento = document.querySelector('.temporizador');
    if (elemento) {
        const icono = elemento.querySelector('i');
        const iconoHTML = icono ? icono.outerHTML + ' ' : '';
        elemento.innerHTML = iconoHTML + formatearTiempo(tiempoRestante);
    }
}

function iniciarTemporizador() {
    if (intervalo) return; // Ya está corriendo

    intervalo = setInterval(() => {
        tiempoRestante--;
        actualizarDisplay();

        // Cuando el tiempo se agota, detener
        if (tiempoRestante <= 0) {
            detenerTemporizador();
        }
    }, 1000);

    actualizarDisplay();
}

function detenerTemporizador() {
    if (intervalo) {
        clearInterval(intervalo);
        intervalo = null;
    }
}


function obtenerTiempoRestante() {
    return tiempoRestante;
}


function obtenerTiempoTranscurrido() {
    return 300 - tiempoRestante;
}

document.addEventListener('DOMContentLoaded', function () {
    iniciarTemporizador();
});
