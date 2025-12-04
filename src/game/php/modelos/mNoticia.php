<?php 

    require_once __DIR__ .'/mConexion.php';

    class Noticia extends Conexion{

        public function __construct(){
            parent::__construct();
        }

        public function obtenerNoticiaDelDia(){
            $sql = "SELECT * FROM Noticias WHERE DATE(fechaProgramada) = :fechaActual;";

            $fechaActual = date("Y-m-d");

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['fechaActual' => $fechaActual]);
                $noticia = $sth->fetch(PDO::FETCH_ASSOC);
                return $noticia;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function obtenerPreguntas($idNoticia){
            $sql = "SELECT * FROM Preguntas WHERE idNoticia = :idNoticia;";

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['idNoticia' => $idNoticia]);
                $noticia = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $noticia;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function obtenerOpciones($idNoticia){
            $sql = "SELECT * FROM Opciones WHERE idNoticia = :idNoticia;";

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['idNoticia' => $idNoticia]);
                $noticia = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $noticia;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function obtenerRespuestas($idNoticia){
            $sql = "SELECT nOpcion FROM RespuestaCorrecta WHERE idNoticia = :idNoticia;";
            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['idNoticia' => $idNoticia]);
                $respuestas = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $respuestas;
            }
            catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function guardarPartida($idNoticia, $temporizador, $puntuacion, $intentos, $idUsuario){

            $sql1 = "INSERT INTO Partida (temporizador, puntuacion, intentos, idUsuario) 
                    VALUES (:temporizador, :puntuacion, :intentos, :idUsuario);"; 

            $sql2 = "INSERT INTO NoticiaDia (idPartida, idNoticia) VALUES (:idPartida, :idNoticia);";
            
            try{
                $this->conexion->beginTransaction();
                $sth = $this->conexion->prepare($sql1);
                $sth->execute(['temporizador' => $temporizador, 'puntuacion' => $puntuacion, 'intentos' => $intentos, 'idUsuario' => $idUsuario]);
                $idPartida = $this->conexion->lastInsertId();
                $sth = $this->conexion->prepare($sql2);
                $sth->execute(['idPartida' => $idPartida, 'idNoticia' => $idNoticia]);
                $this->conexion->commit();
                return true;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>