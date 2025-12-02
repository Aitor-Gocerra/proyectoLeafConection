<?php 

    require_once '../';
    class Consejo extends Conexion{

        public function __construct(){
            parent::__construct();
        }

        public function añadir($consejo, $fechaProgramada, $idTematica){
            $sql = "INSERT INTO Consejos (consejo, fechaProgramada, idTematica) VALUES (:consejo, :fechaProgramada, :idTematica);";

            try{
                $sth = $this->conexion->prepare($sql);
                $sth->execute(['consejo' => $consejo, 'fechaProgramada' => $fechaProgramada, 'idTematica' => $idTematica]);
                return $sth->rowCount() > 0 ? true : false;
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function listarTematicas (){
            $sql = "SELECT * FROM Tematica;";

            try{
                $resultado = $this->conexion->query($sql); // Ejecuta la consulta
                $tematicas = $resultado->fetchAll(PDO::FETCH_ASSOC); // Lo convierte a array asociativo
                return $tematicas; // Se retorna
            } catch(PDOException $e){
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }

/*CREATE TABLE Tematica (
    idTematica TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    tematica VARCHAR(100) NOT NULL,
    CONSTRAINT pk_idTematica PRIMARY KEY (idTematica)
);

-- ============================
-- Tabla Consejos
-- ============================
CREATE TABLE Consejos (
    idConsejo SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    consejo VARCHAR(255) NOT NULL,
    fechaProgramada TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    idTematica TINYINT UNSIGNED NOT NULL,

    CONSTRAINT pk_idConsejo PRIMARY KEY (idConsejo),
    CONSTRAINT fk_consejo_idTematica FOREIGN KEY (idTematica)
        REFERENCES Tematica(idTematica) ON DELETE CASCADE
);
*/

?>

