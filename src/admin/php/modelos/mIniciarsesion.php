<?php

require_once __DIR__ . '/mConexion.php';

class MIniciarsesion extends Conexion{
    public $codError;
    
    
    public function inicio($datos){
        try{
            $sql='SELECT nombre, correo, password from Administrador where correo = :correo;'; 

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':correo', $datos['correo'], PDO::PARAM_STR);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $fila = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if(password_verify($datos["contrasenia"], $fila["password"])){ 
                    return $fila; 
                } else {
                    $this->codError = "ContraseniaIncorrrecta";
                    return false;
                }
            }

            $this->codError = "UsuarioIncorrecto"; 
            return false;
            
        }catch (PDOException $e) {
            error_log("Error BD en login: " . $e->getMessage()); 
            $this->codError = "ErrorInternoBD";
            return false;
        }
    }

    public function estado($nombre)
    {
        $sql = 'SELECT COUNT(*) FROM Usuario Where nombre = :nombre AND estado = 0 ;';

        try{
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchColumn() > 0;

            } catch (PDOException $e) {
            error_log("Error SQL al verificar baneo: " . $e->getMessage());
            return false;
            }
    }
}