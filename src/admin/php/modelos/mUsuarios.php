<?php
require_once __DIR__ . '/mConexion.php';

class Usuarios extends Conexion
{
    public function anadirUsuario($nombre, $correo, $password)
    {
        $sql = "
            INSERT INTO Usuarios (nombre, correo, password, estado) 
            VALUES (:nombre, :correo, :password, 'activo')
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            return $this->conexion->lastInsertId();
        }
        return false;
    }

    public function listarUsuarios()
    {
        $sql = "
            SELECT * FROM Usuarios 
            ORDER BY idUsuario DESC
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function modificarEstadoUsuario($idUsuario, $estado)
    {
        $sql = "
            UPDATE Usuarios 
            SET estado = :estado 
            WHERE idUsuario = :idUsuario
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminarUsuario($idUsuario)
    {
        $sql = "
            DELETE FROM Usuarios 
            WHERE idUsuario = :idUsuario
            ";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarUsuarios($buscar)
    {
        $sql = "
            SELECT * FROM Usuarios 
            WHERE nombre LIKE :buscar OR correo LIKE :buscar 
            ORDER BY idUsuario DESC
            ";
        $stmt = $this->conexion->prepare($sql);
        $termino = '%' . $buscar . '%';
        $stmt->bindParam(':buscar', $termino);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>