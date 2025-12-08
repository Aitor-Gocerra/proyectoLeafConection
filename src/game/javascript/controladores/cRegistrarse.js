import {MRegistrarse} from '../modelos/mRegistrarse.js'; 

export class cRegistrarse {
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

        if(!this.validarContrasenia(password)){
            this.vista.mostrarError('La contraseña es débil. Debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número.');
            return;
        }
        
        ////////// SI LAS VALIDACIONES SON CORRECTAS CONVERTIMOS LOS DATOS A UN formData Y SE PASAN AL MODELO
        let formData = new FormData(); 
        formData.append('usuario', usuario); 
        formData.append('correo', email); 
        formData.append('contrasenia', password); 
        
        console.log("Datos de registro:", formData.get('usuario'), formData.get('correo'));
        
        this.modelo.mRegistrarse(formData);
    }
      
    ////////// METODOS DE VALIDACION SIMPLES PARA EL FORMATO DEL EMAIL, LO FUERTE QUE ES LA CONTRASEÑA Y SI EL NOMBRE DE USUSARIO CONTIENE CARACTERES PERMITIDOS //////////

    validarEmail(email) { //////////// EL MÉTODO .text() ES UN MÉTODO UTILIZADO PARA EL REGEX EL CUAL SI LA PALABRA NO PASA LA PRUEBA DEVUELVE FALSE SI NO TRUE 
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; //// GUARDAS EL REGEX EN UNA VARIAVLE Y LA COMPARAS CON EL TEXT EL EMAIL SI PASA LA PRUEBA DEVUELVE TRUE SI NO FALSE
        return emailRegex.test(email);
    }

    validarNombreUsuario(nombreUsuario) {
        let usuarioRegex = /^[a-zA-Z0-9_-]+$/; 
        return usuarioRegex.test(nombreUsuario);
    }

    validarContrasenia(password) {
        console.log("Validando");
        let passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return passwordRegex.test(password);
    }
}