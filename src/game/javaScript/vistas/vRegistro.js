class VRegistro {

    constructor(controlador){
        this.controlador = controlador;
        this.errorDiv = document.getElementById('mensaje-error'); 
        this.iconoPw = document.getElementById('iconoPw');
        this.inputPassword = document.getElementById('input-contrasenia');
        this.vincularEventos();
        this.verContraseña();
    }

    mostrarError(mensaje) {
        if (this.errorDiv) {
            this.errorDiv.textContent = mensaje;
            this.errorDiv.style.color = 'red' ;
            this.errorDiv.style.display = 'block';
        }
    }

    limpiarMensajes() {
        if (this.errorDiv) {
            this.errorDiv.textContent = '';
            this.errorDiv.style.display = 'none';
        }
    }

    // Método para vincular los eventos al DOM
    vincularEventos() {
        const btnRegistro = document.getElementById('btn-crearcuenta'); 

        if (btnRegistro) {
            btnRegistro.addEventListener('click', this.manejarRegistro.bind(this));
        }
    }

    // Lógica principal al hacer clic en el botón de registro.
    manejarRegistro(event) {
        event.preventDefault();

        this.limpiarMensajes();

        // 1. Recoger los cuatro datos del formulario
        let email = document.getElementById('input-correo').value.trim();
        let usuario = document.getElementById('input-usuario').value.trim();
        let password = document.getElementById('input-contrasenia').value.trim();
        let password2 = document.getElementById('input-contrasenia2').value.trim();
        
        // 2. Validación de campos vacíos
        if (email === '' || usuario === '' || password === '' || password2 === '') {
            this.mostrarError('Todos los campos son obligatorios: usuario, correo y contraseñas.');
            return;
        }

        // 3. Validación de coincidencia de contraseñas
        if (password2 !== password) {
            this.mostrarError('Las contraseñas no coinciden.');
            return;
        }
        this.controlador.iniciarRegistro(usuario, email, password); 
    }

    verContraseña(){
        // Verificamos que el icono y el input existan
        if (!this.iconoPw || !this.inputPassword) {
            console.error("No se encontró el icono o el campo de contraseña.");
            return;
        }
        
        this.iconoPw.addEventListener("click", () => {
            // Usamos 'this.inputPassword' y 'this.iconoPw' que están definidos en el constructor
            if (this.inputPassword.type === "password") {
                this.inputPassword.type = "text";
                this.iconoPw.textContent = "🔓"; // Cambia a candado abierto
            } else {
                this.inputPassword.type = "password";
                this.iconoPw.textContent = "🔒"; // Vuelve a candado cerrado
            }
        });
    }
}