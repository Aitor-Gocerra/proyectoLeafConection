// La clase no necesita el import, ya que el Controlador se le pasará desde app.js
class VIniciarsesion {

    constructor(controlador){
        this.controlador = controlador;
        this.errorDiv = document.getElementById('mensaje-error'); 
        this.vincularEventos(); // Llamamos a los eventos desde el constructor
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
        const btnLogin = document.getElementById('btn-login');

        if (btnLogin) {
            // Usamos bind(this) para que this dentro de manejarLogin apunte a la instancia de la Vista
            btnLogin.addEventListener('click', this.manejarLogin.bind(this));
        }
    }

    // Lógica principal al hacer clic en el botón de login.
    manejarLogin(event) {
        event.preventDefault();

        this.limpiarMensajes();


        let email = document.getElementById('input-email').value.trim();  
        let password = document.getElementById('input-password').value.trim();  
        
        if (email === '' || password === '') {
            this.mostrarError('El correo electrónico y la contraseña son obligatorios.');
            return;
        }
        
        // Llamamos al método del controlador (asumiendo que se llama iniciarSesion)
        this.controlador.iniciarSesion(email, password); 
    }
}