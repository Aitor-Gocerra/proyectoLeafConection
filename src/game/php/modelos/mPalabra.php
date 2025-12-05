<?php
require_once __DIR__ . '/mConexion.php';

class Palabra extends Conexion
{

    public function mostrarPalabra()
    {
        $fecha = date('Y-m-d');

        $sql = "
                SELECT *
                FROM Palabras
                WHERE DATE(fechaProgramada) = :fecha
                LIMIT 1;
            ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function mostrarPista($idPalabra)
    {

        $sql = "
                SELECT pista
                FROM PistasPalabras
                WHERE idPalabra = :id;
            ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function palabraCorrecta($idPalabra){

        $sql = "
            SELECT palabra
            FROM Palabras
            WHERE idPalabra = :id;
        ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
