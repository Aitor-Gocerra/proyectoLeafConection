/*javascript/Controlador/cIniciarSesion.js
import { mIniciarsesion } from '../modelo/mIniciarsesion.js';*/

export class cIniciarSesion {
    modelo;
    vista; 

    constructor() {
        /*this.modelo = new mIniciarsesion();*/
    }

    cIniciarSesion(email, password) {

        // 1. Validar el formario con un REGEX básico
        if (!this.validarEmail(email)) {
            // Utilizamos el método que le asignamos antes
            this.vista.mostrarError('El formato del correo electrónico no es válido.');
            return;
         }
        
        /*let formData = new FormData(); 
        formData.append('correo', email); 
        formData.append('contrasenia', password); 

        this.modelo.mIniciarSesion(formData);*/
    }
     
    validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}