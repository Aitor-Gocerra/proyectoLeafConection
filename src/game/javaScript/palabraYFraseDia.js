    // La palabra secreta que el usuario debe adivinar
        const PALABRA_SECRETA = "HTML"; 
        
        // Tiempo que el mensaje estará visible (en milisegundos)
        const DURACION_MENSAJE = 3000; 

        // Referencias del DOM
        const entradaPalabra = document.getElementById('entradaPalabra');
        const botonValidar = document.getElementById('botonValidar');
        const contenedorNotificacion = document.getElementById('contenedorNotificacion');

        /**
         * Muestra un mensaje temporal en la esquina inferior derecha.
         * @param {string} texto - El contenido del mensaje.
         * @param {string} tipo - 'correcto' o 'incorrecto' para aplicar el CSS.
         */
        function mostrarNotificacion(texto, tipo) {
            // 1. Crear el nuevo elemento (div)
            const mensajeDiv = document.createElement('div');
            mensajeDiv.textContent = texto;
            mensajeDiv.classList.add('mensaje', tipo);

            // 2. Añadirlo al contenedor de notificaciones
            contenedorNotificacion.appendChild(mensajeDiv);
            
            // 3. Forzar un pequeño retraso para que la transición funcione
            setTimeout(() => {
                mensajeDiv.style.opacity = 1; 
            }, 10);

            // 4. Temporizador para ocultar y eliminar el mensaje
            setTimeout(() => {
                // Iniciar la transición de opacidad a 0 (desaparecer)
                mensajeDiv.style.opacity = 0;
                
                // Después de que la transición termine (0.4s según CSS), eliminar el elemento del DOM
                setTimeout(() => {
                    contenedorNotificacion.removeChild(mensajeDiv);
                }, 400); 
                
            }, DURACION_MENSAJE);
        }

        /**
         * Maneja la lógica de validación al hacer clic en el botón.
         */
        function validarPalabra() {
            const palabraUsuario = entradaPalabra.value.trim().toUpperCase(); // Limpiamos y convertimos a mayúsculas
            
            if (palabraUsuario === PALABRA_SECRETA) {
                mostrarNotificacion("¡Has acertado!", "correcto");
            } else if (palabraUsuario === "") {
                 mostrarNotificacion("Introduce una palabra, por favor.", "incorrecto");
            } else {
                mostrarNotificacion(`Has fallado. La palabra introducida fue: ${palabraUsuario}`, "incorrecto");
            }

            // Opcional: Limpiar el campo de entrada después de validar
            entradaPalabra.value = '';
        }

        // Asignar el evento al botón y también a la tecla Enter
        botonValidar.addEventListener('click', validarPalabra);
        entradaPalabra.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                validarPalabra();
            }
        });

    



