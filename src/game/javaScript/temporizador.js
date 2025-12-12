let tiempoTotal = 5 * 60; /* 60 segundos = 1 minuto */
let intervalo;

const temporizadorDisplay = document.querySelector('#temporizador');

function actualizarTemporizador(segundos) {
    const minutos = Math.floor(segundos / 60);
    const segundosRestantes = segundos % 60;

    const minutosStr = String(minutos).padStart(2, '0'); 
    const segundosStr = String(segundosRestantes).padStart(2, '0');

    temporizadorDisplay.textContent = minutosStr + ':' +segundosStr ;
}

function iniciarTemporizador() {

    actualizarTemporizador(tiempoTotal);

    intervalo = setInterval(() => {
        tiempoTotal--;

        actualizarTemporizador(tiempoTotal);

        if (tiempoTotal <= 0) {
            clearInterval(intervalo);
            temporizadorDisplay.innerHTML = "<b>¡Tiempo terminado!</b>";
            
        }
    }, 1000);
}


iniciarTemporizador();












