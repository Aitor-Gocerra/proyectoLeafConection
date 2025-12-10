
class CAmigos {

    constructor(modelo, vista) {

        this.modelo = modelo;
        this.vista = vista;
    }

    //GESTIÓN DE ENVÍO DE SOLICITUD (Botón 'encontrarAmigo')

    enviarSolicitud(idAmigo) {

        let datosForm = new FormData(); 
        datosForm.append('idAmigo', idAmigo); 
        console.log("Entra");

        this.modelo.enviarSolicitud(datosForm);
    }

    //GESTIÓN DE ELIMINACIÓN DE AMIGO DEL MODAL

    rechazarEliminar(idAmigo) {

        let datosForm = new FormData(); 
        datosForm.append('idAmigo', idAmigo); 
        this.modelo.rechazarEliminar(datosForm);
    }

    aceptarSolicitud(idAmigo){

        let datosForm = new FormData(); 
        datosForm.append('idAmigo', idAmigo); 
        this.modelo.aceptarSolicitud(datosForm);
    }
}