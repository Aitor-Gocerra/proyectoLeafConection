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
            // 1. BUSCAR EL ID DEL USUARIO DESTINO (Recuperamos idUsuario basándonos en el nombre)
            $sql = "SELECT idUsuario FROM Usuario WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $nombreDestino, PDO::PARAM_STR);
            $stmt->execute();
            
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Si no hay resultados, el usuario no existe
            if(!$fila){
                return 'UsuarioNoExiste';
            }
            
            $idReceptor = $fila['idUsuario'];

            // 2. EVITAR QUE SE ENVÍE SOLICITUD A SÍ MISMO
            if($idEmisor == $idReceptor){
                return 'AutoSolicitud';
            }

            // 3. COMPROBAR SI YA EXISTE UNA RELACIÓN (Aceptada o Pendiente)
            // Verificamos si (Yo -> Él) O (Él -> Yo) existe en la tabla
            $sqlCheck = "SELECT idUsuario1 FROM Amigos 
                         WHERE (idUsuario1 = :emis AND idUsuario2 = :recep) 
                            OR (idUsuario1 = :recep AND idUsuario2 = :emis)";
            
            $stmtCheck = $this->conexion->prepare($sqlCheck);
            $stmtCheck->bindValue(':emis', $idEmisor, PDO::PARAM_INT);
            $stmtCheck->bindValue(':recep', $idReceptor, PDO::PARAM_INT);
            $stmtCheck->execute();

            if($stmtCheck->rowCount() > 0){
                return 'SolicitudExistente';
            }

            // 4. INSERTAR LA NUEVA SOLICITUD
            // idUsuario1: Emisor (quien envía)
            // idUsuario2: Receptor (quien recibe)
            // fechaSolicitud: NOW() para la fecha/hora actual de la BD
            // estado: 'pendiente'
            $sqlInsert = "INSERT INTO Amigos (idUsuario1, idUsuario2, fechaSolicitud, estado) 
                          VALUES (:id1, :id2, NOW(), 'pendiente')";
            
            $stmtInsert = $this->conexion->prepare($sqlInsert);
            $stmtInsert->bindValue(':id1', $idEmisor, PDO::PARAM_INT);
            $stmtInsert->bindValue(':id2', $idReceptor, PDO::PARAM_INT);
            
            if($stmtInsert->execute()){
                return 'true'; // Éxito
            } else {
                return 'ErrorInsertar';
            }

        } catch (PDOException $e) {
            error_log("Error en procesarSolicitud: " . $e->getMessage());
            return 'ErrorBD';
        }
    }
}