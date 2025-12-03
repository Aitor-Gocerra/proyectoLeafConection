<?php
require_once __DIR__ . '/mConexion.php';

class Palabra extends Conexion
{

    public function mostrarPalabra()
    {
        $fecha = date('Y-m-d');

        $sql = "
                SELECT *
                FROM Palabras
                WHERE DATE(fechaProgramada) = :fecha
                LIMIT 1;
            ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function mostrarPista($idPalabra)
    {

        $sql = "
                SELECT pista
                FROM PistasPalabras
                WHERE idPalabra = :id;
            ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
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
); 


CREATE TABLE PistasPalabras (
    idPista SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    idPalabra SMALLINT UNSIGNED NOT NULL,
    pista VARCHAR(200) NOT NULL,

    CONSTRAINT pk_PistaPalabra PRIMARY KEY (idPista),
    CONSTRAINT fk_idPalabra_pistaPalabra FOREIGN KEY (idPalabra)
        REFERENCES Palabras(idPalabra) ON DELETE CASCADE
);
-->