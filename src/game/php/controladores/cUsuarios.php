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

    public function mostrarRegistrar(){
        $this->vista = 'registro';
    }

    public function mostrarInicio(){
        $this->vista = 'inicio';
    }

    public function registrar($datos){
        
        if(!$this->comprobarDatosRegistro($datos)){
            $this->vista = '';
            echo 'false'; 
            exit();
        }
        
        if ($this->objMUsuario->usuarioExiste($datos['usuario'])) {
            $this->vista = '';
            echo 'UsuarioExiste';
            exit();
        }
        
        $datos["contrasenia"] = $this->cifrarPassword($datos["contrasenia"]);
        
        if ($this->objMUsuario->registrar($datos)){
            $this->vista = '';
            echo 'true';
            exit();
        } else {
            $this->vista = '';
            echo $this->objMUsuario->codError;
            exit();
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
                exit();
            } else {
                $this->vista = '';
                echo $this->objMUsuario->codError;
                exit();
            }
        }
        
        $this->vista = '';
        echo 'DatosIncompletos';
        exit();
    }

    public function enviarSolicitud($datos){
        // 1. Iniciamos sesión para saber QUIÉN envía la solicitud
        $this->sessionStart();

        if(empty($datos["idAmigo"])){ 
            return 'DatosIncompletos';
        }

        // 4. Preparamos los datos para el Modelo
        $idEmisor = $_SESSION['idUsuario']; // Lo sacamos de la sesión (Seguro)
        $nombreDestino = $datos["idAmigo"]; // Lo sacamos del formulario (Input usuario)

        // 5. Llamamos al Modelo
        // El modelo debe devolver strings exactos: 'true', 'UsuarioNoExiste', etc.
        $resultado = $this->objMUsuario->procesarSolicitud($idEmisor, $nombreDestino);

        // 6. Devolvemos la respuesta al JS
        echo $resultado;
        exit();
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