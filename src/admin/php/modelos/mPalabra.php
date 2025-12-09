<?php
require_once __DIR__ . '/mConexion.php';

class Palabra extends Conexion
{

    public function crearPalabra($frase, $definicion, $fechaProgramada)
    {
        // 1. Insertar la frase
        $sqlPalabra = "
                INSERT INTO Palabras (palabra, definicion, fechaProgramada) 
                VALUES (:palabra, :definicion, :fecha);
            ";

        $stmtPalabra = $this->conexion->prepare($sqlPalabra);

        $stmtPalabra->bindParam(':palabra', $frase);
        $stmtPalabra->bindParam(':definicion', $definicion);
        $stmtPalabra->bindParam(':fecha', $fechaProgramada);

        if ($stmtPalabra->execute()) {
            return $this->conexion->lastInsertId();
        }

        return false;

    }

    public function listarPalabras()
    {
        $sql = "
                SELECT * 
                FROM Palabras 
                ORDER BY fechaProgramada DESC
                LIMIT 10;
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPalabras($buscar)
    {
        $sql = "
                SELECT * 
                FROM Palabras 
                WHERE palabra LIKE :buscar1 
                   OR definicion LIKE :buscar2
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

    public function obtenerPalabra($idPalabra)
    {
        $sql = "
                SELECT * 
                FROM Palabras 
                WHERE idPalabra = :id
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarPalabra($idPalabra, $palabra, $definicion, $fecha)
    {
        $sql = "
                UPDATE Palabras 
                SET palabra = :palabra, definicion = :correcta, fechaProgramada = :fecha 
                WHERE idPalabra = :id
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':palabra', $palabra);
        $stmt->bindParam(':correcta', $definicion);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function anadirPista($idPalabra, $pista)
    {
        $sql = "
                INSERT INTO PistasPalabras (idPalabra, pista) 
                VALUES (:idPalabra, :pista);
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idPalabra', $idPalabra, PDO::PARAM_INT);
        $stmt->bindParam(':pista', $pista);

        return $stmt->execute();
    }

    public function eliminarPalabra($idPalabra)
    {
        $sql = "
                DELETE FROM Palabras
                WHERE idPalabra = :id;
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function actualizarFechas()
    {
        /* $fechaActual = date('Y-m-d'); */

        $sql = "
            UPDATE Palabras
            SET fechaProgramada = NULL
            WHERE fechaProgramada < NOW();
        ";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute();
    }
}