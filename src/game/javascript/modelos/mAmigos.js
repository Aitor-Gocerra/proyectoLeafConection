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
    async rechazarSolicitud(formData) {
        const result = await this.peticiones('rechazarSolicitud', formData);

        if (!result) return;

        if (result === 'true') {
            this.mostrarMensaje('Solicitud rechazada.', 'green');
            setTimeout(() => location.reload(), 1000); 
        } else {
            this.mostrarMensaje('Error al rechazar solicitud.', 'red');
        }
    }

    // 4. ELIMINAR AMIGO
    async eliminarAmigo(formData) {
        const result = await this.peticiones('eliminarAmigo', formData);

        if (!result) return;

        if (result === 'true') {
            this.mostrarMensaje('Amigo eliminado.', 'green');
            setTimeout(() => location.reload(), 1000); 
        } else {
            this.mostrarMensaje('Error al eliminar amigo.', 'red');
        }
    }
}