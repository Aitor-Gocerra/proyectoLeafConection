/*import { cIniciarSesion } from '../controlador/cIniciarSesion.js';
const controlador = new cIniciarSesion();*/

//Es la funcion que permite mostrar un mensaje de error en caso de que la contraseña o correo este vacia
function mostrarError(mensaje) {
    const divError = document.getElementById('mensaje-error');
    if (divError) {
        divError.textContent = mensaje;
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

//----------------Comenzamos a revisar que los campos no estén vacíos 

// Asumimos que el evento se engancha al CLICK del botón/enlace de Iniciar Sesión (#btn-login)
document.getElementById('btn-login').addEventListener('click', async function (event) { 
    
    // Detiene la acción por defecto del enlace
    event.preventDefault();

    // Limpiamos errores previos del contenedor global
    limpiarMensajes();

    // 1. Recoger los datos del formulario
    let email = document.getElementById('input-email').value.trim();  
    let password = document.getElementById('input-password').value.trim();  

    
    // 2. VALIDACIÓN FINAL OBLIGATORIA
    if (email === '' || password === '') {
        mostrarError(' El correo electrónico y la contraseña son obligatorios.');
        return; // Detener la ejecución, NO llamar al controlador
    }

    // 3. Le pasamos la información al controlador--> mInicioSesión
    console.log("Vista: Validación OK. Enviando datos al Controlador...");
    controlador.cIniciarSesion(email, password);
});