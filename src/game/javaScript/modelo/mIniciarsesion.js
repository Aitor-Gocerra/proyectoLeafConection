// Archivo: javascript/modelo/mIniciarsesion.js

// 🔑 CORRECCIÓN: Usar 'export default' en la clase.
export default class mIniciarSesion {
    constructor() {}
    async mIniciarSesion(formData){

        try {
            const response = await fetch('index.php?c=Usuarios&m=inicio', {
                method: 'POST',
                body: formData,
            });

            if(response.ok) {
                const result = await response.text();

                if (result=='true') {
                    window.location.href = "index.php?c=Usuarios&m=mostrarInicio";
                } else {
                    const errorDiv = document.getElementById('mensaje-error'); 
                    
                    if (result === 'ContraseniaIncorrrecta'){
                        errorDiv.textContent = 'Contraseña incorrecta';
                    } else if (result === 'UsuarioIncorrecto') {
                        errorDiv.textContent = 'El usuario o correo electrónico no está registrado.';
                    } else if (result === 'DatosIncompletos') {
                        errorDiv.textContent = 'Faltan datos de inicio de sesión.';
                    } else {
                        errorDiv.textContent = 'Usuario o contraseña incorrecto. Intente de nuevo.';
                    }
                    errorDiv.style.display = 'block';
                }
            } else {
                const errorDiv = document.getElementById('mensaje-error');
                errorDiv.textContent = 'Fallo al contactar con el servidor. (HTTP Error)';
                errorDiv.style.display = 'block'; 
            }
        } catch (error) {
            console.error('Error:', error); 
            let resultadoDiv = document.getElementById('resultado') || document.getElementById('mensaje-error');
            if (resultadoDiv) {
                resultadoDiv.textContent = 'Error de conexión. Verifique su internet.';
                resultadoDiv.style.color = 'red';
                resultadoDiv.style.display = 'block';
            }
        }
    }
}