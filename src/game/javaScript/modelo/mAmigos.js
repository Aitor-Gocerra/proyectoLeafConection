export class mAmigos {

    async _sendAction(method, formData) {
        /* La URL apunta al index.php y le dice qué controlador y método usar.
        const url = `index.php?c=cAmigos&m=${method}`;*/

        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                // Captura errores
                throw new Error(`Error HTTP: ${response.status}`);
            }

            // El controlador PHP debe responder con JSON
            return await response.json();
            
        } catch (error) {
            console.error(`Error en la acción ${method}:`, error);
            return { success: false, mensaje: 'Error de conexión con el servidor.' };
        }
    }

    // Métodos de la lógica de negocio que construyen el FormData

    async enviarSolicitud(identificador) {
        let formData = new FormData();
        // 🔑 Clave: 'identificador' Valor: identificador del usuario
        formData.append('identificador', identificador); 
        
        return this._sendAction('enviarSolicitud', formData);
    }
    
    async eliminarAmigo(amigoID) {
        let formData = new FormData();
        // 🔑 Clave: 'amigo_id'  Valor: ID del amigo
        formData.append('amigo_id', amigoID); 
        return this._sendAction('eliminarAmigo', formData);
    }

    async aceptarSolicitud(solicitudID, emisorID) {
        let formData = new FormData();
        // 🔑 Claves: 'solicitud_id' y 'emisor_id'
        formData.append('solicitud_id', solicitudID);
        formData.append('emisor_id', emisorID);
        return this._sendAction('aceptarSolicitud', formData);
    }

    async eliminarSolicitud(solicitudID) {
        let formData = new FormData();
        // 🔑 Clave: 'solicitud_id' 
        formData.append('solicitud_id', solicitudID);
        return this._sendAction('rechazarSolicitud', formData);
    }
}