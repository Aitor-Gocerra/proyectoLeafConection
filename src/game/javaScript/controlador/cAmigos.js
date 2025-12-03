/* javascript/controlador/cAmigos.js 
import { mAmigos } from '../modelo/mAmigos.js'; */

export class cAmigos {
    modelo;
    vista; // Referencia a los métodos de la vista (mostrarError, limpiarMensajes, navegarATab, etc.)

    constructor() {
        // Inicializa el Modelo JS (que se encargará de las peticiones AJAX al servidor)
        /*this.modelo = new mAmigos();*/
    }

    // 1. GESTIÓN DE ENVÍO DE SOLICITUD (Botón 'encontrarAmigo')

    async enviarSolicitud(identificador) {
        this.vista.limpiarMensajes();


        // 2. Llamada al Modelo para enviar la petición al servidor (PHP)
        const resultado = await this.modelo.enviarSolicitud(identificador);
        
        if (resultado.success) {
            document.getElementById('introducirAmigo').value = ''; 
            this.vista.mostrarExito('Solicitud enviada a ' + identificador + '.');
        } else {
            this.vista.mostrarError(resultado.mensaje || 'Error desconocido al enviar solicitud.');
        }
    }

    // 2. GESTIÓN DE ELIMINACIÓN DE AMIGO (Modal de Confirmación)

    async eliminarAmigo(amigoID) {
        this.vista.limpiarMensajes();

        const resultado = await this.modelo.eliminarAmigo(amigoID);

        if (resultado.success) {
            // Se usa navegarATab() para asegurar que la página recarga el contenido.
            this.vista.navegarATab('amigos'); 
        } else {
            this.vista.mostrarError(resultado.mensaje || 'Error al eliminar al amigo.');
        }
    }

    // 3. GESTIÓN DE SOLICITUDES (Botones Aceptar/Rechazar)
    
    async aceptarSolicitud(solicitudID, emisorID) {
        this.vista.limpiarMensajes();
        const resultado = await this.modelo.aceptarSolicitud(solicitudID, emisorID);
        .
        if (resultado.success) {
            this.vista.navegarATab('amigos'); 
        } else {
            this.vista.mostrarError(resultado.mensaje || 'Error al aceptar la solicitud.');
        }
    }

    async rechazarSolicitud(solicitudID) {
        this.vista.limpiarMensajes();
        const resultado = await this.modelo.eliminarSolicitud(solicitudID); 

        if (resultado.success) {
            this.vista.navegarATab('solicitudes');
        } else {
            this.vista.mostrarError(resultado.mensaje || 'Error al rechazar la solicitud.');
        }
    }
}