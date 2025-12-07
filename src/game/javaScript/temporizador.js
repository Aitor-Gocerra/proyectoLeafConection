

// Almacena el tiempo restante en segundos (300 segundos = 5 minutos)
let tiempoRestante = 300;

// Almacena la referencia al intervalo que ejecuta la cuenta regresiva
// null significa que el temporizador no está corriendo
let intervalo = null;

function formatearTiempo(segundos) {
    const minutos = Math.floor(segundos / 60);  // Calcula cuántos minutos completos hay
    const segs = segundos % 60;                  // Calcula los segundos restantes
    // padStart(2, '0') añade un cero al inicio si el número tiene solo un dígito
    // Ejemplo: 5 → "05", 30 → "30"
    return `${minutos}:${segs.toString().padStart(2, '0')}`;
}

function actualizarDisplay() {
    // Busca el elemento HTML con la clase 'temporizador'
    const elemento = document.querySelector('.temporizador');

    if (elemento) {
        // Intenta obtener el icono del reloj (elemento <i>) si existe
        const icono = elemento.querySelector('i');
        // Si hay icono, guarda su código HTML; si no, usa una cadena vacía
        const iconoHTML = icono ? icono.outerHTML + ' ' : '';

        // Actualiza el contenido: icono + tiempo formateado
        // Ejemplo: "<i class="fas fa-clock"></i> 4:59"
        elemento.innerHTML = iconoHTML + formatearTiempo(tiempoRestante);
    }
}

function iniciarTemporizador() {
    // Si ya hay un intervalo corriendo, no hace nada (evita múltiples temporizadores)
    if (intervalo) return;

    // setInterval ejecuta una función cada X milisegundos (1000ms = 1 segundo)
    intervalo = setInterval(() => {
        tiempoRestante--;           // Reduce el tiempo en 1 segundo
        actualizarDisplay();         // Actualiza la visualización en pantalla

        // Si el tiempo llega a 0 o menos, detiene el temporizador
        if (tiempoRestante <= 0) {
            detenerTemporizador();
        }
    }, 1000);  // 1000 milisegundos = 1 segundo

    // Actualiza el display inmediatamente al iniciar (no espera el primer segundo)
    actualizarDisplay();
}

function detenerTemporizador() {
    if (intervalo) {
        clearInterval(intervalo);  // Detiene la ejecución del intervalo
        intervalo = null;           // Resetea la variable a null
    }
}

function obtenerTiempoRestante() {
    return tiempoRestante;
}


function obtenerTiempoTranscurrido() {
    return 300 - tiempoRestante;  // Tiempo inicial (300) - tiempo restante
}


// --- INICIALIZACIÓN AUTOMÁTICA ---

// Espera a que todo el HTML de la página esté cargado
// Esto asegura que el elemento '.temporizador' exista antes de intentar usarlo
document.addEventListener('DOMContentLoaded', function () {
    iniciarTemporizador();  // Inicia el temporizador automáticamente
});
