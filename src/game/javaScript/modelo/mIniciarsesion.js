export class mIniciarSesion {
    constructor() {}
    async mIniciarSesion(formData){

        try {
            const response = await fetch('', { 
                method: 'POST',
                body: formData,
            });
    
            if(response.ok) {
                const result = await response.text();
    
                if (result=='true') {
                    window.location.href = "Redirigir al index";
                } else {
                    const error = document.getElementById('mensaje-error'); 
                    
                    if(result == 'ContraseniaIncorrrecta'){
                        error.textContent = 'Contraseña incorrecta';
                    }else{
                        error.textContent = 'Usuario o contraseña incorrecto';
                    }
                    error.style.display = 'block';
                }
            } else {
                error = document.getElementById('mensaje-error');
                error.textContent = 'Fallo al contactar con el servidor.'
                error.style.display = 'block'; 
            }
        } catch (error) {
            console.error('Error:', error); 
            let resultadoDiv = document.getElementById('resultado');
            if (resultadoDiv) {
                resultadoDiv.textContent = 'Error de conexión.';
                resultadoDiv.style.color = 'red';
            }
        }
    }
}