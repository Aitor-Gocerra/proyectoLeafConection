<?php
require_once __DIR__ . '/mConexion.php';

class Frase extends Conexion
{

    public function mostrarFrase()
    {
        $fecha = date('Y-m-d');

        $sql = "
                SELECT *
                FROM Frases
                WHERE DATE(fechaProgramada) = :fecha
                LIMIT 1;
            ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function mostrarPista($idFrase)
    {

        $sql = "
                SELECT pista
                FROM PistasFrase
                WHERE idFrase = :id;
            ";

        $stmt = $this->conexion->prepare($sql);

        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!-- 
CREATE TABLE Frases (
    idFrase SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    frase VARCHAR(255) NOT NULL,
    palabraFaltante VARCHAR(40) NOT NULL,
    fechaProgramada TIMESTAMP NULL,
    fechaCreacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pk_idFrase PRIMARY KEY (idFrase)
);

CREATE TABLE PistasFrase (
    idPista SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    idFrase SMALLINT UNSIGNED NOT NULL,
    pista VARCHAR(200) NOT NULL,

    CONSTRAINT pk_PistaFrase PRIMARY KEY (idPista),
    CONSTRAINT fk_idFrase_pistaFrase FOREIGN KEY (idFrase)
        REFERENCES Frases(idFrase) ON DELETE CASCADE
); -->