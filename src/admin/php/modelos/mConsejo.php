<?php
require_once __DIR__ . '/mConexion.php';

class Consejo extends Conexion
{
    public function crearConsejo($consejo, $idTematica, $fechaProgramada)
    {
        $sql = "
            INSERT INTO Consejos (consejo, idTematica, fechaProgramada)
            VALUES (:consejo, :idTematica, :fecha);
        ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':consejo', $consejo);
        $stmt->bindParam(':idTematica', $idTematica);
        $stmt->bindParam(':fecha', $fechaProgramada);

        if ($stmt->execute()) {
            return $this->conexion->lastInsertId();
        }
        return false;
    }

    public function listarConsejos()
    {
        $sql = "
            SELECT Consejos.*, Tematica.tematica AS nombreTematica
            FROM Consejos
            LEFT JOIN Tematica ON Consejos.idTematica = Tematica.idTematica
            ORDER BY Consejos.fechaProgramada DESC
            LIMIT 10;
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return !empty($resultado) ? $resultado : null;
    }

    public function buscarConsejos($buscar)
    {
        $sql = "
            SELECT Consejos.*, Tematica.tematica AS nombreTematica
            FROM Consejos
            LEFT JOIN Tematica ON Consejos.idTematica = Tematica.idTematica
            WHERE Consejos.consejo LIKE :buscar1
               OR Consejos.fechaProgramada LIKE :buscar2
               OR Tematica.tematica LIKE :buscar3
            ORDER BY Consejos.fechaProgramada DESC;
        ";

        $stmt = $this->conexion->prepare($sql);
        $termino = '%' . $buscar . '%';
        $stmt->bindParam(':buscar1', $termino);
        $stmt->bindParam(':buscar2', $termino);
        $stmt->bindParam(':buscar3', $termino);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return !empty($resultado) ? $resultado : null;
    }

    public function obtenerConsejo($idConsejo)
    {
        $sql = "
            SELECT Consejos.*, Tematica.tematica AS nombreTematica
            FROM Consejos
            LEFT JOIN Tematica ON Consejos.idTematica = Tematica.idTematica
            WHERE Consejos.idConsejo = :id
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idConsejo, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarConsejo($idConsejo, $consejo, $idTematica, $fecha)
    {
        $sql = "
            UPDATE Consejos
            SET consejo = :consejo, idTematica = :idTematica, fechaProgramada = :fecha
            WHERE idConsejo = :id;
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':consejo', $consejo);
        $stmt->bindParam(':idTematica', $idTematica);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id', $idConsejo, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function eliminarConsejo($idConsejo)
    {
        $sql = "
            DELETE FROM Consejos
            WHERE idConsejo = :id;
        ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idConsejo, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function actualizarFechas()
    {
        $sql = "
            UPDATE Palabras
            SET fechaProgramada = NULL
            WHERE fechaProgramada < NOW();
        ";
        $stmt = $this->conexion->prepare($sql);
        return $stmt->execute();
    }

    public function listarTematicas()
    {
        $sql = 'SELECT idTematica, tematica AS nombreTematica FROM Tematica;';
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return !empty($resultado) ? $resultado : null;
    }
}
