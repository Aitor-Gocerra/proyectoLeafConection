import cRegistrarse from '../controlador/cRegistrarse.js';
const controlador = new cRegistrarse();

//Es la funcion que permite mostrar un mensaje de error en caso de que la contraseña o correo este vacia
function mostrarError(mensaje) {
    const divError = document.getElementById('mensaje-error');
    if (divError) {
        divError.textContent = mensaje;
        divError.style.display = 'block';
        divError.style.color = 'red';
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
////// ESTA VARIABLE SE LA VAMOS A PASAR AL CONTROLADOR Y MODELO PARA QUE PUEDA UTILIZAR EL DIV DE ERRORES 

// ESTA VARIABLE ES UN OBJETO
const miObjetoVista = {
    mostrarError: mostrarError, 
    limpiarMensajes: limpiarMensajes,
};
controlador.vista = miObjetoVista;

//----------------Comenzamos a revisar que los campos no estén vacíos 

document.getElementById('btn-crearcuenta').addEventListener('click', async function (event) { 
    
    // Detiene la acción por defecto del enlace
    event.preventDefault();

    // Limpiamos errores previos del contenedor global
    limpiarMensajes();

    // 1. Recoger los datos del formulario
    let email = document.getElementById('input-correo').value.trim();  
    let usuario = document.getElementById('input-usuario').value.trim();
    let password = document.getElementById('input-contrasenia').value.trim();  
    let password2 = document.getElementById('input-contrasenia2').value.trim();  

    
    // 2. Valida el campo que esté vacío o no 
    if (email === '' || password === '' || password2 === '' || usuario === '') {
        mostrarError(' El correo electrónico y la contraseña están vacíos.');
        return; // Detener la ejecución, NO llamar al controlador
    }

    // 3. Valida también que las contraseñas coincidan
    if (password2 !==  password ) {
        mostrarError(' Las contraseñas no coinciden');
        return; // Detener la ejecución, NO llamar al controlador
    }

    // 4. Le pasamos la información al controlador--> mInicioSesión
    controlador.iniciarRegistro(usuario, email, password);
    console.log("Vista: Validación OK. Enviando datos al Controlador...");
});