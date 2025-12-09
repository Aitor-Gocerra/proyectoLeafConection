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

    public function guardarPartida($idFrase, $temporizador, $puntuacion, $intentos, $idUsuario)
    {

        $sql1 = "INSERT INTO Partida (temporizador, puntuacion, intentos, idUsuario) 
                VALUES (:temporizador, :puntuacion, :intentos, :idUsuario);";

        $sql2 = "INSERT INTO FraseDia (idPartida, idFrase) VALUES (:idPartida, :idFrase);";

        try {
            $this->conexion->beginTransaction();
            $sth = $this->conexion->prepare($sql1);
            $sth->execute(['temporizador' => $temporizador, 'puntuacion' => $puntuacion, 'intentos' => $intentos, 'idUsuario' => $idUsuario]);

            $idPartida = $this->conexion->lastInsertId();
            
            $sth = $this->conexion->prepare($sql2);
            $sth->execute(['idPartida' => $idPartida, 'idFrase' => $idFrase]);

            $this->conexion->commit();

            return ['success' => true];

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function haJugadoHoy($idUsuario)
    {
        $sql = "SELECT * FROM FraseDia 
                INNER JOIN Partida ON FraseDia.idPartida = Partida.idPartida 
                INNER JOIN Frases ON FraseDia.idFrase = Frases.idFrase 
                WHERE Partida.idUsuario = :idUsuario && DATE(Frases.fechaProgramada) = :fechaActual;";

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
?>