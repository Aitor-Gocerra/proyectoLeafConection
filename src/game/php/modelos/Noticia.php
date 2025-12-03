<?php 

    require_once __DIR__ .'/../config/Conectar.php';

    class Noticia extends Conectar{

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

    }

?>