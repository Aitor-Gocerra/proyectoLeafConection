<?php
require_once __DIR__ . '/mConexion.php';

class Palabra extends Conexion
{

    public function crearPalabraYPista($frase, $palabraCorrecta, $pista)
    {
        // Inicia una transacción para asegurar que ambas inserciones se completen
        $this->conexion->beginTransaction();

        try {
            // 1. Insertar la frase
            $sqlPalabra = "
                    INSERT INTO palabras (palabra, definicion) 
                    VALUES (:palabra, :definicion);
                ";

            $stmtPalabra = $this->conexion->prepare($sqlPalabra);
            $stmtPalabra->bindParam(':palabra', $frase);
            $stmtPalabra->bindParam(':definicion', $palabraCorrecta);
            $stmtPalabra->execute();

            $idPalabra = $this->conexion->lastInsertId();

            if ($idPalabra) {
                // 2. Insertar la pista relacionada
                $sqlPista = "
                        INSERT INTO pistaspalabras (idPalabra, pista) 
                        VALUES (:idPalabra, :pista);
                    ";

                $stmtPista = $this->conexion->prepare($sqlPista);
                $stmtPista->bindParam(':idPalabra', $idPalabra);
                $stmtPista->bindParam(':pista', $pista);
                $stmtPista->execute();

                $this->conexion->commit();
                return $idPalabra;
            }

        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo "Error en la transacción: " . $e->getMessage();
            return false;
        }
        return false;
    }

    public function listarPalabras()
    {
        $sql = "
                SELECT * 
                FROM palabras 
                ORDER BY fechaProgramada DESC
                LIMIT 10;
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPalabras($buscar)
    {
        $sql = "
                SELECT * 
                FROM palabras 
                WHERE palabra LIKE :buscar 
                   OR definicion LIKE :buscar
                ORDER BY fechaProgramada DESC;
            ";
        
        $stmt = $this->conexion->prepare($sql);
        $searchTerm = '%' . $buscar . '%';
        $stmt->bindParam(':buscar', $searchTerm);
        $stmt->execute();

        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return !empty($resultado) ? $resultado : null;
    }

    public function actualizarPalabra($idPalabra, $palabra, $palabraCorrecta)
    {
        $sql = "
                UPDATE palabras 
                SET palabra = :palabra, definicion = :correcta 
                WHERE idPalabra = :id
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':palabra', $palabra);
        $stmt->bindParam(':correcta', $palabraCorrecta);
        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /* public function anadirPista($idPalabra, $pista)
    {
        $sql = "
                INSERT INTO PistasFrase (idPalabra, pista) 
                VALUES (:idPalabra, :pista);
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idPalabra', $idFrase, PDO::PARAM_INT);
        $stmt->bindParam(':pista', $pista);

        return $stmt->execute();
    } */

    public function eliminarPalabra($idPalabra)
    {
        $sql = "
                DELETE FROM Palabras
                WHERE idPalabra = :id;
                ";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $idPalabra, PDO::PARAM_INT);

        return $stmt->execute();
    }

}