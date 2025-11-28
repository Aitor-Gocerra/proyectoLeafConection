<?php

class Frase extends Conexion{ // Asumiendo que hereda de un BaseModel
    
    // Nombre de la tabla principal
    protected $table = 'Frases';
    
    // Columnas de la tabla principal
    protected $primaryKey = 'idFrase';

    private $db; // Conexión a la base de datos

    public function __construct($db) {
        $this->db = $db; // Inyecta la conexión
    }

    // ===============================================
    // C - CREATE (Crear una nueva frase)
    // ===============================================

    /**
     * Crea una nueva frase en la base de datos junto con una pista inicial.
     * @param string $frase La frase con la palabra faltante.
     * @param string $palabraFaltante La palabra que se omite.
     * @param string $pista La pista inicial para la frase.
     * @return bool|int Devuelve el ID de la nueva frase o false si falla.
     */
    public function crearFraseYpista($frase, $palabraFaltante, $pista) {
        // Inicia una transacción para asegurar que ambas inserciones se completen
        $this->db->beginTransaction();

        try {
            // 1. Insertar la frase
            $sqlFrase = "INSERT INTO Frases (frase, palabraFaltante) VALUES (:frase, :palabra)";
            $stmtFrase = $this->db->prepare($sqlFrase);
            $stmtFrase->bindParam(':frase', $frase);
            $stmtFrase->bindParam(':palabra', $palabraFaltante);
            $stmtFrase->execute();
            
            $idFrase = $this->db->lastInsertId();

            if ($idFrase) {
                // 2. Insertar la pista relacionada
                $sqlPista = "INSERT INTO PistasFrase (idFrase, pista) VALUES (:idFrase, :pista)";
                $stmtPista = $this->db->prepare($sqlPista);
                $stmtPista->bindParam(':idFrase', $idFrase);
                $stmtPista->bindParam(':pista', $pista);
                $stmtPista->execute();

                $this->db->commit();
                return (int)$idFrase;
            }

        } catch (PDOException $e) {
            $this->db->rollBack();
            // Aquí puedes loggear el error
            return false;
        }
        return false;
    }

    // ===============================================
    // R - READ (Leer frases)
    // ===============================================

    /**
     * Obtiene una frase por su ID, incluyendo sus pistas.
     * @param int $idFrase
     * @return array|null La frase completa con sus pistas, o null si no existe.
     */
    public function getFraseConPistas($idFrase) {
        $sql = "
            SELECT 
                f.idFrase, f.frase, f.palabraFaltante, 
                GROUP_CONCAT(p.pista SEPARATOR '; ') AS pistas
            FROM Frases f
            LEFT JOIN PistasFrase p ON f.idFrase = p.idFrase
            WHERE f.idFrase = :id
            GROUP BY f.idFrase
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Obtiene una lista de todas las frases (útil para el administrador).
     * @return array Lista de todas las frases.
     */
    public function getAllFrases() {
        $sql = "SELECT * FROM Frases ORDER BY fechaProgramada DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // ===============================================
    // U - UPDATE (Actualizar una frase)
    // ===============================================

    /**
     * Actualiza los datos principales de una frase.
     * @param int $idFrase
     * @param string $frase La frase con la palabra faltante.
     * @param string $palabraFaltante La palabra que se omite.
     * @return bool Éxito o fracaso de la actualización.
     */
    public function actualizarFrase($idFrase, $frase, $palabraFaltante) {
        $sql = "
            UPDATE Frases 
            SET frase = :frase, palabraFaltante = :palabra 
            WHERE idFrase = :id
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':frase', $frase);
        $stmt->bindParam(':palabra', $palabraFaltante);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);
        
        return $stmt->execute();
    }
    
    /**
     * Añade una nueva pista a una frase existente.
     * @param int $idFrase
     * @param string $pista La nueva pista.
     * @return bool Éxito o fracaso de la inserción.
     */
    public function anadirPista($idFrase, $pista) {
        $sql = "INSERT INTO PistasFrase (idFrase, pista) VALUES (:idFrase, :pista)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':idFrase', $idFrase, PDO::PARAM_INT);
        $stmt->bindParam(':pista', $pista);
        
        return $stmt->execute();
    }
    
    // ===============================================
    // D - DELETE (Eliminar una frase)
    // ===============================================

    /**
     * Elimina una frase por su ID.
     * Las pistas relacionadas se eliminan automáticamente por la CASCADE en la FK.
     * @param int $idFrase
     * @return bool Éxito o fracaso de la eliminación.
     */
    public function eliminarFrase($idFrase) {
        $sql = "DELETE FROM Frases WHERE idFrase = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

}