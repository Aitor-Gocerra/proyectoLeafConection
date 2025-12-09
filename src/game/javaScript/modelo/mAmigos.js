export class mAmigos {
    
    constructor() {
    }

    async peticiones(metodoPHP, formData) {
        try {
            const response = await fetch('index.php?c=Usuarios&m=' + metodoPHP, {
                method: 'POST',
                body: formData,
            });

            if (response.ok) {
                return await response.text(); 
            } else {
                this.mostrarMensaje('Fallo del servidor (HTTP).', 'red');
                return null;
            }
        } catch (error) {
            console.error('Error:', error);
            this.mostrarMensaje('Error de conexión. Revisa internet.', 'red');
            return null;
        }
    }

    // --- FUNCIÓN AUXILIAR PARA MENSAJES ---
    mostrarMensaje(texto, color) {
        const div = document.getElementById('mensaje-error-amigos');
        
        if (div) {
            div.textContent = texto;
            div.style.color = color;
            div.style.display = 'block';
        }
    }

    // 1. ENVIAR SOLICITUD
    async enviarSolicitud(formData) {
        const result = await this.peticiones('enviarSolicitud', formData); 

        if (!result) return;

        if (result === 'true') {
            if (this.inputAmigo) this.inputAmigo.value = '';
            this.mostrarMensaje('Solicitud enviada correctamente.', 'green');
            
        } else {
            // AÑADE ESTA LÍNEA PARA VER EL ERROR REAL EN LA CONSOLA DEL NAVEGADOR (F12)
            console.log("El servidor devolvió:", result); 

            if (result === 'UsuarioNoExiste') this.mostrarMensaje('El usuario no existe.', 'red');
            else if (result === 'AutoSolicitud') this.mostrarMensaje('No puedes enviarte solicitud a ti mismo.', 'red');
            else if (result === 'SolicitudExistente') this.mostrarMensaje('Ya existe una solicitud pendiente.', 'red');
            
            // Aquí es donde estás cayendo ahora:
            else this.mostrarMensaje('Error al enviar solicitud. (Revisa consola)', 'red');
        }
    }

    // 2. ACEPTAR SOLICITUD
    async aceptarSolicitud(formData) {
        const result = await this.peticiones('aceptarSolicitud', formData);

        if (!result) return;

        if (result === 'true') {
            this.mostrarMensaje('Solicitud aceptada. Actualizando...', 'green');
            setTimeout(() => location.reload(), 1000); 
        } else {
            this.mostrarMensaje('Error al aceptar solicitud.', 'red');
        }
    }

    // 3. RECHAZAR SOLICITUD (Faltaba esta)
async rechazarEliminar(formData) {
        // [DEPURACIÓN 1] Ver qué estamos enviando
        console.log("📤 Enviando petición de rechazo..."); 
        for (let pair of formData.entries()) {
            console.log(pair[0]+ ': ' + pair[1]); 
        }

        const result = await this.peticiones('rechazarEliminar', formData);

        // [DEPURACIÓN 2] Ver qué devuelve el servidor EXACTAMENTE
        console.log("📥 Respuesta CRUDA del servidor:", result);

        if (!result) {
            console.error("❌ El servidor devolvió NULL o vacío.");
            return;
        }

        // [CORRECCIÓN] Limpiamos espacios en blanco (trim) por si PHP añade saltos de línea
        const respuestaLimpia = result.trim();

        if (respuestaLimpia === 'true') {
            this.mostrarMensaje('Solicitud rechazada.', 'green');
            setTimeout(() => location.reload(), 1000); 
        } else {
            // [DEPURACIÓN 3] Aquí veremos el error real
            console.error("❌ NO ES 'true'. El servidor dijo:", result);
            
            // Mostramos el error en pantalla para que lo veas rápido
            this.mostrarMensaje('Error del servidor: ' + respuestaLimpia, 'red');
        }
    }
}