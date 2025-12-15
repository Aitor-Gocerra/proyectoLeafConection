<?php

require_once __DIR__ . '/mConexion.php';

class Noticia extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function obtenerNoticiaDelDia()
    {
        $sql = "SELECT * FROM Noticias WHERE DATE(fechaProgramada) = :fechaActual;";

        $fechaActual = date("Y-m-d");

        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(['fechaActual' => $fechaActual]);
            $noticia = $stmt->fetch(PDO::FETCH_ASSOC);
            return $noticia;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerPreguntas($idNoticia)
    {
        $sql = "SELECT * FROM Preguntas WHERE idNoticia = :idNoticia;";

        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(['idNoticia' => $idNoticia]);
            $noticia = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $noticia;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerOpciones($idNoticia)
    {
        $sql = "SELECT * FROM Opciones WHERE idNoticia = :idNoticia;";

        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(['idNoticia' => $idNoticia]);
            $noticia = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $noticia;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function obtenerRespuestas($idNoticia)
    {
        $sql = "SELECT nPregunta, nOpcion FROM RespuestaCorrecta WHERE idNoticia = :idNoticia;";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(['idNoticia' => $idNoticia]);
            $respuestas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $respuestas;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function guardarPartida($idNoticia, $temporizador, $puntuacion, $intentos, $idUsuario)
    {

        $sql1 = "INSERT INTO Partida (temporizador, puntuacion, intentos, idUsuario) 
                    VALUES (:temporizador, :puntuacion, :intentos, :idUsuario);";

        $sql2 = "INSERT INTO NoticiaDia (idPartida, idNoticia) VALUES (:idPartida, :idNoticia);";

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
                'idNoticia' => $idNoticia
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
            SELECT * FROM NoticiaDia 
            INNER JOIN Partida ON NoticiaDia.idPartida = Partida.idPartida 
            INNER JOIN Noticias ON NoticiaDia.idNoticia = Noticias.idNoticia 
            WHERE Partida.idUsuario = :idUsuario AND DATE(Noticias.fechaProgramada) = :fechaActual;";

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
?>