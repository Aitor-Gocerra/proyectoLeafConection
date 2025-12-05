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
                
                $this->crearSesion();
                
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
        $this->crearSesion();
        
        session_unset();
        session_destroy();
        
       $this->vista = 'login';
    }

    private function crearSesion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}