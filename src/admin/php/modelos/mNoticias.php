<?php 
    require_once __DIR__ .'/mConexion.php';

    class Noticia extends Conexion{
        public function __construct(){
            parent::__construct();
        }

        public function añadir($titulo, $noticia, $fechaProgramada, $urlImagen, $preguntas, $opciones, $respuestas){
            $sql1 = "INSERT INTO Noticias (titulo, noticia, fechaProgramada, urlImagen) 
                    VALUES (:titulo, :noticia, :fechaProgramada, :urlImagen);";

            $sql2 = "INSERT INTO Preguntas (idNoticia, nPregunta, pregunta) 
                    VALUES (:idNoticia, :nPregunta, :pregunta);";

            $sql3 = "INSERT INTO Opciones (idNoticia, nPregunta, nOpcion, opcion) 
                    VALUES (:idNoticia, :nPregunta, :nOpcion, :opcion);";

            $sql4 = "INSERT INTO RespuestaCorrecta (idNoticia, nPregunta, nOpcion) 
                    VALUES (:idNoticia, :nPregunta, :nOpcion);";


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

        public function modificar($idNoticia, $titulo, $noticia, $fechaProgramada, $urlImagen, $preguntas, $opciones, $respuestas){
            $sql1 = "UPDATE Noticias            SET titulo = :titulo, noticia = :noticia, fechaProgramada = :fechaProgramada, urlImagen = :urlImagen
                    WHERE idNoticia = :idNoticia;";

            $sql2 = "UPDATE Preguntas           SET pregunta = :pregunta    
                    WHERE idNoticia = :idNoticia AND nPregunta = :nPregunta;";

            $sql3 = "UPDATE Opciones            SET opcion = :opcion        
                    WHERE idNoticia = :idNoticia AND nPregunta = :nPregunta AND nOpcion = :nOpcion;";

            $sql4 = "UPDATE RespuestaCorrecta   SET nOpcion = :nOpcion 
                    WHERE idNoticia = :idNoticia AND nPregunta = :nPregunta;";


            try {
                $this->conexion->beginTransaction();
        
                $sth = $this->conexion->prepare($sql1); // Noticia
                $sth->execute(['titulo' => $titulo, 'noticia' => $noticia, 'fechaProgramada' => $fechaProgramada, 'urlImagen' => $urlImagen, 'idNoticia' => $idNoticia]);
        

                $sth = $this->conexion->prepare($sql2); // Preguntas
                foreach ($preguntas as $i => $pregunta) {
                    $nPregunta = $i + 1;
                    $sth->execute(['pregunta' => $pregunta, 'idNoticia' => $idNoticia, 'nPregunta' => $nPregunta]);
                }

                $sth = $this->conexion->prepare($sql3); // Opciones
                foreach ($opciones as $i => $opcionesPorPregunta) {
                    $nPregunta = $i + 1;
                    foreach ($opcionesPorPregunta as $j => $opcion) {
                        $nOpcion = $j + 1;
                        $sth->execute(['opcion' => $opcion, 'idNoticia' => $idNoticia, 'nPregunta' => (int)$nPregunta, 'nOpcion' => (int)$nOpcion]);
                    }
                }

                $sth = $this->conexion->prepare($sql4); // Respuestas
                foreach ($respuestas as $i => $respuesta) {
                    $nPregunta = $i + 1;
                    $sth->execute(['nOpcion' => $respuesta, 'idNoticia' => $idNoticia, 'nPregunta' => $nPregunta]);
                }
        
                $this->conexion->commit();
                return true;
        
            } catch(PDOException $e){
                $this->conexion->rollBack();
                return $e->getCode();
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
            $sql = "SELECT * FROM Noticias ORDER BY fechaCreacion DESC LIMIT 10;";
            
            try{
                $sth = $this->conexion->query($sql);
                $noticias = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $noticias;
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function eliminarNoticia($idNoticia){
            $sql = "DELETE FROM Noticias WHERE idNoticia = :idNoticia;";

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['idNoticia' => $idNoticia]);
                return $sth->rowCount() > 0 ? true : false;
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function obtenerNoticia($idNoticia){
            $sql = "SELECT * FROM Noticias WHERE idNoticia = :idNoticia;";

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['idNoticia' => $idNoticia]);
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
            $sql = "SELECT nPregunta, nOpcion FROM RespuestaCorrecta WHERE idNoticia = :idNoticia;";
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

        public function obtenerFechasNoticias(){
            $sql = "SELECT idNoticia, fechafechaProgramada FROM Noticias;";

            try{
                $sth = $this->conexion->query($sql);
                $fechas = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $fechas;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>