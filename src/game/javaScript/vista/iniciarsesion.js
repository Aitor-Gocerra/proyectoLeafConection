// js/iniciosesion.js

// Importamos el Controlador JS.
import { CIniciarSesion } from '../controllers/cIniciarSesion.js';

/**
 * Clase LoginVista: Responsable de la interacción con el usuario (DOM).
 */
class LoginVista {
    
    constructor(controlador) {
        this.controlador = controlador;
        
        // 1. Engancharse a los elementos del DOM usando los IDs definidos en el HTML
        this.formulario = document.getElementById('form-login'); // Necesario para limpiar errores de campos
        this.inputEmail = document.getElementById('input-email');
        this.inputPass = document.getElementById('input-password');
        this.divErrorGlobal = document.getElementById('mensaje-error'); // Para mensajes de error globales (ej: campos vacíos)
        this.btnLogin = document.getElementById('btn-login'); 
        
        // 2. Configurar el listener principal
        this.setupListeners();
    }
    
    // ----------------------------------------------------
    // LÓGICA DE MANEJO DE ERRORES DETALLADOS (Tu código modificado)
    // ----------------------------------------------------

    /**
     * Muestra los mensajes de error debajo de los campos de entrada.
     * Es llamada por el Controlador cuando falla la validación (ej: email no es válido).
     * @param {Object} errores - Objeto con los errores devueltos por el Controlador (ej: {email: 'mensaje'})
     */
    mostrarErrores(errores) {
        // Limpiamos los errores de campos anteriores y el mensaje global
        this.limpiarErroresDeCampos(); 
        this.limpiarMensajeGlobal(); 

        // Recorrer el objeto de errores devuelto por el Controlador
        for (const campo in errores) {
            // Buscamos el input por ID: 'input-' + 'email' o 'input-' + 'password'
            const input = document.getElementById(`input-${campo}`); 
            
            if (input) {
                // 1. Crear el elemento <div> para el mensaje de error
                const errorDiv = document.createElement('div');
                errorDiv.className = `error-msg error-${campo}`; // Clase para identificar y estilizar
                errorDiv.style.color = 'red';
                errorDiv.style.fontSize = '0.9em';
                errorDiv.textContent = `* ${errores[campo]}`;

                // 2. Insertar el mensaje de error inmediatamente después del input
                input.parentNode.insertBefore(errorDiv, input.nextSibling);
            }
        }
    }

    /** Limpia los divs de error creados dinámicamente debajo de los inputs. */
    limpiarErroresDeCampos() {
        if (this.formulario) {
            const erroresExistentes = this.formulario.querySelectorAll('.error-msg');
            erroresExistentes.forEach(errorDiv => errorDiv.remove());
        }
    }

    /** Limpia el mensaje de error global y los errores de campo. */
    limpiarMensajes() {
        this.limpiarMensajeGlobal();
        this.limpiarErroresDeCampos(); 
    }
    
    /** Limpia sólo el mensaje de error global */
    limpiarMensajeGlobal() {
        if (this.divErrorGlobal) {
            this.divErrorGlobal.textContent = '';
            this.divErrorGlobal.style.display = 'none';
        }
    }
    
    /** Muestra un mensaje de error global (ej: "campos vacíos") */
    mostrarErrorGlobal(mensaje) {
         if (this.divErrorGlobal) {
            this.divErrorGlobal.textContent = mensaje;
            this.divErrorGlobal.style.display = 'block';
        }
    }

    // ----------------------------------------------------
    // LÓGICA DE EVENTOS (Delegación)
    // ----------------------------------------------------
    
    setupListeners() {
        if (this.btnLogin) {
            this.btnLogin.addEventListener('click', (event) => {
                
                event.preventDefault(); // Detenemos la navegación
                
                this.limpiarMensajes(); // Limpiamos todos los mensajes al empezar
                
                // 1. Recoger los datos del formulario
                const email = this.inputEmail ? this.inputEmail.value.trim() : '';
                const password = this.inputPass ? this.inputPass.value.trim() : ''; 

                
                // 2. Validación de Campos Vacíos (Frontend Simple)
                if (email === '' || password === '') {
                    this.mostrarErrorGlobal('⚠️ Por favor, complete todos los campos.');
                    return; // Detener la ejecución
                }
                
                // 3. DELEGACIÓN FINAL AL CONTROLADOR
                console.log("Vista: Validación OK. Enviando datos al Controlador para autenticación.");
                this.controlador.cIniciarSesion(email, password); 
            });
        } else {
            console.error("ERROR: Botón de inicio de sesión (#btn-login) no encontrado.");
        }
    }
}


// ----------------------------------------------------
// INICIALIZACIÓN DE LA APLICACIÓN (Fuera de la clase)
// ----------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {
    // 1. Instanciamos el Controlador (necesitará el Modelo)
    const controlador = new CIniciarSesion(/* modelo aquí */); 
    
    // 2. Instanciamos la Vista y le pasamos el Controlador
    const vista = new LoginVista(controlador);

    // 3. Aseguramos la comunicación bidireccional
    controlador.vista = vista;
});