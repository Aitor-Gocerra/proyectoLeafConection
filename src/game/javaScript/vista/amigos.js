/*import { cAmigos } from '../controlador/cAmigos.js';
const controlador = new cAmigos();*/

/* MENÚ QUE CAMBIA LOS DISPLAY DE LISTA DE AMIGOS Y LAS SOLICITUDES */

const btnAmigos = document.getElementById("todosAmigos");
const btnSolicitudes = document.getElementById("solicitudesAmigos");
const misAmigos = document.getElementById("misAmigos");
const misSolicitudes = document.getElementById("misSolicitudes");

btnAmigos.addEventListener("click", () => {
    misAmigos.style.display = "block";
    misSolicitudes.style.display = "none";

    btnAmigos.classList.add("botonActivo");
    btnAmigos.classList.remove("botonNoActivo");

    btnSolicitudes.classList.add("botonNoActivo");
    btnSolicitudes.classList.remove("botonActivo");

    navegarATab();
});

btnSolicitudes.addEventListener("click", () => {
    misAmigos.style.display = "none";
    misSolicitudes.style.display = "block";

    btnSolicitudes.classList.add("botonActivo");
    btnSolicitudes.classList.remove("botonNoActivo");

    btnAmigos.classList.add("botonNoActivo");
    btnAmigos.classList.remove("botonActivo");

});

// Lo uso para recargar la pagina en caso que eliminemosaceptemos o rechazemos a una persona
function navegarATab() {

    let newUrl = window.location.pathname + '?c=Paginas&m=amigos';
    window.location.href = newUrl;
}

//Es la funcion que permite mostrar un mensaje de error en caso de que la contraseña o correo este vacia
function mostrarError(mensaje) {
    const divError = document.getElementById('mensaje-error-amigos');
    if (divError) {
        divError.textContent = mensaje;
        divError.style.color = 'red' ;
        divError.style.display = 'block';
        divError.style.fontSize = '0.8rem';
        divError.style.marginLeft = '1rem';
    }
}

//Antes de empezar con otro intento de contraseña se limpia en contenido y no muestra nada 
function limpiarMensajes() {
    const divError = document.getElementById('mensaje-error-amigos');
    if (divError) {
        divError.textContent = '';
        divError.style.display = 'none';
    }
}

/*const miObjetoVista = {
    mostrarError: mostrarError, 
    limpiarMensajes: limpiarMensajes,
};*/

//controlador.vista = miObjetoVista;

document.getElementById('encontrarAmigo').addEventListener('click', async function (event) { 
    
    event.preventDefault();

    limpiarMensajes();

    // Recojo el nick del usuario y válido que el campo no esté vacío
    let usuario = document.getElementById('introducirAmigo').value.trim();  
    
    if (usuario === '') {
        mostrarError('El usuario no está completo.');
        return; // 🔑 Esta validación simple ahora se ejecutará.
    }

    console.log("Vista: Validación OK. Enviando datos al Controlador...");
    /*controlador.cAmigos(usuario);*/
});

    const btnEliminarAmigo = document.getElementById('eliminarAmigoBtn');
    const confirmModal = document.getElementById('confirmModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');


    function mostrarModal() {
        confirmModal.classList.add('active'); 
    }

    function ocultarModal() {
        confirmModal.classList.remove('active');
    }


    if (btnEliminarAmigo) {
        btnEliminarAmigo.addEventListener('click', function (event) {
            event.preventDefault(); 
            mostrarModal(); 
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', ocultarModal);
    }

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            ocultarModal(); 
            /*controlador.cAmigos(usuario);*/
        });
    }

