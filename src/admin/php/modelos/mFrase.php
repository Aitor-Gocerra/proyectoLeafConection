<?php
require_once __DIR__ . '/mConexion.php';

class Frase extends Conexion
{

    public function crearFraseYpista($frase, $palabraFaltante, $pista, $autor = null, $fechaProgramada = null)
    {
        // Inicia una transacción para asegurar que ambas inserciones se completen
        $this->conexion->beginTransaction();

        try {
            // 1. Insertar la frase
            $sqlFrase = "
                    INSERT INTO Frases (frase, palabraFaltante, autor, fechaProgramada) 
                    VALUES (:frase, :palabra, :autor, :fecha);
                ";

            $stmtFrase = $this->conexion->prepare($sqlFrase);
            $stmtFrase->bindParam(':frase', $frase);
            $stmtFrase->bindParam(':palabra', $palabraFaltante);
            $stmtFrase->bindParam(':autor', $autor);
            $stmtFrase->bindParam(':fecha', $fechaProgramada);
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
            echo "Error en la transacción: " . $e->getMessage();
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
    public function buscarFrases($buscar)
    {
        $sql = "
                SELECT * 
                FROM Frases 
                WHERE frase LIKE :buscar1 
                   OR palabraFaltante LIKE :buscar2
                ORDER BY fechaProgramada DESC;
            ";

        $stmt = $this->conexion->prepare($sql);
        $terminoBusqueda = '%' . $buscar . '%';
        $stmt->bindParam(':buscar1', $terminoBusqueda);
        $stmt->bindParam(':buscar2', $terminoBusqueda);
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