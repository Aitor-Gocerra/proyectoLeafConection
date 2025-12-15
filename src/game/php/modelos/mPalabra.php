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

    public function palabraCorrecta($idPalabra)
    {

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

    public function guardarPartida($idPalabra, $temporizador, $puntuacion, $intentos, $idUsuario)
    {

        $sql1 = "
            INSERT INTO Partida (temporizador, puntuacion, intentos, idUsuario) 
            VALUES (:temporizador, :puntuacion, :intentos, :idUsuario);";

        $sql2 = "
            INSERT INTO PalabraDia (idPartida, idPalabra) 
            VALUES (:idPartida, :idPalabra);";

        try {
            $this->conexion->beginTransaction();

            $stmt = $this->conexion->prepare($sql1);

            $stmt->execute([
                'temporizador' => $temporizador, 
                'puntuacion' => $puntuacion, 
                'intentos' => $intentos, 
                'idUsuario' => $idUsuario
            ]);

            $idPartida = $this->conexion->lastInsertId();

            $stmt = $this->conexion->prepare($sql2);

            $stmt->execute([
                'idPartida' => $idPartida, 
                'idPalabra' => $idPalabra
            ]);

            $this->conexion->commit();

            return ['success' => true];

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function haJugadoHoy($idUsuario)
    {
        $sql = "
            SELECT * FROM PalabraDia 
            INNER JOIN Partida ON PalabraDia.idPartida = Partida.idPartida 
            INNER JOIN Palabras ON PalabraDia.idPalabra = Palabras.idPalabra 
            WHERE Partida.idUsuario = :idUsuario && DATE(Palabras.fechaProgramada) = :fechaActual;";

        $fechaActual = date("Y-m-d");

        try {
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute([
                'idUsuario' => $idUsuario, 
                'fechaActual' => $fechaActual
            ]);

            return $stmt->rowCount() > 0 ? true : false;
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
