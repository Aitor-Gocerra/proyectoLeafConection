
export class MRegistrarse {
    constructor() {}
    async mRegistrarse(formData){
        try{
            const response = await fetch('index.php?c=Usuarios&m=registrar', { //ENVÍA LOS DATOS A UN CONTROLADOR USUARIOS QUE TENDRA EL MÉTODO REGISTRAR
                method: 'POST',
                body: formData, 
            });
            
            if(response.ok){
                const result = await response.text();

                if(result === 'true'){ ///////////// SI LS DATOS SON CORRECTOS TE REDIRIGE AL LOGIN PARA INICIAR SESIÓN DEFINITIVAMENTE Y ENTRAR A LA PÁGINA
                    window.location.href = "index.php?c=Usuarios&m=login";
                }else{
                    const errorDiv = document.getElementById('mensaje-error'); 
                    
                    if(errorDiv) {
                        
                        if(result === 'UsuarioExiste'){ //Si existe el usuario o el correo me devuelve UsuarioExiste que muestra el error
                            errorDiv.textContent = 'El nombre de usuario o correo ya está registrado.';
                            
                        } else if(result === '1062'){  //Codigo de php que significa entrada duplicada
                            errorDiv.textContent = 'Este nombre de usuario ya esta en uso.';
                            
                        } else if (result === 'ContrasenasDiferentes') { //La contraseña es diferente a la de la base de datos
                            errorDiv.textContent = 'Las contraseñas no coinciden.';
                        
                        } else if (result === 'DatosIncompletos') { //Es una segunda validacion dentro de php y valida los campos si estásn vacíos
                            errorDiv.textContent = 'Por favor, rellene todos los campos.';

                        } else {
                            errorDiv.textContent = 'Error al registrar:' + result +'.';
                        }
                    
                        errorDiv.style.display = 'block';
                        errorDiv.style.color = 'red';
                    }
                }
            }else{
                const errorDiv = document.getElementById('mensaje-error'); 
                if (errorDiv) {
                    errorDiv.textContent = `ERROR HTTP ${response.status}: Fallo al comunicarse con el servidor.`; //Es un fallo en la comunicacion con el servidor
                    errorDiv.style.display = 'block';
                    errorDiv.style.color = 'red';
                }
            }
        }catch(error){
            console.error('Error de red/conexión:', error);
            
            const errorDiv = document.getElementById('mensaje-error') || document.getElementById('resultado'); 
            
            if (errorDiv) {
                errorDiv.textContent = 'Error de conexión. Verifique su red.'; 
                errorDiv.style.color = 'red';
                errorDiv.style.display = 'block';
            }
        }
    }
}