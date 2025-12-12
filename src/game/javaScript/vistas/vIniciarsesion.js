// La clase no necesita el import, ya que el Controlador se le pasará desde app.js
class VIniciarsesion {

    constructor(controlador){
        this.controlador = controlador;
        this.errorDiv = document.getElementById('mensaje-error');
        this.iconoPw = document.getElementById('iconoPw');
        this.inputPassword = document.getElementById('input-password');
        this.vincularEventos(); // Llamamos a los eventos desde el constructor
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