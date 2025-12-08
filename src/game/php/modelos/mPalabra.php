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

        $sql1 = "INSERT INTO Partida (temporizador, puntuacion, intentos, idUsuario) 
                VALUES (:temporizador, :puntuacion, :intentos, :idUsuario);";

        $sql2 = "INSERT INTO PalabraDia (idPartida, idPalabra) VALUES (:idPartida, :idPalabra);";

        try {
            $this->conexion->beginTransaction();
            $sth = $this->conexion->prepare($sql1);
            $sth->execute(['temporizador' => $temporizador, 'puntuacion' => $puntuacion, 'intentos' => $intentos, 'idUsuario' => $idUsuario]);
            $idPartida = $this->conexion->lastInsertId();
            $sth = $this->conexion->prepare($sql2);
            $sth->execute(['idPartida' => $idPartida, 'idPalabra' => $idPalabra]);
            $this->conexion->commit();
            return $sth->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function haJugadoHoy($idUsuario)
    {
        $sql = "SELECT * FROM PalabraDia 
                INNER JOIN Partida ON PalabraDia.idPartida = Partida.idPartida 
                INNER JOIN Palabras ON PalabraDia.idPalabra = Palabras.idPalabra 
                WHERE Partida.idUsuario = :idUsuario && DATE(Palabras.fechaProgramada) = :fechaActual;";

        $fechaActual = date("Y-m-d");

        try {
            $sth = $this->conexion->prepare($sql);
            $sth->execute(['idUsuario' => $idUsuario, 'fechaActual' => $fechaActual]);
            return $sth->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
