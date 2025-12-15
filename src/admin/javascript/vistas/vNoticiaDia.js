class VNoticia {
    constructor(controlador) {
        this.controlador = controlador;
        this.form = document.getElementById('noticia_formulario');
        this.btnEnviar = document.getElementById('btnEnviar');
        this.contenedorPreguntas = document.getElementById('cuestionarioContainer');
        this.plantillaPregunta = document.querySelector('.cuestionarioPregunta');

        this.inicializarEventos();
        this.inicializarBotonesModificar();
        this.inicializarBotonesEliminar();
        this.inicializarValidacionFechas();
    }

    inicializarEventos() {
        if (this.form) {
            this.form.addEventListener('submit', e => this.validarFormulario(e));
        }

        const btnAñadir = document.getElementById('btnAnadirPregunta');
        if (btnAñadir) {
            btnAñadir.addEventListener('click', e => this.añadirPregunta(e));
        }

        const formBuscar = document.getElementById('formBuscarNoticia');
        if (formBuscar) {
            formBuscar.addEventListener('submit', e => this.buscarNoticias(e));
        }
    }

    buscarNoticias(e) {
        e.preventDefault();
        const buscar = document.getElementById('inputBuscarNoticia').value.trim();
        if (buscar !== '') {
            window.location.href = 'index.php?c=GestionarNoticias&m=buscarNoticias&buscar=' + encodeURIComponent(buscar);
        }
    }

    mostrarError(campo, mensaje) {
        const span = document.createElement('span');
        span.className = 'error-msg';
        span.textContent = mensaje;
        campo.parentNode.insertBefore(span, campo.nextSibling);
    }

    añadirPregunta(e) {
        e.preventDefault();
        const nueva = document.createElement('div');
        nueva.classList.add('cuestionarioPregunta');
        nueva.innerHTML = this.plantillaPregunta.innerHTML;
        nueva.querySelectorAll('input').forEach(i => i.value = '');
        this.contenedorPreguntas.appendChild(nueva);
    }

    async cargarDatosNoticia(noticia, preguntas, opcionesImplode, respuestas) {
        document.getElementById('titulo').value = noticia.titulo;
        document.getElementById('noticia').value = noticia.noticia;
        document.getElementById('url').value = noticia.urlImagen;
        document.getElementById('fecha').value = noticia.fechaProgramada?.substring(0, 10) ?? '';

        // Cambiar action para guardar la modificación
        this.form.action = `index.php?c=GestionarNoticias&m=guardarModificacion&idNoticia=${noticia.idNoticia}`;

        this.contenedorPreguntas.innerHTML = '';
        for (let i = 0; i < preguntas.length; i++) {
            let div = document.createElement('div');
            div.classList.add('cuestionarioPregunta');
            div.innerHTML = this.plantillaPregunta.innerHTML;

            let inputs = div.querySelectorAll('input');
            inputs[0].value = preguntas[i].pregunta || '';
            inputs[1].value = opcionesImplode[i] ?? '';
            inputs[2].value = respuestas[i] ?? '';

            this.contenedorPreguntas.appendChild(div);
        }

        await this.inicializarValidacionFechas(noticia.idNoticia);
    }

    inicializarBotonesModificar() {
        document.querySelectorAll('.btnModificar').forEach(btn => {
            btn.addEventListener('click', e => {
                let idNoticia = e.currentTarget.dataset.id;
                this.controlador.cargarNoticia(idNoticia);
            });
        });
    }

    inicializarBotonesEliminar() {
        document.querySelectorAll('.btnEliminar').forEach(btn => {
            btn.addEventListener('click', async e => {
                let idNoticia = e.currentTarget.dataset.id;
                if (confirm('¿Está seguro de eliminar esta noticia?')) {
                    let resp = await this.controlador.eliminarNoticia(idNoticia);
                    if (resp.success) {
                        this.eliminarFila(idNoticia);
                    } else {
                        alert('Error al eliminar la noticia');
                    }
                }
            });
        });
    }

    eliminarFila(idNoticia) {
        let btnEliminar = document.querySelector(`.btnEliminar[data-id="${idNoticia}"]`);
        if (btnEliminar) {
            let tr = btnEliminar.closest('tr');
            if (tr) tr.remove();
        }
    }

    /**
     * Función que valida cada vez que el usuario seleccione una fecha, si se pasa como
     * parámetro el idNoticia, significa que se está modificando una noticia sino significa
     * que se está añadiendo una noticia. Esto evita tener dos noticias para una fecha.
     * @param idNoticia 
     * @returns void
     */
    async inicializarValidacionFechas(idNoticia = null) {
        let inputFecha = document.getElementById('fecha');
        if (!inputFecha) return;

        let fechasOcupadas = [];

        try {
            if (idNoticia) {
                fechasOcupadas = await this.controlador.obtenerFechasOcupadasModificar(idNoticia);
            } else {
                fechasOcupadas = await this.controlador.obtenerFechasOcupadas();
            }
        } catch (e) {
            console.error('Error al obtener fechas ocupadas:', e);
        }

        inputFecha.addEventListener('change', e => {
            let seleccion = e.target.value;
            if (fechasOcupadas.includes(seleccion)) {
                alert('¡La fecha seleccionada ya está ocupada!');
                e.target.value = '';
            }
        });
    }

    /**
     * Al enviar el formulario, se valida cada campo. 
     * Validaciones: 
     *  - Campos tipo texto completos
     *  - URL válida (con clase URL)
     *  - Validación de fecha >= hoy
     *  - Validar pregunta
     *  - Validar número de opciones
     * @param e
     */

    validarFormulario(e) {
        e.preventDefault();
        let errores = 0;

        // Eliminar mensajes previos
        this.form.querySelectorAll('.error-msg').forEach(msg => msg.remove());

        // Validación campos text
        let titulo = document.getElementById('titulo');
        let noticia = document.getElementById('noticia');
        let url = document.getElementById('url');
        let fecha = document.getElementById('fecha');



        if (!titulo.value.trim()) { this.mostrarError(titulo, 'Rellena este campo'); errores++; }
        if (!noticia.value.trim()) { this.mostrarError(noticia, 'Rellena este campo'); errores++; }

        // Validación URL
        if (!url.value.trim()) { 
            this.mostrarError(url, 'Rellena este campo'); 
            errores++; 
        } else {
            try { new URL(url.value.trim()); } 
            catch { this.mostrarError(url, 'URL no es válida'); errores++; }
        }

        // Validación Fecha
        if (!fecha.value) { this.mostrarError(fecha, 'Rellena este campo'); errores++; } 
        else {
            let hoy = new Date().toISOString().split('T')[0];
            if (fecha.value < hoy) { 
                this.mostrarError(fecha, 'La fecha no puede ser anterior a hoy'); 
                errores++; 
            }
        }

        // Validar preguntas
        this.contenedorPreguntas.querySelectorAll('.cuestionarioPregunta').forEach(div => {
            let pregunta = div.querySelector('input[name="preguntas[]"]');
            let opciones = div.querySelector('input.opciones');
            let respuesta = div.querySelector('input[name="respuestas_correctas[]"]');

            if (!pregunta.value.trim()) { this.mostrarError(pregunta, 'Rellena este campo'); errores++; }
            if (!opciones.value.trim() || !opciones.value.includes('/')) {
                this.mostrarError(opciones, 'Las opciones deben separarse con "/"');
                errores++;
            }

            let numOpciones = opciones.value.split('/').length;
            let numRespuesta = parseInt(respuesta.value, 10);
            if (isNaN(numRespuesta) || numRespuesta < 1 || numRespuesta > numOpciones) {
                this.mostrarError(respuesta, `Debe ser un número entre 1 y ${numOpciones}`);
                errores++;
            }
        });

        if (errores == 0) {
            this.btnEnviar.disabled = true;
            this.btnEnviar.style.backgroundColor = '#929292ff';
            this.form.submit();
        }
    }
}