<?php 

    require_once '../';
    class Frase extends Conexion{

        public function __construct(){
            parent::__construct();
        }

        public function añadir($frase, $palabraFaltante, $fechaProgramada){
            $sql = "INSERT INTO Frases (frase, palabraFaltante, fechaProgramada) VALUES (:frase, :palabraFaltante, :fechaProgramada);";

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['frase' => $frase, 'palabraFaltante' => $palabraFaltante, 'fechaProgramada' => $fechaProgramada]);
                return $sth->rowCount() > 0 ? true : false;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }

/*
CREATE TABLE Frases (
    idFrase SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    frase VARCHAR(255) NOT NULL,
    palabraFaltante VARCHAR(40) NOT NULL,
    fechaProgramada TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fechaCreacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_idFrase PRIMARY KEY (idFrase)
);
*/

?>

