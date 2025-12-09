
import { mAmigos } from '../modelos/mAmigos.js'; 

export class cAmigos {
    modelo;
    vista; // Referencia a los métodos de la vista (mostrarError, limpiarMensajes, navegarATab, etc.)

    constructor() {
        // Inicializa el Modelo JS (que se encargará de las peticiones AJAX al servidor)
        this.modelo = new mAmigos();
    }

    //GESTIÓN DE ENVÍO DE SOLICITUD (Botón 'encontrarAmigo')

    enviarSolicitud(idAmigo) {

        let formData = new FormData(); 
        formData.append('idAmigo', idAmigo); 

        this.modelo.enviarSolicitud(formData);
    }

    //GESTIÓN DE ELIMINACIÓN DE AMIGO DEL MODAL

    eliminarAmigo() {

    }

    // GESTIÓN DE SOLICITUDES (Botones Aceptar/Rechazar)
    
    aceptarSolicitud() {
        this.vista.limpiarMensajes();
    }

    rechazarSolicitud() {
        this.vista.limpiarMensajes();
        
    }
}