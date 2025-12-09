
import { cAmigos } from '../controladores/cAmigos.js';
const controlador = new cAmigos();

/* ESTO ES LO QUE LE PASAMOS AL MODELO PARA QUE REUTILICE DE ESTA VISTA DE AMIGO */
const miObjetoVista = {
    mostrarError: mostrarError, 
    mostrarExito: mostrarExito,
    limpiarMensajes: limpiarMensajes,
    navegarATab: navegarATab,
};

/* AQUÍ TENEMOS DOS BOTONES QUE PARA IR CAMBIANDO DE LISTA DE AMIGOS O ACEPTAR/RECHAZAR SOLICITUDES DE NUEVAS PERSONAS */

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

// LO UTILIZO PARA RECARGAR LA PAGINA CUANDO CAMBIO DE BOTONES Y QUE SE ACTUALICE LIS AMIGOS Y LAS SOLICITUDES ENTRANTES
function navegarATab() {

    let newUrl = window.location.pathname + '?c=Usuarios&m=amigos';
    window.location.href = newUrl;
}

//LA USO EN EL CONTROLADOR PARA MOSTRAR QUE SALIO BIEN EL ENVIAR LA SOLICITUD DE AMISTAD QUE ESTO SE CONTROLARA EN EL MODELO
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

/* VERIFICA O VALIDA QUE EL CAMPO DE USUARIO CUANDO ENVIAMOS LA SOLICITUD NO ESTE VACÍO */
document.getElementById('encontrarAmigo').addEventListener('click', async function (event) { 
    
    event.preventDefault();

    limpiarMensajes();

    // Recojo el nick del usuario y válido que el campo no esté vacío
    let idAmigo = document.getElementById('introducirAmigo').value.trim();
    
    if (idAmigo === '') {
        mostrarError('El usuario no está completo.');
        return;
    }

    console.log("Vista: Validación OK. Enviando datos al Controlador...");
    controlador.enviarSolicitud(idAmigo);
});

//fUNCION PARA LOS BOTONES ACEPTAR O RECHAZAR SI SE OCULTAN INDEPENDIENTEMENTE LO QUE HAGAS
let botonAceptar = document.querySelectorAll('.aceptarSolicitud');
let botnRechazar = document.querySelectorAll('.rechazarSolicitud');

// Tienes que recorrer la lista de botones obligatoriamente
botonAceptar.forEach(boton => {
    boton.addEventListener('click', async function (event){

        event.preventDefault();
        limpiarMensajes();

        let idUsuario = this.getAttribute('value');

        // Ocultamos el botón 
        this.style.display = 'none';
        // Buscamos el botón de rechazar que está al lado para ocultarlo también
        this.parentElement.querySelector('.rechazarSolicitud').style.display = 'none';

        // Llamamos al controlador
        controlador.aceptarSolicitud(idUsuario);
    });
});

botnRechazar.forEach(boton => {
    boton.addEventListener('click', async function (event){
        event.preventDefault();
        limpiarMensajes();

        // Definimos usuario
        let idUsuario = this.getAttribute('value');

        this.style.display = 'none';
        this.parentElement.querySelector('.aceptarSolicitud').style.display = 'none';

        controlador.rechazarEliminar(idUsuario);
    })
});

    const modal = document.getElementById('confirmModal');
    const contenedorMisAmigos = document.getElementById('misAmigos');

    // 1. ABRIR MODAL
    if (contenedorMisAmigos) {
        contenedorMisAmigos.addEventListener('click', function(e) {
            
            const botonEliminar = e.target.closest('.eliminarAmigo');

            if (botonEliminar) {
                e.preventDefault();
                
                if(modal) modal.classList.add('active'); 
            }
        });
    }

    // 2. CERRAR MODAL 
    const btnCancelar = document.getElementById('cancelBtn');
    if (btnCancelar) {
        btnCancelar.addEventListener('click', function() {
            if(modal) modal.classList.remove('active');
        });
    }

    const btnConfirmar = document.getElementById('confirmDeleteBtn');
    if (btnConfirmar) {
        btnConfirmar.addEventListener('click', function() {
            console.log("¡Amigo eliminado!");
            
            if(modal) modal.classList.remove('active');
        });
    }

