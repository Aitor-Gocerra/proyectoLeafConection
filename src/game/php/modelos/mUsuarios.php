<?php
/**
 * Esta clase permite la total funcionalidad de todos los procesos de los usuarios y administradores, sea inicio de sesión o registro.
 */
class MUsuarios{
    public $codError;
    private $conexion;
    function __construct(){
        require_once 'configDB.php';
        $objConexion = new Db();
        $this->conexion= $objConexion->conexion;
    }
    /**
     * Método que permite guardar en la bbdd el usuario.
     * @param
     */
    public function registrar($datos){
        try{
            $sql = "INSERT INTO Usuario(nombre, correo, pw, estado) VALUES(:nombre, :correo, :pw, :estado);";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $datos['usuario'], PDO::PARAM_STR);
            $stmt->bindValue(':correo', $datos['correo'], PDO::PARAM_STR);
            $stmt->bindValue(':contrasenia', $datos['contrasenia'], PDO::PARAM_STR);
            $stmt->bindValue(':estado', 1, PDO::PARAM_STR);

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
    
    /**
     * Método que permite e inicio de sesión de los usuarios.
     * @param
     * @return
     */
    public function inicio($datos){
        try{

            $sql='SELECT * from Usuarios where nombreUsuario = :usuario;';

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':usuario', $datos['usuario'], PDO::PARAM_STR);

            $stmt->execute();
            if($stmt->rowCount() > 0){
                $fila = $stmt->fetch(PDO::FETCH_ASSOC);
                if($datos["usuario"] == $fila['nombreUsuario'] && password_verify($datos["passw"], $fila["passUsuario"]))
                    return $fila;
                else{
                    $this->codError = "PasswIncorrecta";
                    return false;
                }
            }
                
            

        }catch (PDOException $e) {
                $this->codError = "PasswIncorrecta";

            return false;
        }
    }
}