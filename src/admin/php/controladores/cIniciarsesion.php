<?php
class CIniciarsesion{
    private $objMUsuario;
    public $vista;

    function __construct(){
        require_once RUTA_MODELOS.'Iniciarsesion.php';
        $this->objMUsuario = new MIniciarsesion();
    }

    public function login(){
        $this->vista = 'login';
    }

    public function mostrarInicio(){
        $this->vista = 'gestionarPalabras';
    }

    public function inicio($datos){

        if ($this->comprobarDatosInicio($datos)){
            if ($resultado = $this->objMUsuario->inicio($datos)){
                
                $estado = $this->objMUsuario->estado($resultado['nombre']);
                
                if (!$estado){ 
                    
                    $this->sessionStart();
                    $_SESSION['usuario'] = $resultado['nombre'];
                    
                    if (isset($resultado['idUsuario'])) {
                        $_SESSION['idUsuario'] = $resultado['idUsuario'];
                    }

                    $this->vista = '';
                    echo 'true';
                    return 'true';
                    
                } else {
                    $this->vista = '';
                    echo 'UsuarioDesactivado';
                    return 'UsuarioDesactivado';
                }
                
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


    private function comprobarDatosInicio($datos){
        if(empty($datos) || empty($datos["correo"]) || empty($datos["contrasenia"]))
            return false;
        else
            return true;
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