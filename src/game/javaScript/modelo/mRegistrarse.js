export class MRegistrarse {
    constructor() {}
    async mRegistrarse(formData){
        try{
            const response = await fetch(' Parte de php', {
                method: 'POST',
                body: formData, 
            });
            
            if(response.ok){
                const result = await response.text();

                if(result === 'correcto'){
                    window.location.href = " Parte de php";
                }else{
                    const errorDiv = document.getElementById('mensaje-error');
                    
                    if(errorDiv) {
                        if(result === '1062'){
                            errorDiv.textContent = 'El usuario ya existe. Por favor, intente con otro correo.';
                        } else if (result === 'ContrasenasDiferentes') {
                            errorDiv.textContent = 'Las contraseñas no son iguales';
                        } else {
                            errorDiv.textContent = 'Error desconocido al registrar.';
                        }
                    
                        errorDiv.style.display = 'block';
                        errorDiv.style.color = 'red';
                    }
                }
            }else{
                const errorDiv = document.getElementById('mensaje-error'); 
                if (errorDiv) {
                    errorDiv.textContent = 'ERROR: No se pudo comunicar con el servidor.';
                    errorDiv.style.display = 'block';
                    errorDiv.style.color = 'red';
                }
            }
        }catch(error){
            console.error('Error de red/conexión:', error);
            
            const resultadoDiv = document.getElementById('resultado'); 
            
            if (resultadoDiv) {
                resultadoDiv.textContent = 'Error de conexión. Verifique su red.'; 
                resultadoDiv.style.color = 'red';
                resultadoDiv.style.display = 'block';
            }
        }
    }
}