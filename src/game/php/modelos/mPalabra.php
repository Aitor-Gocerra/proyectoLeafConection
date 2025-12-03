<?php
    require_once __DIR__ . '/mConexion.php';

    class Palabra extends Conexion{

        public function mostrarPalabra(){
            $fecha = date('Y-m-d');

            
        }
    }   
?>

<!-- CREATE TABLE Palabras (
    idPalabra SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    palabra VARCHAR(70) NOT NULL,
    definicion VARCHAR(180) NOT NULL,
    fechaProgramada TIMESTAMP NULL,
    fechaCreacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_idPalabra PRIMARY KEY (idPalabra)
); -->