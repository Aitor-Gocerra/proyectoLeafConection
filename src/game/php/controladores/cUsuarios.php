<?php
class CUsuarios{
    private $objMUsuario;
    public $vista;
    function __construct(){
        require_once RUTA_MODELOS.'Usuarios.php';
        $this->objMUsuario = new MUsuarios();
    }

    public function predeterminada(){
        $this->vista = 'login';
    }
    public function mostrarRegistrar(){
        $this->vista = 'registro';
    }
    public function mostrarInicio(){
        $this->vista = 'login';
    }

    public function mostrarInicioJuego(){
        $this->vista = 'inicio';
    }


    public function registrar($datos){
        if($this->comprobarDatosReg($datos)){
            $datos["contrasenia"] = $this->cifrarPassword($datos["contrasenia"]);
            if ($this->objMUsuario->registrar($datos)){
                $this->vista = '';
                echo 'true';
                return true;
            }else{
                $this->vista = '';
                echo $this->objMUsuario->codError;
                return false;
            }
        }else{
            $this->vista = '';
            echo 'false';
            return false;
        }
    }
    

    public function inicio($datos){
        if($this->comprobarDatosIni($datos)){
            if($resultado = $this->objMUsuario->inicio($datos)){
                $this->vista = '';
                echo 'true';
                return $resultado;
            }else{
                $this->vista = '';
                echo $this->objMUsuario->codError;
                return false;
            }
        }
        echo $this->objMUsuario->codError; 
        return false;
    }

    private function comprobarDatosIni($datos){
        if(empty($datos) || empty($datos["correo"]) || empty($datos["contrasenia"]))
            return false;
        else
            return true;
    }

    private function comprobarDatosReg($datos){
        if(empty($datos) || empty($datos["correo"]) || empty($datos["contrasenia"]))
            return false;
        else
            return true;
    }

    public function cerrarSesionUser(){
        session_destroy();
        $this->vista = 'login';
    }

    private function cifrarPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }


    

}