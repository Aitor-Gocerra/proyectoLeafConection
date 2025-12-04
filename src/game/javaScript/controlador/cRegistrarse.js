
import MRegistrarse from '../modelo/mRegistrarse.js'; 

export default class cRegistrarse {
    modelo;
    vista;

    constructor() {
        this.modelo = new MRegistrarse();
    }

    iniciarRegistro(usuario, email, password) {

        if (!this.validarEmail(email)) {
            this.vista.mostrarError('El formato del correo electrónico no es válido.');
            return;
        }

        if(!this.validarNombreUsuario(usuario)){
            this.vista.mostrarError('El nick del usuario contiene carácteres especiales no válidos.');
            return;
        }
        
        let formData = new FormData(); 
        formData.append('usuario', usuario); // Usar 'usuario' o 'nombre' según tu BD
        formData.append('correo', email); 
        formData.append('contrasenia', password); 
        
        console.log("Datos de registro:", formData.get('usuario'), formData.get('correo'));
        this.modelo.mRegistrarse(formData);
    }
      
    ////////// METODOS DE VALIDACION PARA EMAIL Y NOMBREUSUARIO
    validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    validarNombreUsuario(nombreUsuario) {
        // Permite letras, números, guiones bajos y guiones medios
        const usuarioRegex = /^[a-zA-Z0-9_-]+$/; 
        return usuarioRegex.test(nombreUsuario);
    }
}