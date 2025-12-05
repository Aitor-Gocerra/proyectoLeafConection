import { cIniciarSesion } from '../controlador/cIniciarSesion.js';
const controlador = new cIniciarSesion();

function mostrarError(mensaje) {
    const divError = document.getElementById('mensaje-error');
    if (divError) {
        divError.textContent = mensaje;
        divError.style.color = 'red' ;
        divError.style.display = 'block';
    }
}

function limpiarMensajes() {
    const divError = document.getElementById('mensaje-error');
    if (divError) {
        divError.textContent = '';
        divError.style.display = 'none';
    }
}

//////// CONEXIÓN CON EL MODELO LO QUE VAYA A NECESITAR

const miObjetoVista = {
    mostrarError: mostrarError, 
    limpiarMensajes: limpiarMensajes,
};

controlador.vista = miObjetoVista;

//EXPLICADO TODO EN REGISTRO ES LO MISMO

document.getElementById('btn-login').addEventListener('click', async function (event) { 
    
    event.preventDefault();

    limpiarMensajes();

    let email = document.getElementById('input-email').value.trim();  
    let password = document.getElementById('input-password').value.trim();  
''
    
    if (email === '' || password === '') {
        mostrarError(' El correo electrónico y la contraseña son obligatorios.');
        return;
    }

    console.log("Vista: Validación OK. Enviando datos al Controlador...");
    controlador.cIniciarSesion(email, password);
});