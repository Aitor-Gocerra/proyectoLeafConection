import mIniciarSesion from '../modelo/mIniciarsesion.js';

export class cIniciarSesion {
    modelo;
    vista; 

    constructor() {
        this.modelo = new mIniciarSesion();
    }

    cIniciarSesion(email, password) {

        // Validar el formario con un REGEX básico
        if (!this.validarEmail(email)) {
             this.vista.mostrarError('El formato del correo electrónico no es válido.');
            return;
        }

        //TODO EXPLICADO EN REGISTRO TAMBIÉN 
        let formData = new FormData(); 
        formData.append('correo', email); 
        formData.append('contrasenia', password); 
        this.modelo.mIniciarSesion(formData);
    }

    validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}