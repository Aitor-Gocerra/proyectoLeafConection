<?php 
    require_once __DIR__ .'/mConexion.php';

    class Noticia extends Conexion{
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