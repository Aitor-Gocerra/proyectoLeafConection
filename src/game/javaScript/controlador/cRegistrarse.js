//javascript/Controlador/cRegistrarse.js
/*import { mRegistrarse } from '../models/mRegistrarse.js';*/

export class cRegistrarse {
    modelo;
    vista; 

    constructor() {
        /*this.modelo = new mRegistrarse();*/
    }

    cRegistrarse(usuario,email, password) {

        // 1. Validar el formario con un REGEX básico`'
        if (!this.validarEmail(email)) {
            // Utilizamos el método que le asignamos antes
            this.vista.mostrarError('El formato del correo electrónico no es válido.');
            return;
         }

         if(!this.validarNombreUsuario(usuario)){
            this.vista.mostrarError('El nick del usuario contiene carácteres especiales no válidos.');
            return;
         }
        
        /*let formData = new FormData(); 
        formData.append('correo', email); 
        formData.append('contrasenia', password); '
        this.modelo.mRegistrarse(formData);*/
    }
     
    validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    validarNombreUsuario(nombreUsuario) {
        const usuarioRegex = /^[a-zA-Z0-9_-]+$/;
        return usuarioRegex.test(nombreUsuario);
    }
}