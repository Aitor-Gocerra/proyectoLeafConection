<?php
require_once __DIR__ .'./config/config.php';
class MNoticia {
    public function __construct(){
        $this->conexion = new mysqli (SERVER, USER, PASSWORD, DB);
    }

    public function listarNoticias($titulo, $noticia, $fechaProgramada){ /* Falta la imagen*/
        $sql='SELECT titulo, noticia, fechaProgramada FROM Noticias';
        $resultado= $this-> conexion->query($sql);

        while ($fila=$resultado-> fetch_assoc()){
            $datos[]= $fila;
        }
        return $datos;
        
    }

    public function modificarNoticias(){
        $sql= "UPDATE Noticias SET titulo = '" . $_POST['nombre']. "' WHERE idNoticia=" .$_GET['idNoticia'];
        $resultado= $this->conexion->query($sql);


        return $this->conexion->query($sql);   
    }

    public function eliminarNoticias($idNoticia){
        $sql= "DELETE FROM Noticias WHERE idNoticia= ".$idNoticia;

        return $this->conexion->query($sql);
    }

    public function anadirNoticias(){
        $sql= "INSERT INTO noticias (titulo) VALUES ('" .$_POST['nombre']."' )";
        
        return $this->conexion->query($sql);
    }
    

}



?>





