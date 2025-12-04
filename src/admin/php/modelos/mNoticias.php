<?php 
    require_once __DIR__ .'/mConexion.php';

    class Noticia extends Conexion{
        public function __construct(){
            parent::__construct();
        }

        public function añadir($titulo, $noticia, $fechaProgramada, $urlImagen, $preguntas, $opciones, $respuestas){
            $sql1 = "INSERT INTO Noticias (titulo, noticia, fechaProgramada, urlImagen) VALUES (:titulo, :noticia, :fechaProgramada, :urlImagen);";
            $sql2 = "INSERT INTO Preguntas (idNoticia, nPregunta, pregunta) VALUES (:idNoticia, :nPregunta, :pregunta);";
            $sql3 = "INSERT INTO Opciones (idNoticia, nPregunta, nOpcion, opcion) VALUES (:idNoticia, :nPregunta, :nOpcion, :opcion);";
            $sql4 = "INSERT INTO RespuestaCorrecta (idNoticia, nPregunta, nOpcion) VALUES (:idNoticia, :nPregunta, :nOpcion);";

            try {
                $this->conexion->beginTransaction();
        
                $sth = $this->conexion->prepare($sql1); // Noticia
                $sth->execute(['titulo' => $titulo, 'noticia' => $noticia, 'fechaProgramada' => $fechaProgramada, 'urlImagen' => $urlImagen]);
                $idNoticia = $this->conexion->lastInsertId();
        
                $sth = $this->conexion->prepare($sql2); // Preguntas
                foreach ($preguntas as $i => $pregunta) {
                    $nPregunta = $i + 1;
                    $sth->execute(['idNoticia' => $idNoticia, 'nPregunta' => $nPregunta, 'pregunta' => $pregunta]);
                }
        
                $sth = $this->conexion->prepare($sql3); // Opciones
                foreach ($opciones as $i => $opcionesPorPregunta) {
                    $nPregunta = $i + 1;
                    foreach ($opcionesPorPregunta as $j => $opcion) {
                        $nOpcion = $j + 1;
                        $sth->execute(['idNoticia' => $idNoticia, 'nPregunta' => $nPregunta, 'nOpcion' => $nOpcion, 'opcion' => $opcion]);
                    }
                }
        
                $sth = $this->conexion->prepare($sql4); // Respuestas
                foreach ($respuestas as $i => $respuesta) {
                    $nPregunta = $i + 1;
                    $sth->execute(['idNoticia' => $idNoticia, 'nPregunta' => $nPregunta, 'nOpcion' => (int)$respuesta]);
                }
        
                $this->conexion->commit();
                return true;
        
            }  catch(PDOException $e){
                $this->conexion->rollBack();
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function buscarNoticia($buscar){
            $sql = "SELECT * FROM Noticias WHERE titulo LIKE :buscar1 OR noticia LIKE :buscar2 ORDER BY fechaProgramada DESC;";

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute([
                    'buscar1' => "%$buscar%",
                    'buscar2' => "%$buscar%"
                ]);
                $noticias = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $noticias;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function listarNoticias(){
            $sql = "SELECT * FROM Noticias ORDER BY fechaProgramada DESC LIMIT 10;";
            
            try{
                $sth = $this->conexion->query($sql);
                $noticias = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $noticias;
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>