<?php
require_once __DIR__ . '/mConexion.php';

class Frase extends Conexion
{

    public function mostrarFrase()
    {
        $fecha = date('Y-m-d');

        $sql = "
                    SELECT *
                    FROM Frases
                    WHERE DATE(fechaProgramada) = :fecha
                    LIMIT 1;
                ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function mostrarPista($idFrase)
    {

        $sql = "
                    SELECT pista
                    FROM PistasFrase
                    WHERE idFrase = :id;
                ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function palabraFaltante($idFrase)
    {
        $sql = "
                    SELECT palabraFaltante
                    FROM Frases
                    WHERE idFrase = :id;
                ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>