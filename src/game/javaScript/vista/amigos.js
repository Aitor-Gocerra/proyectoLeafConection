/*import { cAmigos } from '../controlador/cAmigos.js';
const controlador = new cAmigos();*/

//Es la funcion que permite mostrar un mensaje de error en caso de que la contraseña o correo este vacia
function mostrarError(mensaje) {
    const divError = document.getElementById('mensaje-error');
    if (divError) {
        divError.textContent = mensaje;
        divError.style.color = 'red' ;
        divError.style.display = 'block';
    }
}

//Antes de empezar con otro intento de contraseña se limpia en contenido y no muestra nada 
function limpiarMensajes() {
    const divError = document.getElementById('mensaje-error');
    if (divError) {
        divError.textContent = '';
        divError.style.display = 'none';
    }
}

/*const miObjetoVista = {
    mostrarError: mostrarError, 
    limpiarMensajes: limpiarMensajes,
};*/

controlador.vista = miObjetoVista; // Ahora esto NO fallará.

document.getElementById('anadirAmigo').addEventListener('click', async function (event) { 
    
    event.preventDefault();

    limpiarMensajes();

    // Recojo el nick del usuario y válido que el campo no esté vacío
    let usuario = document.getElementById('introducirAmigo').value.trim();  
    
    if (usuario === '') {
        mostrarError('El usuario está vacío.');
        return; // 🔑 Esta validación simple ahora se ejecutará.
    }

    console.log("Vista: Validación OK. Enviando datos al Controlador...");
    /*controlador.cAmigos(usuario);*/
});