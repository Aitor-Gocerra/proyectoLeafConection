class VAmigos {

    constructor(controlador) {
        this.controlador = controlador;
        
        // Elementos del DOM
        this.divError = document.getElementById('mensaje-error-amigos');
        this.btnAmigos = document.getElementById("todosAmigos");
        this.btnSolicitudes = document.getElementById("solicitudesAmigos");
        this.divMisAmigos = document.getElementById("misAmigos");
        this.divMisSolicitudes = document.getElementById("misSolicitudes");
        this.modalConfirmar = document.getElementById('confirmModal');
        this.divContenedorAmigos = document.getElementById('misAmigos');
        
        // Almacenamos el botón de eliminar temporalmente al abrir el modal
        this.botonEliminarActivo = null;

        this.vincularEventos(); 
    }

    // --- MÉTODOS DE UTILIDAD ---

    mostrarExito(mensaje) {
        if (this.divError != null) {
            this.divError.textContent = mensaje;
            this.divError.style.color = 'green';
            this.divError.style.display = 'block';
            this.divError.style.fontSize = '0.8rem';
            this.divError.style.marginLeft = '1rem';
        }
    }

    mostrarError(mensaje) {
        if (this.divError != null) {
            this.divError.textContent = mensaje;
            this.divError.style.color = 'red';
            this.divError.style.display = 'block';
            this.divError.style.fontSize = '0.8rem';
            this.divError.style.marginLeft = '1rem';
        }
    }

    limpiarMensajes() {
        if (this.divError != null) {
            this.divError.textContent = '';
            this.divError.style.display = 'none';
        }
    }

    navegarATab() {
        let urlNueva = window.location.pathname + '?c=Usuarios&m=amigos';
        window.location.href = urlNueva;
    }

    // --- MANEJO DE EVENTOS ---

    vincularEventos() {
        if (this.btnAmigos != null) {
            this.btnAmigos.addEventListener("click", this.cambiarATabAmigos.bind(this));
        }
        if (this.btnSolicitudes != null) {
            this.btnSolicitudes.addEventListener("click", this.cambiarATabSolicitudes.bind(this));
        }

        const btnEnviarSolicitud = document.getElementById('encontrarAmigo');
        if (btnEnviarSolicitud != null) {
            btnEnviarSolicitud.addEventListener('click', this.enviarSolicitudHandler.bind(this));
        }

        this.vincularAceptarRechazar();
        this.vincularModalEliminar();
    }
    
    cambiarATabAmigos() {
        if (this.divMisAmigos != null) {
            this.divMisAmigos.style.display = "block";
        }
        if (this.divMisSolicitudes != null) {
            this.divMisSolicitudes.style.display = "none";
        }
        
        if (this.btnAmigos != null) {
            this.btnAmigos.classList.add("botonActivo");
            this.btnAmigos.classList.remove("botonNoActivo");
        }
        if (this.btnSolicitudes != null) {
            this.btnSolicitudes.classList.add("botonNoActivo");
            this.btnSolicitudes.classList.remove("botonActivo");
        }
        this.navegarATab();
    }

    cambiarATabSolicitudes() {
        if (this.divMisAmigos != null) {
            this.divMisAmigos.style.display = "none";
        }
        if (this.divMisSolicitudes != null) {
            this.divMisSolicitudes.style.display = "block";
        }
        
        if (this.btnSolicitudes != null) {
            this.btnSolicitudes.classList.add("botonActivo");
            this.btnSolicitudes.classList.remove("botonNoActivo");
        }
        if (this.btnAmigos != null) {
            this.btnAmigos.classList.add("botonNoActivo");
            this.btnAmigos.classList.remove("botonActivo");
        }
    }
    
    enviarSolicitudHandler(evento) { 
        evento.preventDefault();
        this.limpiarMensajes();

        let idUsuarioAmigo = document.getElementById('introducirAmigo').value.trim();
        
        if (idUsuarioAmigo === '') {
            this.mostrarError('El usuario no está completo.');
            return;
        }

        this.controlador.enviarSolicitud(idUsuarioAmigo); 
    }

    vincularAceptarRechazar() {
        const botonesAceptar = document.querySelectorAll('.aceptarSolicitud');
        const botonesRechazar = document.querySelectorAll('.rechazarSolicitud');

        botonesAceptar.forEach(boton => {
            boton.addEventListener('click', this.manejarAceptar.bind(this));
        });

        botonesRechazar.forEach(boton => {
            boton.addEventListener('click', this.manejarRechazar.bind(this));
        });
    }

    manejarAceptar(evento) {
        evento.preventDefault();
        this.limpiarMensajes();

        const boton = evento.currentTarget;
        const idUsuario = boton.getAttribute('value');

        boton.style.display = 'none';
        boton.parentElement.querySelector('.rechazarSolicitud').style.display = 'none';

        this.controlador.aceptarSolicitud(idUsuario);
    }

    manejarRechazar(evento) {
        evento.preventDefault();
        this.limpiarMensajes();

        const boton = evento.currentTarget;
        const idUsuario = boton.getAttribute('value');

        boton.style.display = 'none';
        boton.parentElement.querySelector('.aceptarSolicitud').style.display = 'none';

        this.controlador.rechazarEliminar(idUsuario);
    }

    // --- LÓGICA DEL MODAL DE ELIMINACIÓN ---

    vincularModalEliminar() {
        const btnCancelar = document.getElementById('cancelBtn');
        const btnConfirmar = document.getElementById('confirmDeleteBtn');

        if (this.divContenedorAmigos != null) {
            this.divContenedorAmigos.addEventListener('click', this.manejarAbrirModal.bind(this));
        }

        if (btnCancelar != null) {
            btnCancelar.addEventListener('click', () => {
                if (this.modalConfirmar != null) {
                    this.modalConfirmar.classList.remove('active');
                }
            });
        }

        if (btnConfirmar != null) {
            this.botonEliminarActivo = null; // Resetear
            btnConfirmar.addEventListener('click', this.manejarConfirmarEliminar.bind(this));
        }
    }
    
    manejarAbrirModal(e) {
        const botonEliminar = e.target.closest('.eliminarAmigo');

        if (botonEliminar != null && this.modalConfirmar != null) {
            e.preventDefault();
            
            // Guardamos el botón que fue clicado para ocultarlo después
            this.botonEliminarActivo = botonEliminar; 

            // Guardamos el ID del amigo en el botón de confirmación del modal
            document.getElementById('confirmDeleteBtn').setAttribute('data-id-amigo', botonEliminar.getAttribute('value'));
            
            this.modalConfirmar.classList.add('active'); 
        }
    }
    
    manejarConfirmarEliminar() {
        const botonConfirmar = document.getElementById('confirmDeleteBtn');
        
        const idAmigo = botonConfirmar.getAttribute('data-id-amigo');
        
        if (this.modalConfirmar != null) {
            this.modalConfirmar.classList.remove('active');
        }
        
        if (idAmigo != null) {
            // OCULTAR EL BOTÓN QUE INICIÓ LA ACCIÓN
            if (this.botonEliminarActivo != null) {
                this.botonEliminarActivo.style.display = 'none';
                
                // Ocultar todo el contenedor del amigo si fuera necesario
                // this.botonEliminarActivo.closest('#contenedorAmigo').style.display = 'none';
            }
            
            this.controlador.rechazarEliminar(idAmigo);
        }
    }
}