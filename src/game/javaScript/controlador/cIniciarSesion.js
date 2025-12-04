/* javascript/Controlador/cIniciarSesion.js */
// 🛑 ERROR: import { mIniciarSesion } from '../modelo/mIniciarsesion.js';
// ✅ CORRECCIÓN: Usar importación por defecto (sin llaves).
import mIniciarSesion from '../modelo/mIniciarsesion.js';

export class cIniciarSesion {
    modelo;
    vista; 

    constructor() {
        this.modelo = new mIniciarSesion();
    }

    cIniciarSesion(email, password) {

        // 1. Validar el formario con un REGEX básico
        if (!this.validarEmail(email)) {
            // Utilizamos el método que le asignamos antes
             this.vista.mostrarError('El formato del correo electrónico no es válido.');
            return;
        }

        let formData = new FormData(); 
        // 🔑 Envía 'correo' (Alineado con CUsuarios::comprobarDatosIni y MUsuarios::inicio)
        formData.append('correo', email); 
        // 🔑 Envía 'contrasenia' (Alineado con CUsuarios::comprobarDatosIni y MUsuarios::inicio)
        formData.append('contrasenia', password); 

        this.modelo.mIniciarSesion(formData);
    }

    validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}