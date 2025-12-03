/* === PARTE SUPERIOR DE AMIGOS.JS === */
import { cAmigos } from '../controlador/cAmigos.js';
const controlador = new cAmigos();

// 🔑 Conexión Vista -> Controlador
const miObjetoVista = {
    mostrarError: mostrarError, 
    mostrarExito: mostrarExito,
    limpiarMensajes: limpiarMensajes,
    navegarATab: navegarATab,
};

controlador.vista = miObjetoVista;

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

// Función de Éxito (necesaria para el controlador)
function mostrarExito(mensaje) {
    const divError = document.getElementById('mensaje-error-amigos');
    if (divError) {
        divError.textContent = mensaje;
        divError.style.color = 'green';
        divError.style.display = 'block';
        divError.style.fontSize = '0.8rem';
        divError.style.marginLeft = '1rem';
    }
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
    }

    console.log("Vista: Validación OK. Enviando datos al Controlador...");
    controlador.cAmigos(usuario);
});

//fUNCION PARA LOS BOTONES ACEPTAR O RECHAZAR SI SE OCULTAN INDEPENDIENTEMENTE LO QUE HAGAS
let botonAceptar =  document.getElementById('btnAceptarSolicitud');
let botnRechazar =  document.getElementById('btnRechazarSolicitud');

botonAceptar.addEventListener('click', async function (event){
        event.preventDefault();
        limpiarMensajes();

        botnRechazar.style.display = 'none';
        botonAceptar.style.display = 'none';
        controlador.cAmigos(usuario);
})

botnRechazar.addEventListener('click', async function (event){
        event.preventDefault();
        limpiarMensajes();

        botnRechazar.style.display = 'none';
        botonAceptar.style.display = 'none';
        controlador.cAmigos(usuario);
})

/*********************************MODAL SIRVE PARA CONFIRMAR LA ELIMINACIONDE AMIGOS DEL USUARIO ***************/
    const btnEliminarAmigo = document.getElementById('eliminarAmigoBtn'); /******* BOTON DE ELIMINAR AMIGO DEL MODAL******* */
    const confirmModal = document.getElementById('confirmModal');/******* BOTON DE QUE APAREZCA O SE OCULTE EL MODAL*/
    const cancelBtn = document.getElementById('cancelBtn');/******* BOTON DE CANCELAR ELIMINAR EL AMIGO*/
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn'); /******* BOTON DE ACEPTAR LA ELIMINACION DEL AMIGO*/


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
            controlador.cAmigos(usuario);
        });
    }

