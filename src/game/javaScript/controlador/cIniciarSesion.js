// ../controllers/cIniciarSesion.js

// 1. Importar el Modelo (que se encargará de la comunicación con la API/PHP)
import { Modelo } from '../modelo/mIniciarsesion.js'; 

/**
 * Clase Modelo (MIniciarsesion): Responsable de la comunicación con el Backend (index.php).
 */
export class Modelo {
    
    constructor() {
        // La URL de tu router PHP, que manejará todas las peticiones AJAX/Fetch.
        this.API_URL = 'index.php'; 
    }

    /**
     * Realiza la petición POST para autenticar al usuario.
     * @param {string} email - Correo electrónico.
     * @param {string} password - Contraseña.
     * @returns {Promise<Object>} Objeto de respuesta del servidor.
     */
    async autenticar(email, password) {
        console.log('Modelo: Solicitando autenticación al servidor (index.php)...');
        
        // 1. Preparar los datos para el envío
        const datosEnvio = { 
            // Esto es crucial para que tu Router PHP sepa qué hacer:
            c: 'Autenticacion', // c=Controlador que manejará el Login en PHP
            m: 'iniciarSesion', // m=Método dentro de ese Controlador PHP
            email: email, 
            password: password 
        };

        try {
            // 2. Ejecutar la petición Fetch (POST)
            const respuesta = await fetch(this.API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json' // Indicamos que el cuerpo es JSON
                },
                body: JSON.stringify(datosEnvio) // Convertir el objeto a cadena JSON
            });
            
            // 3. Manejo de Errores HTTP
            if (!respuesta.ok) {
                // Si hay un error HTTP (ej: 404, 500), lanzamos una excepción
                throw new Error(`Error HTTP: ${respuesta.status} en la conexión con index.php`);
            }

            // 4. Devolver la respuesta JSON del servidor
            const datosRespuesta = await respuesta.json();
            
            console.log('Modelo: Respuesta recibida del servidor:', datosRespuesta);
            return datosRespuesta; // Esto es lo que el Controlador espera (ej: {status: 'OK'} o {status: 'ERROR_AUTH'})

        } catch (error) {
            console.error('Modelo: Fallo en la comunicación de red o del servidor.', error);
            // Propagamos el error para que el Controlador lo capture y lo muestre
            throw error; 
        }
    }
}