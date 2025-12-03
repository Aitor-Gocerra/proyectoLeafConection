<?php 

    require_once __DIR__ .'/mConexion.php';

    class Noticias extends Conexion{

        public function __construct(){
            parent::__construct();
        }

        public function añadir($titulo, $noticia, $fechaProgramada, $urlImagen){
            $sql = "INSERT INTO Noticias (titulo, noticia, fechaProgramada, urlImagen) VALUES (:titulo, :noticia, :fechaProgramada, :urlImagen);";
            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['titulo' => $titulo, 'noticia' => $noticia, 'fechaProgramada' => $fechaProgramada, 'urlImagen' => $urlImagen]);
                return true;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>