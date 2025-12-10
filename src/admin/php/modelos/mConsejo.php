<?php
require_once __DIR__ . '/mConexion.php';

class Consejo extends Conexion
{
    public function listarTematicas(){
        // CORRECCIÓN CLAVE: Usamos AS para que la clave devuelta sea 'nombreTematica'
        $sql = 'SELECT idTematica, tematica AS nombreTematica FROM Tematica;'; 

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        // fetchAll() asegura que obtengamos todas las filas
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // En mConsejo.php, dentro de class Consejo extends Conexion

    public function insertarConsejo($texto, $idTematica, $fecha)
    {
        $sql = "
            INSERT INTO Consejos (consejo, fechaProgramada, idTematica)
            VALUES (:texto, :fecha, :idTematica)
        ";

        try {
            $stmt = $this->conexion->prepare($sql);
            
            $stmt->bindParam(':texto', $texto, PDO::PARAM_STR);
            $stmt->bindParam(':idTematica', $idTematica, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);

            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Error al insertar consejo: " . $e->getMessage());
            return false;
        }
    }
}