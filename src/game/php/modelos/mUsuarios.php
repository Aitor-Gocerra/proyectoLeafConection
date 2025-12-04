<?php
class MUsuarios{
    public $codError;
    private $conexion;
    function __construct(){
        require_once __DIR__.'\..\config\configDB.php';
        $objConexion = new Db();
        $this->conexion= $objConexion->conexion;
    }
    
    public function registrar($datos){
        try{
            $sql = "INSERT INTO usuario(nombre, correo, pw, estado) VALUES(:nombre, :correo, :pw, :estado);";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $datos['usuario'], PDO::PARAM_STR);
            $stmt->bindValue(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->bindValue(':pw', $datos['contrasenia'], PDO::PARAM_STR);
            $stmt->bindValue(':estado', 1, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->rowCount() > 0;
            
        }catch (PDOException $e) {
            error_log($e->getMessage());
            if($e->errorInfo[1] == 1062){
                $this->codError = "1062";
            }
            else{
                $this->codError = "9998";
            }
            return false;
        }
    }
    
    
   public function inicio($datos){
        try{
            // 1. Búsqueda por correo
            $sql='SELECT  nombre, pw from usuario where correo = :correo;'; 

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':correo', $datos['correo'], PDO::PARAM_STR);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $fila = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if($datos["contrasenia"] === $fila["pw"]){ 
                    return $fila;
                } else {
                    // Contraseña incorrecta
                    $this->codError = "ContraseniaIncorrrecta";
                    return false;
                }
            }
            
            // Si rowCount() es 0, el usuario no existe.
            $this->codError = "UsuarioIncorrecto"; 
            return false;
            
        }catch (PDOException $e) {
            error_log("Error BD en login: " . $e->getMessage()); 
            $this->codError = "ErrorInternoBD";
            return false;
        }
    }

    public function usuarioExiste($nombreUsuario){
        try{
            $sql = "SELECT COUNT(*) FROM Usuario WHERE nombre = :nombre;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $nombreUsuario, PDO::PARAM_STR);
            $stmt->execute();
            
            return $stmt->fetchColumn() > 0;
            
        }catch (PDOException $e) {
            error_log($e->getMessage());
            $this->codError = "ErrorConsultaBD";
            return true;
        }
    }
}