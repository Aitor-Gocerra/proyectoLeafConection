
import { cAmigos } from '../controladores/cAmigos.js';
console.log("!!! EL SCRIPT HA CARGADO !!!");
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

    let newUrl = window.location.pathname + '?c=Paginas&m=amigos';
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

    /* ==========================================
    LÓGICA DEL MODAL (Corregida y Blindada)
    ========================================== */

    const modal = document.getElementById('confirmModal');
    const contenedorMisAmigos = document.getElementById('misAmigos'); // El div que envuelve a toda la lista

    // 1. ABRIR MODAL
    // Usamos "delegación": Escuchamos clicks en toda la lista, no botón por botón.
    if (contenedorMisAmigos) {
        contenedorMisAmigos.addEventListener('click', function(e) {
            
            // El truco: 'closest' busca si lo que has clickado (o su padre) es el botón de eliminar
            const botonEliminar = e.target.closest('.eliminarAmigo');

            if (botonEliminar) {
                e.preventDefault(); // IMPORTANTE: Evita que el botón recargue la página
                
                // Opción A: Si usas clases CSS para mostrarlo
                if(modal) modal.classList.add('active'); 
                
                // Opción B: Si no tienes CSS para '.active', descomenta la línea de abajo para forzarlo:
                // if(modal) modal.style.display = 'flex'; 
                
                console.log("Abriendo modal...");
            }
        });
    }

    // 2. CERRAR MODAL (Botón Cancelar)
    const btnCancelar = document.getElementById('cancelBtn');
    if (btnCancelar) {
        btnCancelar.addEventListener('click', function() {
            if(modal) modal.classList.remove('active');
            // if(modal) modal.style.display = 'none'; // Descomenta si usaste la Opción B
        });
    }

    // 3. CONFIRMAR ELIMINACIÓN (Botón Eliminar del Modal)
    const btnConfirmar = document.getElementById('confirmDeleteBtn');
    if (btnConfirmar) {
        btnConfirmar.addEventListener('click', function() {
            // Aquí llamas a tu función real de borrar
            console.log("¡Amigo eliminado!");
            
            if(modal) modal.classList.remove('active');
            // if(modal) modal.style.display = 'none'; // Descomenta si usaste la Opción B
        });
    }

