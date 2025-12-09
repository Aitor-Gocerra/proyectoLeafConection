<?php
class CUsuarios{
    private $objMUsuario;
    public $vista;

    function __construct(){
        require_once RUTA_MODELOS.'Usuarios.php';
        $this->objMUsuario = new MUsuarios();
    }

    public function login(){
        $this->vista = 'login';
    }

    public function registro(){
        $this->vista = 'registro';
    }

    public function mostrarInicio(){
        $this->vista = 'inicio';
    }

    public function registrar($datos){
        
        // 1. Primera validación de campos vacíos
        if(!$this->comprobarDatosRegistro($datos)){
            $this->vista = '';
            echo 'DatosIncompletos';
            return false;
        }
        
        // 2. Validación de usuario duplicado
        if ($this->objMUsuario->usuarioExiste($datos['usuario'])) {
            $this->vista = '';
            echo 'UsuarioExiste';
            return false;
        }
        
        // 3. Cifrado y Registro
        $datos["contrasenia"] = $this->cifrarPassword($datos["contrasenia"]);
        
        if ($this->objMUsuario->registrar($datos)){
            $this->vista = '';
            echo 'true';
            return true;
        } else {
            $this->vista = '';      
            echo $this->objMUsuario->codError;
            return false;
        }
    }

    public function inicio($datos){

        if($this->comprobarDatosInicio($datos)){
            if($resultado = $this->objMUsuario->inicio($datos)){
                
                $this->sessionStart();
                
                $_SESSION['usuario'] = $resultado['nombre'];
                
                if(isset($resultado['idUsuario'])) {
                    $_SESSION['idUsuario'] = $resultado['idUsuario'];
                }

                $this->vista = '';
                echo 'true';
                return 'true';
            } else {
                $this->vista = '';
                echo $this->objMUsuario->codError;
                return $this->objMUsuario->codError;
            }
        }
        
        $this->vista = '';
        echo 'DatosIncompletos';
        return 'DatosIncompletos';
    }

    public function enviarSolicitud($datos){
        $this->sessionStart();

        if(empty($datos["idAmigo"])){ 
            $this->vista = '';
            echo 'DatosIncompletos';
            return 'DatosIncompletos';
        }

        // Preparamos los datos para el Modelo
        $idEmisor = $_SESSION['idUsuario']; // Lo sacamos de la sesión 
        $nombreDestino = $datos["idAmigo"]; // Lo sacamos del formulario 

        $resultado = $this->objMUsuario->procesarSolicitud($idEmisor, $nombreDestino);

        // Devolvemos la respuesta al JS
        $this->vista = '';
        echo $resultado;
        return $resultado;
    }

    public function amigos(){
        // Iniciar sesión para saber quién es el usuario
        $this->sessionStart();

        // Definir la vista
        $this->vista = 'gestionAmigos';

        // Si no hay usuario logueado, no buscamos nada
        if (!isset($_SESSION['idUsuario'])) {
            return ['solicitudes' => []];
        }

        // Llamamos al Modelo para obtener los datos
        $listaSolicitudes = $this->objMUsuario->listarSolicitudes($_SESSION['idUsuario']);

        // Devolvemos el array.
        return ['solicitudes' => $listaSolicitudes];
    }

public function rechazarEliminar() {
 
        $this->sessionStart();

        // Recogemos los ids necesarios validamos que no este vacío en los dos
        $miID = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;
        
        // EL ID DEL AMIGO
        $idAmigo = isset($_POST['idAmigo']) ? $_POST['idAmigo'] : null;

        // Verificamos que tenemos los dos
        if ($miID && $idAmigo) {
            // Pasamos los DOS argumentos al modelo
            $resultado = $this->objMUsuario->rechazarEliminar($miID, $idAmigo); 

            // Devolvemos lo que diga el modelo
            echo $resultado; 
        } else {
            // Si falta alguno de los dos IDs, fallamos
            echo 'Error:FaltanDatos';
        }
    }



    private function comprobarDatosInicio($datos){
        if(empty($datos) || empty($datos["correo"]) || empty($datos["contrasenia"]))
            return false;
        else
            return true;
    }

    private function comprobarDatosRegistro($datos){
        if(empty($datos) || empty($datos["usuario"]) || empty($datos["correo"]) || empty($datos["contrasenia"]))
            return false;
        else
            return true;
    }

    private function cifrarPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function cerrarSesionUsuario(){
        //Lamamos la funcion de crearSesion porque para eliminarla hay que llamar a session_start()
        $this->sessionStart();

        setcookie(session_name(), '', time() - 1, '/');//session_name --> La sesión por defecto y la busca, '' --> Vacía la cookie,
        //  time() - 1 --> Hace que caduque hace un segundo el navegador lo detecta y lo elimina, '/' --> Se asegura que sea la raiz del sitio web

        //La destruye
        session_destroy();
        
        $this->vista = 'login';
    }

        private function sessionStart() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }
}
?>