<?php
require_once __DIR__ . '/../Modelos/ModConexion.php';

class Frase extends Conexion
{

    public function crearFraseYpista($frase, $palabraFaltante, $pista)
    {
        // Inicia una transacción para asegurar que ambas inserciones se completen
        $this->conexion->beginTransaction();

        try {
            // 1. Insertar la frase
            $sqlFrase = "
                    INSERT INTO Frases (frase, palabraFaltante) 
                    VALUES (:frase, :palabra);
                ";

            $stmtFrase = $this->conexion->prepare($sqlFrase);
            $stmtFrase->bindParam(':frase', $frase);
            $stmtFrase->bindParam(':palabra', $palabraFaltante);
            $stmtFrase->execute();

            $idFrase = $this->conexion->lastInsertId();

            if ($idFrase) {
                // 2. Insertar la pista relacionada
                $sqlPista = "
                        INSERT INTO PistasFrase (idFrase, pista) 
                        VALUES (:idFrase, :pista);
                    ";

                $stmtPista = $this->conexion->prepare($sqlPista);
                $stmtPista->bindParam(':idFrase', $idFrase);
                $stmtPista->bindParam(':pista', $pista);
                $stmtPista->execute();

                $this->conexion->commit();
                return (int) $idFrase;
            }

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            // Aquí puedes loggear el error
            return false;
        }
        return false;
    }

    public function listarFrases()
    {
        $sql = "
                SELECT * 
                FROM Frases 
                ORDER BY fechaProgramada DESC
                LIMIT 10;
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return !empty($resultado) ? $resultado : null;
    }

    public function actualizarFrase($idFrase, $frase, $palabraFaltante)
    {
        $sql = "
                UPDATE Frases 
                SET frase = :frase, palabraFaltante = :palabra 
                WHERE idFrase = :id
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':frase', $frase);
        $stmt->bindParam(':palabra', $palabraFaltante);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function anadirPista($idFrase, $pista)
    {
        $sql = "
                INSERT INTO PistasFrase (idFrase, pista) 
                VALUES (:idFrase, :pista);
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idFrase', $idFrase, PDO::PARAM_INT);
        $stmt->bindParam(':pista', $pista);

        return $stmt->execute();
    }

    public function eliminarFrase($idFrase)
    {
        $sql = "
                DELETE FROM Frases 
                WHERE idFrase = :id;
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idFrase, PDO::PARAM_INT);

        return $stmt->execute();
    }

}