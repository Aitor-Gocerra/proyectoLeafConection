class CIniciarsesion {

    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    iniciarSesion(email, password) {

        // Validar el formario con un REGEX básico
        if (!this.validarEmail(email)) {
            this.vista.mostrarError('El formato del correo electrónico no es válido.');
            return;
        }

        //TODO EXPLICADO EN REGISTRO TAMBIÉN 
        let datosFormulario = new FormData(); 
        datosFormulario.append('correo', email); 
        datosFormulario.append('contrasenia', password); 
        this.modelo.MIniciarsesion(datosFormulario);
    }

    validarEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
}