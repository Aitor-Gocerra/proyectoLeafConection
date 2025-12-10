class VAmigos {

    constructor(controlador) {
        this.controlador = controlador;
        
        // Propiedades que se reciben del dom
        this.errorDiv = document.getElementById('mensaje-error-amigos');
        this.btnAmigos = document.getElementById("todosAmigos");
        this.btnSolicitudes = document.getElementById("solicitudesAmigos");
        this.misAmigos = document.getElementById("misAmigos");
        this.misSolicitudes = document.getElementById("misSolicitudes");
        this.modal = document.getElementById('confirmModal');
        this.contenedorMisAmigos = document.getElementById('misAmigos');
        
        this.vincularEventos(); 
    }

    // --- MÉTODOS DE UTILIDAD (Los que el controlador usará) ---

    mostrarExito(mensaje) {
        if (this.errorDiv) {
            this.errorDiv.textContent = mensaje;
            this.errorDiv.style.color = 'green';
            this.errorDiv.style.display = 'block';
            this.errorDiv.style.fontSize = '0.8rem';
            this.errorDiv.style.marginLeft = '1rem';
        }
    }

    mostrarError(mensaje) {
        if (this.errorDiv) {
            this.errorDiv.textContent = mensaje;
            this.errorDiv.style.color = 'red';
            this.errorDiv.style.display = 'block';
            this.errorDiv.style.fontSize = '0.8rem';
            this.errorDiv.style.marginLeft = '1rem';
        }
    }

    limpiarMensajes() {
        if (this.errorDiv) {
            this.errorDiv.textContent = '';
            this.errorDiv.style.display = 'none';
        }
    }

    navegarATab() {
        let newUrl = window.location.pathname + '?c=Usuarios&m=amigos';
        window.location.href = newUrl;
    }

    // --- LÓGICA DE EVENTOS INTERNA ---

    vincularEventos() {
        if (this.btnAmigos) this.btnAmigos.addEventListener("click", this.cambiarATabAmigos.bind(this));
        if (this.btnSolicitudes) this.btnSolicitudes.addEventListener("click", this.cambiarATabSolicitudes.bind(this));

        const btnEncontrarAmigo = document.getElementById('encontrarAmigo');
        if (btnEncontrarAmigo) btnEncontrarAmigo.addEventListener('click', this.enviarSolicitudHandler.bind(this));

        this.vincularAceptarRechazar();
        this.vincularModalEliminar();
    }
    
    cambiarATabAmigos() {
        this.misAmigos.style.display = "block";
        this.misSolicitudes.style.display = "none";
        this.btnAmigos.classList.add("botonActivo");
        this.btnAmigos.classList.remove("botonNoActivo");
        this.btnSolicitudes.classList.add("botonNoActivo");
        this.btnSolicitudes.classList.remove("botonActivo");
        this.navegarATab();
    }

    cambiarATabSolicitudes() {
        this.misAmigos.style.display = "none";
        this.misSolicitudes.style.display = "block";
        this.btnSolicitudes.classList.add("botonActivo");
        this.btnSolicitudes.classList.remove("botonNoActivo");
        this.btnAmigos.classList.add("botonNoActivo");
        this.btnAmigos.classList.remove("botonActivo");
    }
    
    enviarSolicitudHandler(event) { 
        event.preventDefault();
        this.limpiarMensajes();

        let idAmigo = document.getElementById('introducirAmigo').value.trim();
        
        if (idAmigo === '') {
            this.mostrarError('El usuario no está completo.');
            return;
        }

        this.controlador.enviarSolicitud(idAmigo); 
    }

    vincularAceptarRechazar() {
        const botonAceptar = document.querySelectorAll('.aceptarSolicitud');
        const botnRechazar = document.querySelectorAll('.rechazarSolicitud');

        botonAceptar.forEach(boton => {
            boton.addEventListener('click', this.manejarAceptar.bind(this));
        });

        botnRechazar.forEach(boton => {
            boton.addEventListener('click', this.manejarRechazar.bind(this));
        });
    }

    manejarAceptar(event) {
        event.preventDefault();
        this.limpiarMensajes();

        const boton = event.currentTarget;
        const idUsuario = boton.getAttribute('value');

        boton.style.display = 'none';
        boton.parentElement.querySelector('.rechazarSolicitud').style.display = 'none';

        this.controlador.aceptarSolicitud(idUsuario);
    }

    manejarRechazar(event) {
        event.preventDefault();
        this.limpiarMensajes();

        const boton = event.currentTarget;
        const idUsuario = boton.getAttribute('value');

        boton.style.display = 'none';
        boton.parentElement.querySelector('.aceptarSolicitud').style.display = 'none';

        this.controlador.rechazarEliminar(idUsuario);
    }

    // --- LÓGICA DEL MODAL ---

    vincularModalEliminar() {
        const btnCancelar = document.getElementById('cancelBtn');
        const btnConfirmar = document.getElementById('confirmDeleteBtn');

        if (this.contenedorMisAmigos) {
            this.contenedorMisAmigos.addEventListener('click', this.manejarAbrirModal.bind(this));
        }

        if (btnCancelar) {
            btnCancelar.addEventListener('click', () => this.modal.classList.remove('active'));
        }

        if (btnConfirmar) {
            btnConfirmar.addEventListener('click', this.manejarConfirmarEliminar.bind(this));
        }
    }
    
    manejarAbrirModal(e) {
        const botonEliminar = e.target.closest('.eliminarAmigo');

        if (botonEliminar && this.modal) {
            e.preventDefault();
            document.getElementById('confirmDeleteBtn').dataset.idAmigo = botonEliminar.getAttribute('value');
            this.modal.classList.add('active'); 
        }
    }
    
    manejarConfirmarEliminar() {
        const idAmigo = document.getElementById('confirmDeleteBtn').dataset.idAmigo;
        
        if (this.modal) this.modal.classList.remove('active');
        
        if (idAmigo) {
            this.controlador.rechazarEliminar(idAmigo);
        }
    }
}