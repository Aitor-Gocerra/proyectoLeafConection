
export default class MRegistrarse {
    constructor() {}
    async mRegistrarse(formData){
        try{
            const response = await fetch('index.php?c=Usuarios&m=registrar', {
                method: 'POST',
                body: formData, 
            });
            
            // 1. Verificar el estado HTTP
            if(response.ok){
                const result = await response.text();

                if(result === 'true'){
                    // ÉXITO: Redirigir al login
                    window.location.href = "index.php?c=Usuarios&m=login";
                }else{
                    // FALLO: Mostrar error específico basado en la respuesta de PHP
                    const errorDiv = document.getElementById('mensaje-error'); 
                    
                    if(errorDiv) {
                        
                        // Manejo de errores específicos del backend (CUsuarios o MUsuarios)
                        if(result === 'UsuarioExiste'){ 
                            errorDiv.textContent = 'El nombre de usuario o correo ya está registrado.';
                            
                        } else if(result === '1062'){ // Error de duplicidad de BD (MySQL)
                            errorDiv.textContent = 'Error de base de datos: el dato ya existe.';
                            
                        } else if (result === 'ContrasenasDiferentes') {
                            errorDiv.textContent = 'Las contraseñas no coinciden.';
                        
                        } else if (result === 'DatosIncompletos') {
                            errorDiv.textContent = 'Por favor, rellene todos los campos.';

                        } else {
                            // Errores genéricos o internos (ej. ErrorInternoBD)
                            errorDiv.textContent = `Error al registrar: ${result}.`;
                        }
                    
                        errorDiv.style.display = 'block';
                        errorDiv.style.color = 'red';
                    }
                }
            }else{
                // Manejo de error HTTP (ej. 404, 500)
                const errorDiv = document.getElementById('mensaje-error'); 
                if (errorDiv) {
                    errorDiv.textContent = `ERROR HTTP ${response.status}: Fallo al comunicarse con el servidor.`;
                    errorDiv.style.display = 'block';
                    errorDiv.style.color = 'red';
                }
            }
        }catch(error){
            // Manejo de error de red (conexión)
            console.error('Error de red/conexión:', error);
            
            // Usar 'mensaje-error' para centralizar la salida si es posible
            const errorDiv = document.getElementById('mensaje-error') || document.getElementById('resultado'); 
            
            if (errorDiv) {
                errorDiv.textContent = 'Error de conexión. Verifique su red.'; 
                errorDiv.style.color = 'red';
                errorDiv.style.display = 'block';
            }
        }
    }
}