<?php
require_once __DIR__ . '/mConexion.php';

class Consejo extends Conexion
{

    public function mostrarConsejo()
    {
        $fecha = date('Y-m-d');

        $sql = "
                SELECT *
                FROM Consejos
                WHERE DATE(fechaProgramada) = :fecha
                LIMIT 1;
            ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}