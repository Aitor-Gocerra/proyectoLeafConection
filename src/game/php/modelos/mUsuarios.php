<?php

require_once __DIR__ . '/mConexion.php';

class MUsuarios extends Conexion{
    public $codError;
    
    public function registrar($datos){
        try{
            $sql = "INSERT INTO Usuario(nombre, correo, pw, estado) VALUES(:nombre, :correo, :pw, :estado);";
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
            $sql='SELECT idUsuario, nombre, pw from Usuario where correo = :correo;'; 

            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':correo', $datos['correo'], PDO::PARAM_STR);

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $fila = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if(password_verify($datos["contrasenia"], $fila["pw"])){ 
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


    public function procesarSolicitud($idEmisor, $nombreDestino){
        try {
            // 1. BUSCAR EL ID DEL USUARIO DESTINO
            $sql = "SELECT idUsuario FROM Usuario WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $nombreDestino, PDO::PARAM_STR);
            $stmt->execute();
            
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$fila){
                return 'UsuarioNoExiste';
            }
            
            $idReceptor = $fila['idUsuario'];

            // 2. EVITAR AUTO-SOLICITUD
            if($idEmisor == $idReceptor){
                return 'AutoSolicitud';
            }

            // 3. COMPROBAR SI YA EXISTE RELACIÓN
            // Usamos nombres DISTINTOS para cada hueco 
            $sqlCheck = "SELECT idUsuario1 FROM Amigos 
                         WHERE (idUsuario1 = :emisor1 AND idUsuario2 = :receptor1) 
                            OR (idUsuario1 = :receptor2 AND idUsuario2 = :emisor2)";
            
            $stmtCheck = $this->conexion->prepare($sqlCheck);
            
            // Enlazamos las 4 variables por separado
            $stmtCheck->bindValue(':emisor1', $idEmisor, PDO::PARAM_INT);
            $stmtCheck->bindValue(':receptor1', $idReceptor, PDO::PARAM_INT);
            
            $stmtCheck->bindValue(':receptor2', $idReceptor, PDO::PARAM_INT);
            $stmtCheck->bindValue(':emisor2', $idEmisor, PDO::PARAM_INT);
            
            $stmtCheck->execute();

            if($stmtCheck->rowCount() > 0){
                return 'SolicitudExistente';
            }
            // 4. INSERTAR LA NUEVA SOLICITUD
            // Estado: 0 (Pendiente), Fecha: NOW()
            $sqlInsert = "INSERT INTO Amigos (idUsuario1, idUsuario2, fechaSolicitud, estado) VALUES (:id1, :id2, NOW(), 0)";
            
            $stmtInsert = $this->conexion->prepare($sqlInsert);
            $stmtInsert->bindValue(':id1', $idEmisor, PDO::PARAM_INT);
            $stmtInsert->bindValue(':id2', $idReceptor, PDO::PARAM_INT);
            
            
            if($stmtInsert->execute()){
                return 'true';
            } else {
                return 'ErrorInsertar';
            }

        } catch (PDOException $e) {
            return "ErrorSQL: " . $e->getMessage();
        }
    }

public function listarSolicitudes($idUsuario)
    {
        
        $sql = "
            SELECT 
                Amigos.idUsuario1 AS idEmisor,
                Usuario.nombre AS nombreAmigo
            FROM Amigos
            INNER JOIN Usuario ON Amigos.idUsuario1 = Usuario.idUsuario
            WHERE Amigos.idUsuario2 = :idUsuario 
            AND (Amigos.estado = 0 OR Amigos.estado = b'0');
        ";

        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Si falla, mostramos el error para saber qué pasa
            echo "Error SQL: " . $e->getMessage();
            return [];
        }
    }
}