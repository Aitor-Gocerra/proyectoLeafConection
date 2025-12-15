<?php
require_once __DIR__ . '/mConexion.php';

class Frase extends Conexion
{

    public function crearFrase($frase, $palabraFaltante, $fechaProgramada)
    {

        $sqlFrase = "
                INSERT INTO Frases (frase, palabraFaltante, fechaProgramada) 
                VALUES (:frase, :palabra, :fecha);
            ";

        $stmtFrase = $this->conexion->prepare($sqlFrase);
        $stmtFrase->bindParam(':frase', $frase);
        $stmtFrase->bindParam(':palabra', $palabraFaltante);
        $stmtFrase->bindParam(':fecha', $fechaProgramada);

        if ($stmtFrase->execute()) {
            return $this->conexion->lastInsertId();
        }
        return false;
    }

    public function listarFrases()
    {
        $sql = "
                SELECT * 
                FROM Frases 
                ORDER BY fechaProgramada DESC
                LIMIT 10;
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return !empty($resultado) ? $resultado : null;
    }
    public function buscarFrases($buscar)
    {
        $sql = "
                SELECT * 
                FROM Frases 
                WHERE frase LIKE :buscar1 
                   OR palabraFaltante LIKE :buscar2
                ORDER BY fechaProgramada DESC;
            ";

        $stmt = $this->conexion->prepare($sql);
        $terminoBusqueda = '%' . $buscar . '%';
        $stmt->bindParam(':buscar1', $terminoBusqueda);
        $stmt->bindParam(':buscar2', $terminoBusqueda);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return !empty($resultado) ? $resultado : null;
    }

    public function obtenerFrase($idFrase)
    {
        $sql = "
                SELECT * 
                FROM Frases 
                WHERE idFrase = :id
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarFrase($idFrase, $frase, $palabraFaltante, $fecha)
    {
        $sql = "
                UPDATE Frases 
                SET frase = :frase, palabraFaltante = :palabra, fechaProgramada = :fecha 
                WHERE idFrase = :id
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':frase', $frase);
        $stmt->bindParam(':palabra', $palabraFaltante);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function anadirPista($idFrase, $pista)
    {
        $sql = "
                INSERT INTO PistasFrase (idFrase, pista) 
                VALUES (:idFrase, :pista);
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idFrase', $idFrase, PDO::PARAM_INT);
        $stmt->bindParam(':pista', $pista);

        return $stmt->execute();
    }

    public function eliminarFrase($idFrase)
    {
        $sql = "
                DELETE FROM Frases 
                WHERE idFrase = :id;
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function actualizarFechas()
    {
        /* $fechaActual = date('Y-m-d'); */

        $sql = "
            UPDATE Frases
            SET fechaProgramada = NULL
            WHERE fechaProgramada < CURDATE();
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute();
    }

}